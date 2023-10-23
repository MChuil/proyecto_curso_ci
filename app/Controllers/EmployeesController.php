<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employee;

class EmployeesController extends BaseController
{
    public function index()
    {
        $empleado = new Employee();
        $clave = password_hash("12345678", PASSWORD_DEFAULT);
        $data = [
            "name" => "Daniel Martinez", 
            "email" => "danny@gmail.com", 
            "password" =>  $clave, 
            "rol" => "1",
            "created_at" => date('Y-m-d H:i:s')
        ];
        $empleado->insert($data);
        echo "Empleado creado...";
    }
}
