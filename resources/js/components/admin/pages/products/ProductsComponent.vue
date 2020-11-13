<template>
    <div>
        <h1>Listagem de Produtos</h1>

        <div class="row">
            <div class="col">
                <button class="btn btn-success" @click.prevent="createE">
                    Novo Produto
                </button>

                <vodal
                    :show="showModal"
                    animation="zoom"
                    @hide="hideModal"
                    :width="600"
                    :height="400">
                    <product-form-component
                        :product="product"
                        :update="update"
                        @success="success">
                    </product-form-component>
                </vodal>
            </div>
            <div class="col">
                <search @search="searchForm">
                </search>
            </div>
        </div>

        <table class="table table-striped mt-1">
            <thead class="table-dark">
            <tr>
                <th width="150">Imagem</th>
                <th>Nome</th>
                <th width="200">Ação</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products.data" :key="product.id">
                <td>
                    <div v-if="product.image">
                        <img :src="[`/storage/products/${product.image}`]" :alt="product.name" class="img-list">
                    </div>
                </td>
                <td>{{ product.name }}</td>
                <td>
                    <a href="#" @click.prevent="edit(product.id)" class="btn btn-info">Editar</a>
                    <destroy :item="product" @destroy="destroy"/>
                </td>
            </tr>
            </tbody>
        </table>

        <pagination
            :pagination="products"
            :offset="6"
            @paginate="loadProducts">
        </pagination>
    </div>
</template>

<script>
import Vodal from 'vodal';

import PaginateComponent from "../../../layouts/PaginateComponent";
import SearchComponent from "../../../layouts/SearchComponent";
import ProductFormComponent from "./partials/ProductFormComponent";
import ButtonDestroyComponent from "../../layouts/ButtonDestroyComponent";

export default {
    data() {
        return {
            search: '',
            showModal: false,
            product: {
                id: '',
                name: '',
                description: '',
                category_id: ''
            },
            update: false
        }
    },
    created() {
        this.loadProducts(1);
    },
    computed: {
        products() {
            return this.$store.state.products.items;
        },
        params() {
            return {
                page: this.products.current_page,
                filter: this.search
            }
        }
    },
    methods: {
        loadProducts(page) {
            this.$store.dispatch('loadProducts', {...this.params, page});
        },

        createE() {
            this.update = false;

            this.showModal = true;

            this.reset();
        },

        edit(id) {
            this.$store.dispatch('loadProduct', id)
                .then(response => {
                    this.product = response.product;

                    this.showModal = true;

                    this.update = true;
                })
                .catch(() => {
                    this.$snotify.error('Erro ao carregar o produto')
                })
        },

        destroy(id) {
            this.$store.dispatch('destroyProduct', id)
                .then(() => {
                    this.$snotify.success('Deletado com sucesso!');

                    this.loadProducts(1);
                })
                .catch(() => this.$snotify.error('Erro ao Deletar'))
        },

        searchForm(filter) {
            this.search = filter;

            this.loadProducts(1);
        },

        hideModal() {
            this.showModal = false;
        },

        success() {
            this.hideModal();

            this.loadProducts(1);
        },

        reset() {
            this.product = {
                id: '',
                    name: '',
                    description: '',
                    category_id: ''
            }
        }
    },
    components: {
        pagination: PaginateComponent,
        search: SearchComponent,
        Vodal,
        ProductFormComponent,
        destroy: ButtonDestroyComponent
    }
}
</script>

<style scoped>
.img-list {
    max-width: 100px;
}
</style>
