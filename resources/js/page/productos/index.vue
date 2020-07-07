<template>
    <section class="container">
        <div class="row mx-0 justify-content-between">
            <strong>Gestión de productos</strong>
            <button type="button" class="btn btn-info br-20" name="button">
                Crear producto
            </button>
        </div>
        <div class="row mx-0">
            <div class="col">
                <div class="row">
                    <span class="my-auto">Nombre del producto</span>
                    <input type="text" name="" value="" />
                    <button type="button" class="btn btn-secondary" name="button">Buscar</button>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Mostrar todos</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Activos</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Inactivos</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Pendientes</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-0">
            <div class="col">
                <table class="table head-blue">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">
                                <i class="icon-ok-circled f-22 text-blue" />
                                <p class="my-auto">Lorem ipsum dolor sit amet, consectetur adipi.</p>
                            </th>
                            <td>00000</td>
                            <td>4</td>
                            <td>@mcentrodo</td>
                            <td>Lorem ipsum dolor sit amet.</td>
                            <td>
                                <i class="icon-pencil f-22 cr-pointer" />
                            </td>
                            <td>
                                <div class="bg-success text-white px-2">
                                    activo
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mx-0 p-1 bg-blue text-white">
                    <span class="mx-2">productos registrados: 0 </span>
                    <span class="mx-2">Productos activos: 0</span>
                </div>
                <div class="row mx-0 my-3">
                    <div class="bg-yellow justify-content-center" style="width:50px;height:50px;display:flex;">
                        <img height="45" width="45" src="https://image.flaticon.com/icons/svg/30/30870.svg" alt="">
                    </div>
                    <div class="col">
                        <div class="row mx-0 border-bottom-yellow">
                            Estadisticas generales
                        </div>
                        <div class="row mx-0 border-bottom-yellow f-12">
                            1 producto en bodega cabecera
                        </div>
                        <div class="row mx-0 border-bottom-yellow f-12">
                            1 producto en bodega cabecera
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
}
</script>

<style lang="scss">
.br-20{
    border-radius: 20px;
}
.head-blue{
    thead{
        tr{
            background: #007bff!important;
            color: white!important!
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
