<template>
    <div>
        <h1>Create a publication</h1>
        <flash-message></flash-message>
        <br/>
        <form @submit.prevent="onSubmit($event)">
            <div class="form-group">
                <label for="publication_title">Title</label>
                <input id="publication_title" v-model="publication.title"/>
            </div>
            <div class="form-group">
                <label for="publication_body">Body</label>
                <input id="publication_body" v-model="publication.body"/>
            </div>
            <div class="form-group">
                <button type="submit">
                    Create
                </button>
            </div>
        </form>
    </div>
</template>
<script>

export default {
    data() {
        return {
            publication: {
                title: '',
                body: '',
            }
        }
    },
    methods: {
        onSubmit($event) {
            const vm = this;
            this.$store.commit('createPublication', {
                data: {
                    title: this.publication.title,
                    body: this.publication.body,
                }
            });
            this.$router.push({name: 'publications.list'});
        }
    }
}
</script>
