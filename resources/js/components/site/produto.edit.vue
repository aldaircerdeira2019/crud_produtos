<template>
    <div>
        <button class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-ms">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form>
                            <div v-if="msg" class="alert alert-success" role="alert">
                                Produto cadastrado com sucesso!
                            </div>
                            <div class="form-group">
                                <label for="categoria_id" class="col-form-label">Categoria</label>
                                <select v-model="categoria_id" type="text"  class="form-control" id="categoria_id">
                                    <option value="">selecione</option>
                                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{categoria.categoria}}</option>
                                </select>
                                <span v-if="errors.categoria_id" style="color:red;" >
                                    <strong >{{ errors.categoria_id[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="nome" class="col-form-label">Nome</label>
                                <input type="text" v-model="nome" class="form-control" id="nome" placeholder="nome">
                                <span v-if="errors.nome" style="color:red;" >
                                    <strong >{{ errors.nome[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="descricao" class="col-form-label">Descrição</label>
                                <textarea class="form-control" v-model="descricao" id="descricao" placeholder=" min 30 caracter"></textarea>
                                <span v-if="errors.descricao" style="color:red;" >
                                    <strong >{{ errors.descricao[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="valor_a_vista" class="col-form-label">Valor a vista</label>
                                <money v-bind="money" v-model="valor_a_vista" class="form-control" id="valor_a_vista" ></money>
                                <span v-if="errors.valor_a_vista" style="color:red;" >
                                    <strong >{{ errors.valor_a_vista[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="valor_a_prazo" class="col-form-label">Valor a prazo</label>
                                <money v-bind="money" v-model="valor_a_prazo" class="form-control" id="valor_a_prazo" ></money>
                                <span v-if="errors.valor_a_prazo" style="color:red;" >
                                    <strong >{{ errors.valor_a_prazo[0] }}</strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="quantidade" class="col-form-label">Quantidade</label>
                                <input type="number" v-model="quantidade" class="form-control" id="quantidade">
                                <span v-if="errors.quantidade" style="color:red;" >
                                    <strong >{{ errors.quantidade[0] }}</strong>
                                </span>
                            </div>
                            <button type="submit" @click.prevent="updateProduto(id)" class="btn btn-primary btn-sm">atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {VMoney} from 'v-money'
    export default {
     props: ['produto'],
	 data() {
		return {
            id: this.produto.id,
            categorias: [],
            categoria_id : this.produto.categoria_id,
            nome         : this.produto.nome,
            descricao    : this.produto.descricao,
            valor_a_vista: this.produto.valor_a_vista,
            valor_a_prazo: this.produto.valor_a_prazo,
            quantidade   : this.produto.quantidade,
            errors       : [],
            msg          : '',
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                precision: 2,
                masked: false 
            }
           
		}
	},

	mounted() {
        this.getCategorias();
	}, 

	methods: {
		updateProduto(id) {
            axios.put('http://127.0.0.1:8000/api/produto/'+id, {
                categoria_id : this.categoria_id ,
                nome         : this.nome ,
                descricao    : this.descricao ,
                valor_a_vista: this.valor_a_vista ,
                valor_a_prazo: this.valor_a_prazo ,
                quantidade   : this.quantidade ,
            }).then(response => {
                if(response.data.produto){
                    this.msg                = true;
                    this.errors             = '';
                }
                if(response.data.errors){
                    this.errors = response.data.errors;
                    this.msg    = '';
                }
            });
        },
        getCategorias() {
            axios.get('http://127.0.0.1:8000/api/categoria')
            .then(response => {
                if(response.data.categoria){
                    this.categorias =  response.data.categoria;
                }
            });
        },
    
	}
}
</script>