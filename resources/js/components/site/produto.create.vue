<template>
    <div>
        <a   data-toggle="modal" data-target="#CreateModal" ref="#" class="btn btn-primary btn-sm float-right">Novo</a>

        <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-ms">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Novo Produto</h5>
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

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" @click.prevent="storeProduto" class="btn btn-primary btn-sm">cadastrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {VMoney} from 'v-money'
    export default {
        data() {
            return {
                categorias: [],
                categoria_id : '',
                nome         : '',
                descricao    : '',
                valor_a_vista: '',
                valor_a_prazo: '',
                quantidade   : '',
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
            storeProduto() {
                axios.post('http://127.0.0.1:8000/api/produto/',{
                    categoria_id : this.categoria_id ,
                    nome         : this.nome ,
                    descricao    : this.descricao ,
                    valor_a_vista: this.valor_a_vista ,
                    valor_a_prazo: this.valor_a_prazo ,
                    quantidade   : this.quantidade ,
                }).then(response => {
                    if(response.data.create_produto){
                        this.categoria_id       = '';
                        this.nome               = '';
                        this.descricao          = '';
                        this.valor_a_vista      = '';
                        this.valor_a_prazo      = '';
                        this.quantidade         = '';
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
            }
        } 
    }
</script>