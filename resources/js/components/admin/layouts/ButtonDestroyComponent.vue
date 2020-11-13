<template>
    <div>
        <a href="#" @click.prevent="confirmDelete(item)" class="btn btn-danger">Remover</a>

    </div>
</template>

<script>
export default {
    props: {
        item: {
            require: true,
            type: Object
        }
    },
    methods: {
        confirmDelete(item) {
            this.$snotify.error(`Deseja realmente deletar o ${item.name}?`, item.name, {
                timeout: 2000,
                showProgressBar: false,
                closeOnClick: true,
                pauseOnHover: true,
                buttons: [
                    { text: 'Não', action: () => console.log('Não...') },
                    { text: 'Sim', action: () => this.$emit('destroy', item.id) },
                ]
            });
        },
    }
}
</script>

<style scoped>

</style>
