<template>
    <b-modal
        id="modal-about"
        title="Detalhes"
    >
        <b-container fluid>
            <p>{{ content }}</p>
        </b-container>
    </b-modal>
</template>

<script>
export default {
    name: "TaskModalComponent",
    props: ['content']
}
</script>

<style scoped>

</style>
