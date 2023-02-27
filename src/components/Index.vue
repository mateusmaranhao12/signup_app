<template>
    <div v-if="mensagem_sucesso" class="alert alert-success alert-dismissible fade show" role="alert">
        <h5></h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div v-if="mensagem_erro" class="alert alert-danger alert-dismissible fade show" role="alert">
        <h5></h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto offset-md-2">
                <div class="card my-4">
                    <div class="card-header bg-success">
                        <h4 class="h card-title p-3 text-center text-white">
                            SignUp App
                        </h4>
                    </div>
                    <div class="card-body">

                        <div>
                            <div class="form-row">
                                <div class="form-group col-md-12 mx-2 mb-3">
                                    <label for="user">Nome</label>
                                    <input type="text" placeholder="Nome do cliente" ref="nome" class="form-control"
                                        name="nome" v-model="informacoes_registro.nome" />
                                    <span v-if="erro_nome" class="text-danger"></span>
                                </div>
                                <div class="form-group col-md-12 mx-2 mb-3">
                                    <label for="user">E-mail</label>
                                    <input type="text" placeholder="E-mail do cliente" ref="email" class="form-control"
                                        name="email" v-model="informacoes_registro.email" />
                                    <span v-if="erro_email" class="text-danger"></span>
                                </div>
                                <div class="form-group col-md-12 mx-2">
                                    <label for="user">Senha</label>
                                    <input type="password" placeholder="Senha do cliente" ref="senha" class="form-control"
                                        name="senha" v-model="informacoes_registro.senha" />
                                    <span v-if="erro_senha" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button @click="registrarCliente()"
                                    class="btn btn-success float-end mt-2">Cadastrar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-8 mt-4 offset-md-2">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cliente in clientes" :key="cliente.id">
                            <td>{{ cliente.id }}</td>
                            <td>{{ cliente.nome }}</td>
                            <td>{{ cliente.email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

//import axios from 'axios'

import axios from 'axios'
export default {
    name: 'Index',

    el: '#register',

    data() {
        return {
            mensagem_sucesso: '',
            mensagem_erro: '',
            erro_nome: '',
            erro_email: '',
            erro_senha: '',
            clientes: [],
            informacoes_registro: { nome: '', email: '', senha: '' }
        }
    },

    mounted() {
        this.getClientes()
    },

    methods: {

        getClientes() {
            axios.get('http://localhost/Projetos/signup_app/src/api/api.php')
                .then((res) => {
                    if (res.data.error) {
                        this.mensagem_erro = res.data.mensagem
                    }
                    else {
                        this.clientes = res.data.clientes
                    }
                });
        },

        registrarCliente() {
            console.log(this.informacoes_registro)

            this.limparFormulario()
        },

        limparFormulario() {
            this.informacoes_registro.nome = '',
                this.informacoes_registro.email = '',
                this.informacoes_registro.senha = ''
        }
    }
}
</script>