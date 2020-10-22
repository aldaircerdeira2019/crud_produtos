<template>
    <div>
        <a   data-toggle="modal" data-target="#CreateModal" ref="#" class="btn btn-primary btn-sm float-right">Novo</a>

        <div class="modal fade" id="CreateModal" tabindex="-1" role="dialog" aria-labelledby="CreateModalLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-ms">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Novo Prduto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <form>
                            <!-- <div class="form-group">
                                <label for="categoria_id" class="col-form-label">Id da categoria:</label>
                                <input type="text"class="form-control" id="categoria_id" required placeholder="ID integer">
                            </div> -->
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
                categoria_id         : '1',
                nome         : '',
                descricao    : '',
                valor_a_vista: '',
                valor_a_prazo: '',
                quantidade   : '',
                errors        : [],
                money: {
                    decimal: ',',
                    thousands: '.',
                    prefix: 'R$ ',
                    precision: 2,
                    masked: false 
                }
            }
        },

        /* mounted() {
            this.getResults();
        },*/

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
                    
                    if(response.data.errors){
                        this.errors = response.data.errors;
                    }
                });
            }
        } 
    }
</script>