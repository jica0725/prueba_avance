<template>
    <div ref="modal" class="modal fade" :id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div :class="`modal-dialog modal-dialog-centered modal-lg`" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <div class="row w-100 mx-0 mt-2 bg-inf ">
                        <h5 class="modal-title col my-auto text-center">Crear Producto</h5>
                        <hr>
                    </div>
                </div>
                <div class="modal-body overflow-auto custom-scroll" style="max-height:70vh;">
                    <div class="row mx-0 justify-content-center">
                        <div class="col-10 text-left">
                            <label for="nombre">Nombre del producto</label>
                            <input v-model="model.nombre" id="nombre" type="text" class="form-control mb-3" />
                            <div class="row mx-0 my-3">
                                <div class="col pl-0">
                                    <label for="cod">Código</label>
                                    <input v-model="model.codigo" id="cod" type="text" class="form-control mb-3" />
                                </div>
                                <div class="col pr-0">
                                    <label for="existencia">Existencia</label>
                                    <input v-model="model.existencia" id="existencia" type="text" class="form-control mb-3" />
                                </div>
                            </div>
                            <div class="row mx-0 my-3">
                                <div class="col pl-0">
                                    <label>Bodega</label>
                                    <select v-model="model.id_bodega" class="custom-select" id="inputGroupSelect01">
                                        <option v-for="data in bodegas" :key="data.id" :value="data.id">{{data.nombre}}</option>
                                    </select>
                                </div>
                                <div class="col pr-0">
                                    <label>Estado</label>
                                     <select v-model="model.estado" class="custom-select" id="inputGroupSelect01">
                                        <option selected>Selecciona estado</option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                        <option value="3">Pendiente</option>
                                    </select>
                                </div>
                            </div>
                            <label for="descripcion">Descripción</label>
                            <textarea v-model="model.descripcion" class="form-control" id="descripcion" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer row mx-0 justify-center">
                    <button type="button" class="btn mx-2 btn-secondary" name="button" @click="cancelar">Cancelar</button>
                    <button type="button" class="btn mx-2 btn-success" name="button" @click="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const generar_aletorio = () => {
    return  Math.floor(Math.random() * 101);
}
export default {
    
    data(){
        return {
            modal:`modal-${generar_aletorio()}`,
            model:{
                id:null,
                nombre:'',
                codigo:null,
                existencia:null,
                id_bodega:null,
                estado:null,
                descripcion:'',
            },
            estados: [
                { value: 1, label: 'Activo' },
                { value: 2, label: 'Inactivo' },
                { value: 2, label: 'Pendiente' },
            ],
            bodegas: []
        }
    },
    methods:{
        toggle(bodegas,data){
            this.bodegas = bodegas
            if (data) {
                this.model.id = data.id
                this.model.nombre = data.nombre
                this.model.codigo = data.codigo
                this.model.existencia = data.existencia
                this.model.id_bodega = data.id_bodega
                this.model.estado = data.estado
                this.model.descripcion = data.descripcion
            }
            $(this.$refs.modal).modal('toggle')
        },
        async guardar(){
            try {
                if (this.model.id === null) {
                    
                    await axios.post('/api/productos/crear',this.model).then(res=>{
                        $(this.$refs.modal).modal('toggle')
                        this.$emit('listar')
                    })
                } else {
                    await axios.put(`/api/productos/${this.model.id}/editar`,this.model).then(res=>{
                        $(this.$refs.modal).modal('toggle')
                        this.$emit('listar')
                    })
                }
            } catch (error) {
                console.log(error)
            }
        },
        cancelar(){
            $(this.$refs.modal).modal('toggle')
        }
    }
}
</script>

<style lang="scss" scoped>

.modal-content{
    border: none;
    border-radius: 8px;

    .modal-header{
        // background:linear-gradient( rgba(50,163,253,.65) 1% , rgba(255,255,255,1) , rgba(255,255,255,1), rgba(255,255,255,1) );
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
        border-bottom: none;
        background-size: cover;

        .close{
            outline: none;
            transition-duration: .85s;
            position: absolute;
            right: 10px;
            top: 1px;
            font-size: 2.5em;

            &:hover{
                transition-duration: .4s;
                transform: rotate(360deg) scale(1.2);
            }
        }
        .logo{
            display: block;
            // height: 70px;
            // width: 70px;

            span{
                font-size: 1.2em;
            }
        }
    }
    .modal-title{
        color: #000000;
        font-weight: normal;
    }
}
</style>
