<template>
    <div class="container">
        <h1>Produtos</h1>

        <search @search="search"></search>

        <div class="row">
            <div class="col-3" v-for="product in products.data" :key="product.id">
                <router-link :to="{name: 'product.detail', params: {id: product.id}}">
                    <div v-if="product.image">
                        <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
                    </div>
                    <div v-else>
                        <img src="/images/no-image.png" alt="sem imagem" class="img-list">
                    </div>
                    {{ product.name }}
                </router-link>
            </div>
        </div>

        <pagination
            :pagination="products"
            @paginate="loadProducts">
        </pagination>
    </div>
</template>

<script>
import PaginateComponent from "../../../layouts/PaginateComponent";
import Search from "./Search";

export default {

    created() {
        if (this.products.data.length == 0)
            this.$store.dispatch('loadProducts', {});
    },

    data() {
        return {
            filter: ''
        }
    },

    computed: {
        products() {
            return this.$store.state.products.items;
        },
        params() {
            return {
                filter: this.filter,
                page: this.products.current_page
            }
        }
    },

    methods: {
        loadProducts(page = 1) {
            this.$store.dispatch('loadProducts', {...this.params, page})
        },

        search(filter) {
            this.filter = filter;

            this.loadProducts();
        }
    },

    components: {
        pagination: PaginateComponent,
        search: Search
    }
}
</script>

<style scoped>
.img-list {
    max-width: 100px;
}
</style>
