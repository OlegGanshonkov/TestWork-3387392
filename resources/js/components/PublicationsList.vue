<template>
    <div class="publications">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <br/>
        <flash-message></flash-message>
        <br/>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <table v-if="PublicationsData">
            <thead>
            <tr>
                <td style="font-weight: bold;">Title</td>
                <td style="font-weight: bold;">Created At</td>
                <td style="font-weight: bold;">Updated At</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="{ id, title, created_at, updated_at } in PublicationsData">
                <td style="padding: 2px 4px;">
                    <router-link :to="{ name: 'publications.view', params: { id } }">{{ title }}</router-link>
                </td>
                <td style="padding: 2px 4px;">{{ created_at }}</td>
                <td style="padding: 2px 4px;">{{ updated_at }}</td>
                <td style="padding: 2px 4px;">
                    <router-link :to="{ name: 'publications.edit', params: { id } }">Edit</router-link>
                </td>
                <td style="padding: 2px 4px;">
                    <button class="btn btn-danger" @click.prevent="onDelete($event, id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div v-if="PublicationsData" class="pagination" style="padding: 10px 0px;">
            <button :disabled="! prevPage" @click.prevent="goToPrev">Previous</button>
            <span style="padding: 0px 5px;">
                {{ paginatonCount }}
            </span>
            <button :disabled="! nextPage" @click.prevent="goToNext">Next</button>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import {mapGetters} from 'vuex';

const getPublications = (page, callback) => {
    const params = {page};

    axios
        .get('/api/publications', {params})
        .then(response => {
            callback(null, response.data);
        })
        .catch(error => {
            callback(error, error.response.data);
        });
};

export default {
    data() {
        return {
            loading: false,
            meta: null,
            links: {
                first: null,
                last: null,
                next: null,
                prev: null,
            },
            error: null,
        };
    },
    computed: {
        ...mapGetters([
            'PublicationsData',
        ]),
        nextPage() {
            if (!this.meta || this.meta.current_page === this.meta.last_page) {
                return;
            }

            return this.meta.current_page + 1;
        },
        prevPage() {
            if (!this.meta || this.meta.current_page === 1) {
                return;
            }

            return this.meta.current_page - 1;
        },
        paginatonCount() {
            if (!this.meta) {
                return;
            }

            const {current_page, last_page} = this.meta;

            return `${current_page} of ${last_page}`;
        },
    },
    beforeRouteEnter(to, from, next) {
        getPublications(to.query.page, (err, data) => {
            next(vm => vm.setData(err, data));
        });
    },
    beforeRouteUpdate(to, from, next) {
        this.publications = this.links = this.meta = null
        getPublications(to.query.page, (err, data) => {
            this.setData(err, data);
            next();
        });
    },
    methods: {
        goToNext() {
            this.$router.push({
                query: {
                    page: this.nextPage,
                },
            });
        },
        goToPrev() {
            this.$router.push({
                name: 'publications.list',
                query: {
                    page: this.prevPage,
                }
            });
        },
        setData(err, {data: publications, links, meta}) {
            if (err) {
                this.error = err.toString();
            } else {
                this.$store.commit('setPublications', {data: publications});
                this.links = links;
                this.meta = meta;
            }
        },
        onDelete(event, id) {
            this.$store.commit('deletePublication', {
                id: id
            });
        }
    }
}
</script>
