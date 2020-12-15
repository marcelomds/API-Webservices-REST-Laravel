<template>
    <div>
        <ul class="nav">
            <li class="nav-item">
                <router-link :to="{name: 'home'}" class="nav-link">HOME</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'contact'}" class="nav-link">CONTATO</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
name: "SiteHeaderComponent"
}
</script>

<style scoped>

</style>
