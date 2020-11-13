<template>
    <div>
        <h1>Lista das Categorias</h1>

        <div class="row">
            <div class="col">
                <router-link :to="{name: 'admin.categories.create'}" class="btn btn-success">Cadastrar</router-link>
            </div>
            <div class="col">
                <search @searchCategory="search"></search>
            </div>
        </div>

        <table class="table table-striped mt-1">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th width="200">AÇÔES</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(category, index) in categories.data" :key="index">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>
                    <router-link :to="{name: 'admin.categories.edit', params: {id: category.id}}"
                    class="btn btn-warning">
                        Editar
                    </router-link>

                    <a href="#" class="btn btn-danger" @click.prevent="confirmDestroy(category)">Excluir</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import SearchCategoryComponent from "./partials/SearchCategoryComponent";

export default {
    created() {
        this.loadCategories();
    },
    data () {
      return {
          name: '',
      }
    },
    computed: {
        categories () {
            return this.$store.state.categories.items;
        }
    },
    methods: {
        loadCategories () {
            this.$store.dispatch('loadCategories', { name: this.name });
        },

        confirmDestroy (category) {
            this.$snotify.error(`Deseja realmente remover a categoria: ${category.name}`, 'Confirmar Deletar?', {
                timout: 10000,
                showProgressBar: true,
                closeOnClick: true,
                buttons: [
                    {text: 'Sim', action: () => this.destroy(category)},
                ]
            });
        },

        destroy (category) {
            this.$store.dispatch('destroyCategory', category.id)
            .then(() => {
                this.$snotify.success('Deletado com sucesso')

                this.loadCategories();
            })
            .catch(error => {
                this.$snotify.error('Erro ao deletar' + error)
            })
        },

        search (filter) {
            this.name = filter;

            this.loadCategories();
        }
    },
    components: {
        search: SearchCategoryComponent
    }
}
</script>

<style scoped>

</style>
