<?php

    namespace App\Controllers;

use App\Models\Provider;

    class ProvidersController extends BaseController{

        public function index(){
            $proveedores = new Provider();
            $query = $proveedores->findAll();
            return view("proveedores",[
                "title" => "Listado de Proveedores",
                "proveedores" => $query
            ]);
        }
    }