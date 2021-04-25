<template>
    <div>
        <div v-if="! loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="publication_title">Title</label>
                <input id="publication_title" v-model="publication.title"/>
            </div>
            <div class="form-group">
                <label for="publication_body">Body</label>
                <textarea id="publication_body" rows="5" v-model="publication.body">
                </textarea>
            </div>
            <div class="form-group">
                <button type="submit" >Update</button>
            </div>
        </form>
    </div>
</template>
<script>
import pubApi from '../api/publications';

export default {
    data() {
        return {
            loaded: false,
            publication: {
                id: null,
                title: "",
                body: ""
            }
        };
    },
    methods: {
        onSubmit() {
            this.$store.commit('editPublication', {
                id: this.publication.id,
                data: {
                    title: this.publication.title,
                    body: this.publication.body,
                }
            });

            this.$router.push({
                name: 'publications.view',
                query: {
                    id: this.publication.id,
                }
            });
        },
    },
    created() {
        pubApi.find(this.$route.params.id).then((response) => {
            this.loaded = true;
            this.publication = response.data.data;
        });
    }
};
</script>

<style lang="scss" scoped>

.form-group label {
    display: block;
}

</style>
