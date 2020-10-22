<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="m-0 font-weight-bold text-primary float-left">Lista de Produtos</div>
                        <create></create>
                    </div>
                    <div class="card-body">
                        <div class="table table-hover table-responsive" style="max-width: 1200px">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="something">
                                        <th scope="col">#</th>
                                        <th>Categoria</th>
                                        <th>Nome</th>
                                        <th>Valor à vista</th>
                                        <th>Valor à prazo</th>
                                        <th>quantidade</th>
                                        <th>ação</th>
                                       <!--  <th>cadastrado em</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(produto, index) in produtos.data" :key="produto.id">
                                        <th scope="row">{{index+1}}</th>
                                        <td>{{produto.categoria}}</td>
                                        <td>{{produto.nome}}</td>
                                        <td>{{produto.valor_a_vista}}</td>
                                        <td>{{produto.valor_a_prazo}}</td>
                                        <td>{{produto.quantidade}}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#ShowModal" ref="#"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                            <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#" ref="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#" ref="#"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </td>
                                        <!-- <td>{{produto.created_at}}</td> -->
                                    </tr>
                                </tbody>
                            </table> 
                            <pagination :data="produtos" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ShowModal" tabindex="-1" role="dialog" aria-labelledby="ShowModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-ms">
                <div class="modal-content">
                    <div class="modal-header"> 
                        <div id='btn'></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div  id="aguardando" >
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div class='card'>
                            <div class='card-body'>
                                <div id="conteudo">
                                </div>
                                
                                <ul><div style="color: darkgreen">Elenco:</div>
                                    <div id='lista'></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

	data() {
		return {
            produtos: {},
		}
	},

	mounted() {
		this.getResults();
	},

	methods: {
		getResults(page = 1) {
			axios.get('http://127.0.0.1:8000/api/produto/?page=' + page)
            .then(response => {
                this.produtos = response.data.produtos;
            });
		}
	}
}
</script>