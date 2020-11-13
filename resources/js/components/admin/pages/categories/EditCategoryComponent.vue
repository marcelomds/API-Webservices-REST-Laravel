<template>
    <div>
        <h2>Editar Categoria</h2>

        <form-category-component
            :category="category"
            :update="true">
        </form-category-component>
    </div>
</template>

<script>
import FormCategoryComponent from "./partials/FormCategoryComponent";

export default {
    props: {
        id: {
            required: true
        }
    },
    data () {
        return {
            category: {}
        }
    },
    created() {
        this.$store.dispatch('loadCategory', this.id)
            .then(response => {
                this.category = response;
            })
            .catch(error => {
                console.log(error)
            })
    },
    components: {
        FormCategoryComponent
    }
}
</script>

<style scoped>

</style>
