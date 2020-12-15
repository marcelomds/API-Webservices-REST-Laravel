<template>
    <div>
        <header-site></header-site>

        <router-view></router-view>

        <hr>
        <footer-site></footer-site>
    </div>
</template>

<script>
import SiteHeaderComponent from "./SiteHeaderComponent";
import SiteFooterComponent from "./SiteFooterComponent";

export default {
    components: {
        headerSite: SiteHeaderComponent,
        footerSite: SiteFooterComponent
    }
}
</script>

<style scoped>

</style>
