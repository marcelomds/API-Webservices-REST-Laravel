<template>
    <div>
        <ul class="nav bg-warning">
            <li class="nav-item">
                <router-link :to="{name: 'admin.dashboard'}" class="nav-link">Dashboard</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'admin.categories'}" class="nav-link">Categorias ({{ totalCategories }})</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{name: 'admin.products'}" class="nav-link">Produtos</router-link>
            </li>
        </ul>

        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        totalCategories () {
            return this.$store.state.categories.items.data.length;
        }
    }
}
</script>

<style scoped>

</style>
