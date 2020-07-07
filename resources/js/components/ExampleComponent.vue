<template>
    <section class="container p-3 m-3">
        <div class="row mx-0 justify-content-between">
            <strong>Gestión de productos</strong>
            <button type="button" class="btn btn-info br-20" name="button" @click="modalCrear">
                Crear producto
            </button>
        </div>
        <div class="row mx-0">
            <div class="col">
                <div class="row">
                    <span class="my-auto mr-2">Nombre del producto</span>
                    <input v-model="nombre_producto" type="text" name="" value="" />
                    <button type="button" class="btn ml-2 btn-secondary" name="button" @click="filtro">Buscar</button>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="custom-control custom-checkbox mx-2">
                        <input v-model="check_todos" type="checkbox" class="custom-control-input" id="customCheck1"  @change="cambioEstado">
                        <label class="custom-control-label" for="customCheck1">Mostrar todos</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-2">
                        <input v-model="check_activos" type="checkbox" class="custom-control-input" id="customCheck2" @change="cambioEstado">
                        <label class="custom-control-label" for="customCheck2">Activos</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-2">
                        <input v-model="check_inactivos" type="checkbox" class="custom-control-input" id="customCheck3" @change="cambioEstado">
                        <label class="custom-control-label" for="customCheck3">Inactivos</label>
                    </div>
                    <div class="custom-control custom-checkbox mx-2">
                        <input v-model="check_pendientes" type="checkbox" class="custom-control-input" id="customCheck4" @change="cambioEstado">
                        <label class="custom-control-label" for="customCheck4">Pendientes</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0 my-3">
            <div class="col">
                <table class="table head-blue">
                    <thead>
                        <tr>
                            <th scope="col">Nombre producto</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Existencia</th>
                            <th scope="col">Bodega</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(producto,p) in productos.filter(data => !nombre_producto || data.nombre.toLowerCase().includes(nombre_producto.toLowerCase()))" :key="p" >
                            <th>
                                <div class="row mx-0">
                                    <img height="24" src="/icon/check-circle.svg" alt="">
                                    <p class="my-auto">{{producto.nombre}}</p>
                                </div>
                            </th>
                            <td>{{producto.codigo}}</td>
                            <td>{{producto.existencia}}</td>
                            <td>{{producto.bodega.nombre}}</td>
                            <td>{{producto.descripcion}}</td>
                            <td>
                                <img height="24" class="cr-pointer" src="/icon/pencil.svg" alt="" @click="modalEditar(producto)">
                            </td>
                            <td>
                                <div :class="`${producto.estado === 1 ? 'bg-success' : producto.estado === 2 ? 'bg-danger' : 'bg-warning'} text-white px-2`">
                                    {{producto.estado === 1 ? 'activo' : producto.estado === 2 ? 'inactivo' : 'pendiente'}}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mx-0 p-1 bg-info text-white">
                    <span class="mx-2">productos registrados: {{productos_contar.total}} </span>
                    <span class="mx-2">Productos activos: {{productos_contar.activos}}</span>
                    <span class="mx-2">Productos inactivos: {{productos_contar.inactivos}}</span>
                    <span class="mx-2">Productos pendientes: {{productos_contar.pendientes}}</span>
                </div>
                <div class="row mx-0 my-3">
                    <div class="bg-yellow justify-content-center" style="width:50px;height:50px;display:flex;">
                        <img height="45" width="45" src="https://image.flaticon.com/icons/svg/30/30870.svg" alt="">
                    </div>
                    <div class="col">
                        <div class="row mx-0 border-bottom-yellow">
                            Estadisticas generales
                        </div>
                        <div v-for="data in bodegas" :key="data.id" class="row mx-0 border-bottom-yellow f-12">
                            {{data.productos_count}} producto en bodega {{data.nombre}}
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <modal ref="crear" @listar="listar_productos" />
    </section>
</template>

<script>
export default {
    components: {
        modal : () => import('../components/Modal')
    },
    data () {
        return {
            productos:[],
            bodegas:[],
            nombre_producto: '',
            check_todos:false,
            check_activos:false,
            check_inactivos:false,
            check_pendientes:false,
            productos_original: [],
            productos_contar:{
                total:null,
                activos:null,
                inactivos:null,
                pendientes:null,
            }  
        }
    },
    computed: {
        
    },
    mounted() {
        this.listar_productos()
    },
    methods: {
        async listar_productos(){
            try {
                await axios.get('/api/productos/listar').then(res=>{
                    this.productos = res.data.productos
                    this.productos_original = res.data.productos
                    this.bodegas = res.data.bodegas
                    this.productos_contar = res.data.productos_contar
                })
            } catch (error) {
                console.log(error)
            }
        },
        modalCrear(){
            this.$refs.crear.toggle(this.bodegas)
        },
        modalEditar(data){
            this.$refs.crear.toggle(this.bodegas,data)
        },
        filtro(){
           this.productos =  this.productos.filter(data => !nombre_producto || data.nombre.toLowerCase().includes(nombre_producto.toLowerCase()))
        },
        cambioEstado(){
            if (this.check_todos) {
                this.listar_productos()
                this.check_activos = false
                this.check_inactivos = false
                this.check_pendientes = false
            } else if (this.check_activos && this.check_inactivos && this.check_pendientes) {
                this.productos = this.productos_original.filter(data => data.estado === 1 && data.estado === 2 && data.estado === 3)
            } else if (this.check_activos && this.check_inactivos) {
                this.productos = this.productos_original.filter(data => data.estado === 1 || data.estado === 2)                
            } else if (this.check_inactivos && this.check_pendientes) {
                this.productos = this.productos_original.filter(data => data.estado === 2 || data.estado === 3)                
            } else if (this.check_activos && this.check_pendientes) {
                this.productos = this.productos_original.filter(data => data.estado === 1 || data.estado === 3)
            } else if (this.check_pendientes) {
                this.productos = this.productos_original.filter(data => data.estado === 3)                
            } else if (this.check_activos) {
                this.productos = this.productos_original.filter(data => data.estado === 1)                
            } else if (this.check_inactivos) {
                this.productos = this.productos_original.filter(data => data.estado === 2)                
            }
        }
    }
}
</script>

<style lang="scss">
.br-20{
    border-radius: 20px;
}
.head-blue{
    thead{
        tr{
            background: #007bff !important;
            color: white !important;
        }
    }
}
.f-22{
    font-size: 22px;
}
.f-12{
    font-size: 12px;
}
.text-blue{
    color: #007bff;
}
.text-yellow{
    color: #ffc107;
}
.bg-yellow{
    background: #ffc107;
}
.my-auto{
    margin-top: auto;
    margin-bottom: auto;
}
.cr-pointer{
    cursor:pointer;
}
</style>
