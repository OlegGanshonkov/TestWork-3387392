<template>
    <div>
        <flash-message></flash-message>
        <br/>
        <p><strong>{{ publication.title}}</strong></p>
        <p>{{ publication.body}}</p>
        <p><i>Created At:</i> {{ publication.created_at}}</p>
        <p><i>Updated At:</i> {{ publication.updated_at}}</p>
    </div>
</template>
<script>
import pubApi from '../api/publications';

export default {
    data() {
        return {
            loaded: false,
            saving: false,
            publication: {
                id: null,
                name: "",
                body: "",
                created_at: "",
                updated_at: "",
            }
        };
    },
    methods: {
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
i {
    font-size: 10px;
}
</style>
