<template>
    <div>
        <div v-if="message" class="alert alert-success" role="alert">{{ message }}</div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            message: '',
        };
    },
    mounted() {
        Bus.$on('flash-message', (message) => {
            this.message = message;
            setTimeout(() => this.message = null, 2000);
        });
    }
};
</script>
