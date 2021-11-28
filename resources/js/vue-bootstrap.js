import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Vuex from 'vuex';
import VueResource from 'vue-resource';

import '../sass/bootvue.scss';
import './constantes';
import {resourceTask} from "./constantes";

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(Vuex);
Vue.use(VueResource);

Vue.component('task-table-component', require('./components/TaskTableComponent').default);
// let comp = require('./components/TaskTableComponent').default;
// console.log(comp);

const app = new Vue({
    el: "#app"
    , data: {
        search: '',
        newItem: '',
        description: '',
        notes: '',
        finished: false
    }
    , computed: {
        changeSearch() {
            console.log(this.search)
            return this.search;
        }
    }
    , watch: {
        search: function (val) {
            console.log(`Item ${this.search} - ${val}`);
        }
    }
    , methods: {
        handleShow() {
            alert("handleShow add task");
        },
        addItem() {
            console.log('Add Item');
            let url = resourceTask;
            let data = {
                'description': this.description,
                'notes': this.notes,
                'finished': this.finished
            }
            this.$http.post(url, data)
                .then(response => {
                    console.log(response.status);
                    if (response.status === 201) this.$refs.tableComp.list();
                });
        }
    }

});

console.log(app);
