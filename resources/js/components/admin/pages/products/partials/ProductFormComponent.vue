<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div class="form-group">
                <div v-if="imagePreview != null">
                    <img :src="imagePreview" class="image-preview">
                    <button class="btn btn-danger" @click.prevent="removeImagePreview">Remover</button>
                </div>
                <div v-else>
                    <input type="file" class="form-control" @change="onFileChange">
                </div>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" placeholder="Nome do Produto" v-model="product.name">
            </div>

            <div class="form-group">
                <textarea v-model="product.description" cols="30" rows="5" class="form-control"
                          placeholder="Descrição do Produto"></textarea>
            </div>

            <div class="form-group">
                <select class="form-control" v-model="product.category_id">
                    <option value="">Selecione a Categoria</option>
                    <option v-for="category in categories"
                            :key="category.id"
                            :value="category.id">{{ category.name }}
                    </option>
                </select>
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

        update: {
            require: false,
            type: Boolean,
            default: false
        },
        product: {
            require: false,
            type: Object,
        }
    },

    data() {
        return {
            upload: null,
            imagePreview: null
        }
    },

    computed: {
        categories() {
            return this.$store.state.categories.items.data;
        }
    },

    methods: {
        onSubmit() {
            let action = this.update ? 'updateProduct' : 'storeProduct'

            const formData = new FormData();
            if (this.upload != null) {
                formData.append('image', this.upload)
            }

            formData.append('id', this.product.id)
            formData.append('name', this.product.name)
            formData.append('description', this.product.description)
            formData.append('category_id', this.product.category_id)

            this.$store.dispatch(action, formData)
                .then(() => {
                    this.$snotify.success('Sucesso ao enviar');

                    this.reset();

                    this.$emit('success');
                })
                .catch(error => {
                    this.$snotify.error('Algo Errado', 'Erro')

                    this.errors = error.data.errors;
                })
        },

        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;

            if (!files.length)
                return

            this.upload = files[0];

            this.previewImage(files[0]);
        },

        previewImage(file) {
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imagePreview = e.target.result
            }
            reader.readAsDataURL(file);
        },

        removeImagePreview() {
            this.imagePreview = null;
            this.upload = null;
        },

        reset() {
            this.product = {
                id: '',
                name: '',
                description: '',
                category_id: 1
            }
        }
    }
}
</script>

<style scoped>
.image-preview {
    max-width: 60px;
}
</style>
