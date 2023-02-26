<template>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h5></h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-12 mx-2 mb-3">
                                    <label for="user">Usuário</label>
                                    <input type="text" placeholder="E-mail do cliente" ref="email" class="form-control"
                                        name="email" />
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group col-md-12 mx-2">
                                    <label for="user">Senha</label>
                                    <input type="password" placeholder="Senha do cliente" ref="senha" class="form-control"
                                        name="senha" />
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <button class="btn btn-success float-end mt-2">Cadastrar</button>
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