<template>
    <div>
        You are search for {{ search }}
        <b-form-checkbox v-model="onlyFinished" name="only-finished" switch>
            Show only <b>Status {{ onlyFinished }}</b>
        </b-form-checkbox>
        <b-table striped hover :fields="taskFields" :items="filterTasks">
            <template #cell(actions)="{ item }">
                <b-button variant="primary" v-b-modal="'modal-edit'" @click="selectItem(item)">
                    Edit
                </b-button>
                <b-button variant="danger" v-b-modal="'modal-delete'" @click="selectItem(item)">
                    Delete
                </b-button>
                <b-button variant="secondary" @click="testPost">
                    Post Data
                </b-button>
            </template>
        </b-table>
        <b-modal
            id="modal-delete"
            title="Delte Item"
            ok-title="Sim"
            cancel-title="Não"
            @ok="removeItem"
        >
            <p class="my-1">Remover item?</p>
        </b-modal>

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
    </div>
</template>

<script>
import {resourceTask} from "../constantes";

export default {
    name: "TaskTableComponent.vue"
    , props: {
        search: String
    }
    , data() {
        return {
            items: [
                {id: 40, description: 'Task 1', notes: 'Aditional info', finished: false}
            ],
            onlyFinished: false,
            taskFields: ['description', 'notes', 'finished', 'actions'],
            selectedItem: null,
            description: '',
            notes: '',
            finished: false
        }
    }
    , watch: {}
    , computed: {
        filterTasks() {
            console.log('Filter task ');
            let result = [];
            if (this.search) {
                let regEx = new RegExp(this.search.trim(), 'i');
                result = this.items.filter(item =>
                    regEx.test(item.description)
                    || regEx.test(item.notes));
            } else {
                result = this.items;
            }
            if (this.onlyFinished) {
                result = result.filter(item => item.finished);
            }

            return result;
        }
    }
    , created() {
        this.list();
    }
    , methods: {
        list() {
            let url = resourceTask;
            this.$http.get(url)
                .then(res => res.json())
                .then(data => {
                    console.log(data.data);
                    this.items = data.data
                }, err => console.log(err));

        },
        removeItem() {
            let url = resourceTask + '/' + this.selectedItem.id;
            this.$http.delete(url).then(response => {
                console.log(response.status);
                console.log(response.text());
                if (response.status !== 204) return
                let index = this.items.findIndex(item => item.id === this.selectedItem.id);
                if (index !== -1) this.items.splice(index, 1)
                this.selectedItem = null
            });
        },
        editItem() {
            let url = resourceTask + '/' + this.selectedItem.id;
           let data = {
                'description': this.description,
                'notes': this.notes,
                'finished': this.finished
            }
            this.$http.put(url, data)
                    .then(response => {
                        console.log(response.status);
                        if (response.status === 200) this.list();
                    });
        },
        selectItem(item) {
            console.log('Select');
            console.log(item);
            this.selectedItem = item
            this.description = this.selectedItem.description;
            this.notes = this.selectedItem.notes;
            this.finished = this.selectedItem.finished;
        },
        testPost() {
            let url = resourceTask + '/3';
            console.log(url)
            // let formData = new FormData();
            // formData.append('description', 'Loren Ipsum');
            // formData.append('notes', 'Loren Ipsum');
            // formData.append('finished', true ? 1: 0);
            let data = {
                'description': 'Loren Ipsum',
                'notes': 'Notes Ipsum',
                'finished': true
            }
            let response = this.$http.put(url, data, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });
            console.log(response);
            response.then(data => console.log(data.json()));
        }
    }
}
</script>
