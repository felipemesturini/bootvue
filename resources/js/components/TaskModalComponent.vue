<template>
    <b-modal
        id="modal-edit"
        title="Edit Item"
        ok-title="Aplicar"
        @ok="editItem"
    >
        <b-container fluid>
            <b-form-group
                id="group-description"
                description="Informe a descrição."
                label="Desrição"
                label-for="description"
                v-model="description"
            >
                <b-form-input id="description" v-model="description"
                              trim></b-form-input>
            </b-form-group>
            <b-form-group
                id="group-notes"
                description="Observações."
                label="Notas de lembrete"
                label-for="notes"
                v-model="notes"
            >
                <b-form-textarea id="notes" v-model="notes" trim></b-form-textarea>
            </b-form-group>
            <b-form-checkbox v-model="finished" name="finished" switch>
                <b>Status {{ finished }}</b>
            </b-form-checkbox>
        </b-container>
    </b-modal>
</template>

<script>
export default {
    name: "TaskModalComponent",
    props: ['task']
}
</script>

<style scoped>

</style>
