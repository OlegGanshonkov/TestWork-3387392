<template>
    <div style="padding: 20px;">
        <h1>Publications</h1>

        <p style="padding: 5px 20px; font-size: 22px;">
            <router-link class="btn btn-primary" :to="{ name: 'publications.list' }">List</router-link>
            <router-link v-if="isEdit()" class="btn btn-primary" :to="{ name: 'publications.view' }">View</router-link>
            <router-link v-if="isView()" class="btn btn-primary" :to="{ name: 'publications.edit' }">Edit</router-link>
            <router-link class="btn btn-primary" :to="{ name: 'publications.create' }">Add</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
export default {

    methods: {
        isView() {
            return this.$router.history.current["name"] === "publications.view";
        },
        isEdit() {
            return this.$router.history.current["name"] === "publications.edit";
        }
    },
}
</script>
