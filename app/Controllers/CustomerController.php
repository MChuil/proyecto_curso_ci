<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;

class CustomerController extends BaseController
{
    public function index()
    {
        //
    }


    public function search(){
        $buscar = $_GET["searchTerm"];
        $customers = new Customer();
        $customers->select('id, name');
        $customers->like('name', $buscar, 'both');
        echo json_encode($customers->findAll());
        return;
    }
}
