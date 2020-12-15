<template>
    <div>
        <h1>{{ product.name }}</h1>
        <div v-if="product.image">
            <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
        </div>
        <div v-else>
            <img src="/images/no-image.png" alt="sem imagem" class="img-list">
        </div>
        {{ product.description }}
    </div>
</template>

<script>
export default {
    props: ['id'],

    created() {
      this.loadProduct()
    },

    data() {
        return {
            product: {}
        }
    },

    methods: {
        loadProduct() {
            this.$store.dispatch('loadProduct', this.id)
                .then(response => this.product = response.product)
        }
    }
}
</script>

<style scoped>
.img-list {
    max-width: 100px;
}
</style>
