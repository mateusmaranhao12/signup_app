<template>
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

                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12 mx-2">
                                    <label for="user">Usuário</label>
                                    <input type="text" placeholder="E-mail do cliente" ref="usuario"
                                        class="form-control mb-3" name="usuario" />
                                </div>
                                <div class="form-group col-md-12 mx-2">
                                    <label for="user">Senha</label>
                                    <input type="password" placeholder="Senha do cliente" ref="senha" class="form-control"
                                        name="senha" />
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success float-end mt-2">Fazer login</button>
                            </div>
                        </form>

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
                        <tr>
                            <td>1</td>
                            <td>Mateus</td>
                            <td>@feradourada@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Index'
}
</script>