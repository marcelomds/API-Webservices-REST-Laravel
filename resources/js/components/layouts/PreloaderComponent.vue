<template>
    <div class="preloader" v-show="preloader">
        <img src="/public/images/preloader.gif" alt="Preloader">
    </div>
</template>

<script>
export default {
    computed: {
        preloader () {
            return this.$store.state.preloader.loading;
        }
    }
}
</script>

<style scoped>

.preloader {}
.preloader img {}

</style>
