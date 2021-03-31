const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
        'resources/js/Controllers/Menu/MenuCtrl.js',
        'resources/js/Controllers/Reportes/ReportesCtrl.js',
        'resources/js/Controllers/Ajustes/UsuariosCtrl.js',
        'resources/js/Controllers/Ajustes/AjustesCtrl.js',
        'resources/js/Controllers/Admin/EscritorioCtrl.js',
        'resources/js/Controllers/Admin/RegistroCtrl.js',
        'resources/js/Controllers/Admin/ClientesCtrl.js',
        'resources/js/Controllers/Admin/ProviderCtrl.js',
        'resources/js/Controllers/Pedidos/PedidosCtrl.js',
        'resources/js/Controllers/Inventario/InventarioCtrl.js',
        'resources/js/Controllers/Venta/VentaCtrl.js',
        'resources/js/modulos/Ventana_modal.js',
        'resources/js/modulos/Helper.js',
        'resources/js/modulos/styleMap.js',
        'resources/js/modulos/GlobalChart.js',

    ],'public/js/Controller/Controllers.js');
