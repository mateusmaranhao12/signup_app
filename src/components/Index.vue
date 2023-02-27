<template>
    <div id="registrar">
        <div v-if="mensagem_sucesso" class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>{{ mensagem_sucesso }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="fecharMensagem()"></button>
        </div>
        <div v-if="mensagem_erro" class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>{{ mensagem_erro }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" @click="fecharMensagem()"></button>
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
                                        <span v-if="erro_nome" class="text-danger">{{ erro_nome }}</span>
                                    </div>
                                    <div class="form-group col-md-12 mx-2 mb-3">
                                        <label for="user">E-mail</label>
                                        <input type="text" placeholder="E-mail do cliente" ref="email" class="form-control"
                                            name="email" v-model="informacoes_registro.email" />
                                        <span v-if="erro_email" class="text-danger">{{ erro_email }}</span>
                                    </div>
                                    <div class="form-group col-md-12 mx-2">
                                        <label for="user">Senha</label>
                                        <input type="password" placeholder="Senha do cliente" ref="senha" class="form-control"
                                            name="senha" v-model="informacoes_registro.senha" />
                                        <span v-if="erro_senha" class="text-danger">{{ erro_senha }}</span>
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
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cliente in clientes" :key="cliente.Id">
                                <td>{{ cliente.Id }}</td>
                                <td>{{ cliente.nome }}</td>
                                <td>{{ cliente.email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

//import axios from 'axios'

import axios from 'axios'
export default {
    name: 'Index',

    el: '#registrar',

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
            var registrar_formulario = this.toFormData(this.informacoes_registro)
            axios.post(
                'http://localhost/Projetos/signup_app/src/api/api.php?acao=registrar', registrar_formulario
            ).then((res) => {
                if (res.data.nome) {

                    this.erro_nome = res.data.mensagem
                    this.nomeFocus()

                } else if (res.data.email) {

                    this.erro_email = res.data.mensagem
                    this.emailFocus()

                } else if (res.data.senha) {

                    this.erro_senha = res.data.mensagem
                    this.senhaFocus()

                } else {

                    this.mensagem_sucesso = res.data.mensagem
                    this.erro_nome = ''
                    this.erro_email = ''
                    this.erro_senha = ''
                    this.limparFormulario()
                    this.getClientes()

                }

            })
        },

        nomeFocus(){
			this.$refs.nome.focus()
		},

        emailFocus(){
			this.$refs.email.focus()
		},
 
		senhaFocus(){
			this.$refs.senha.focus()
		},

        fecharMensagem() {
            this.mensagem_erro = '',
            this.mensagem_sucesso = ''
        },

        toFormData(obj) {
			var liveFormData = new FormData();
			for(var key in obj){
				liveFormData.append(key, obj[key])
			}
			return liveFormData
		},

        limparFormulario() {
            this.informacoes_registro.nome = '',
            this.informacoes_registro.email = '',
            this.informacoes_registro.senha = ''
        }
    }
}
</script>