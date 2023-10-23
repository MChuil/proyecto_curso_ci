<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::index', ['filter'=>'public']);
$routes->post("/auth", "AuthController::auth");

// Grupo de rutas protegidas por el filtro 'auth'
$routes->group("",['filter'=> "auth"], function($routes){
    $routes->get("/tablero", "DashboardController::index");
    $routes->post("salir", "AuthController::logout");
    $routes->get("/productos", "ProductsController::index"); //lista los productos
    $routes->get("/productos/nuevo", "ProductsController::create"); //vista de nuevo
    $routes->get("/productos/(:num)/editar", "ProductsController::edit/$1");
    $routes->post("/productos", "ProductsController::save"); //guardar nuevo
    $routes->put("/productos", "ProductsController::update");
    $routes->delete("/productos/(:num)", "ProductsController::delete/$1");
    $routes->get("/buscar/producto", "ProductsController::search");
    
    $routes->get("/proveedores", "ProvidersController::index");
    $routes->get("empleado/nuevo", "EmployeesController::index");
    
    $routes->get("/venta", "SalesController::index");
    $routes->post("/venta", "SalesController::index");
    $routes->get("/venta/reporte", "SalesController::reporte");
    $routes->post("/venta/reporte", "SalesController::reporte");
    $routes->get("/venta/pdf", "SalesController::pdf");

    $routes->get("sales/cancel", "SalesController::cancel");
    $routes->post("sales/confirm", "SalesController::save");

    $routes->get("/buscar/cliente", "CustomerController::search");
});











// $routes->get('lo que vera el usuario en la url', 'Controllador::metodo')





if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
