<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Workshop Bootstrap-Vue</title>

    <style>
        .container {
            margin-top: 20px;
        }
    </style>

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand active href="{{ url("/") }}">Home</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
{{--                    <b-nav-item v-b-modal.modal-add>Adicionar</b-nav-item>--}}
                    <b-nav-item href="{{ url("/other") }}">Other</b-nav-item>
                    <b-nav-item v-b-modal.modal-add>New task</b-nav-item>
                </b-navbar-nav>

                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-form>
                        <b-form-input size="sm" v-model:size="search" class="mr-sm-2"
                                      placeholder="Search"></b-form-input>
                        <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
                    </b-nav-form>

                    <b-nav-item-dropdown text="Lang" right>
                        <b-dropdown-item href="#">EN</b-dropdown-item>
                        <b-dropdown-item href="#">ES</b-dropdown-item>
                        <b-dropdown-item href="#">RU</b-dropdown-item>
                        <b-dropdown-item href="#">FA</b-dropdown-item>
                    </b-nav-item-dropdown>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>

        <main class="py-4">
            <b-container fluid="md" class="container">
                <b-row>
                    <b-col>
                        <task-table-component ref="tableComp" :search="search" />
                    </b-col>
                </b-row>
            </b-container>
        </main>

        <b-modal
            id="modal-add"
            title="Add Item"
            ok-title="Aplicar"
            @ok="addItem"
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
{{--                    <b>Status {{ finished }}</b>--}}
                    <b>Concluída</b>
                </b-form-checkbox>
            </b-container>
        </b-modal>

    </div>
</body>
</html>
