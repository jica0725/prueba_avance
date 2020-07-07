const GestionProductos = () => import('~/pages/productos').then(m => m.default || m)

export default [
    {
        path: '/gestion-productos',
        name: 'gestion.productos',
        component: GestionProductos
    },
]
