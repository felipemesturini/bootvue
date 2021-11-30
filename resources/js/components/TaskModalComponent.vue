<template>
    <b-modal
        id="modal-about"
        title="Detalhes"
        @ok="okClicked"
    >
        <b-container fluid>
            <p>{{ content }}</p>
        </b-container>
    </b-modal>
</template>

<script>
export default {
    name: "TaskModalComponent",
    props: ['content'],
    methods: {
        okClicked() {
            this.$emit('modalClicked', 'Alteracao');
        }
    }
}
</script>

<style scoped>

</style>
