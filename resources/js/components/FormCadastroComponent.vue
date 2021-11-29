<template>
    <div>
        <b-form @submit.prevent>
            <b-row>
                <b-col cols="12" sm="12" md="6">
                    <b-form-group label="Nome">
                        <b-form-input
                            type="text"
                            v-model="nome"
                            placeholder="Informe seu nome completo"
                            required/>
                    </b-form-group>
                </b-col>
                <b-col cols="12" md="3" sm="12">
                    <b-form-group label="Email">
                        <b-form-input
                            type="email"
                            v-model="email"
                            placeholder="Informe seu e-mail"
                            required/>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-row>
                <b-col cols="12" md="3" sm="12">
                    <b-form-group label="Telefone">
                        <b-form-input
                            type="number"
                            v-model="telefone"
                            placeholder="Informe seu telefone"
                            required/>
                    </b-form-group>
                </b-col>
                <b-col cols="12" md="3">
                    <b-form-group label="Sexo">
                        <b-form-select
                            id="sexo"
                            v-model="sexo"
                            :options="sexos"
                            required>
                        </b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <b-button type="submit" variant="primary" @click="cadastrar" class="mr-3">Cadastrar
            </b-button>
            <b-button type="reset" v-on:click="reset" variant="danger">Resetar</b-button>
            <b-row>
                <b-col>
                    <b-icon icon="exclamation-circle-fill" variant="success"></b-icon>
                    <b-icon-arrow-up></b-icon-arrow-up>
                    <b-icon-app></b-icon-app>
                </b-col>
            </b-row>
            <b-row>
                <b-col>
                    <b-button v-on:click="showAbout" title="Detalhes">About</b-button>
                </b-col>
            </b-row>


        </b-form>
        <task-modal-component :content="content" ></task-modal-component>
    </div>
</template>

<script>

import TaskModalComponent from "./TaskModalComponent";

export default {
    name: "FormCadastroComponent"
    , components: {
        TaskModalComponent
    }
    , methods: {
        cadastrar() {
            console.log(`Cadastrando registro ${this.nome} - ${this.telefone} - ${this.email}`);
        },
        reset() {
            this.nome = null;
            this.email = null;
            this.telefone = null;
            this.sexo = null;
        },
        showAbout() {
            this.$bvModal.show('modal-about');
            console.log('showAbout')
        }
    }
    , data() {
        return {
            email: null,
            nome: null,
            sexo: null,
            telefone: null,
            sexos: [
                {text: "Selecione", value: null},
                "Masculino",
                "Feminino",
                "Outros"
            ]
        }
    },
    computed: {
        content() {
            return `Nome: ${this.nome} - Telefone: ${this.telefone} - Email: ${this.email}`;
        }
    }
}
</script>

<style scoped>

</style>
