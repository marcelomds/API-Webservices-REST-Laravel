<template>
    <div>
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <input type="text"
                       class="form-control"
                       placeholder="Nome da Categoria" v-model="category.name">
            </div>

            <div class="form-group">
                <button class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        category: {
            required: false,
            type: Object | Array,
            default: () => {
                return {
                    id: '',
                    name: ''
                }
            }
        },
        update: {
            required: false,
            type: Boolean,
            default: false
        }
    },
    methods: {
        onSubmit () {
            const action = this.update ? 'updateCategory' : 'storeCategory';

            this.$store.dispatch(action, this.category)
                .then(() => {
                    this.$snotify.success('Cadastrado com Sucesso');

                    this.$router.push({name: 'admin.categories'})
                })
                .catch(error => {
                    this.$snotify.error('Erro ao cadastrar');

                    console.log(error.response.data.errors);
                })
        }
    }
}
</script>

<style scoped>

</style>
