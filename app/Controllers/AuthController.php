<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employee;
use Config\Cookie;

class AuthController extends BaseController
{
    public function __construct()
    {
        session();
    }

    public function index()
    {
        $data = [];
        if(!empty($_COOKIE['email'])){
            $data = [
                'email' => $_COOKIE['email'],
                'password' => $_COOKIE['password']
            ];
        }
        return view("auth/login", $data);
    }

    public function auth(){
        // Validando datos
        $validation = $this->validate([
            "email"=> [
                "rules" => "required|max_length[255]|valid_email",
                "errors" =>[
                    "required" => "El campo correo es obligatorio",
                    "email" => "El correo no es correcto",
                    "max_length" => "El correo no puede ser mayor a 255 caracteres" 
                ]
            ],
            "password" => [
                "rules" => "required|min_length[8]|max_length[30]",
                "errors" =>[
                    "required" => "El campo clave es obligatorio",
                    "min_length" => "La clave debe ser de 8 o mas caracteres",
                    "max_length" => "La clave no puede ser mayor a 30 caracteres" 
                ]
            ]
        ]);
        if($validation == false){ //si es false
            return redirect()->back()->with("errors", $this->validator->getErrors() )->withInput();
        }
        //Validar credenciales con base de datos
        try {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $employee = new Employee();
            $user = $employee->where("email", $email)->first();
            if(empty($user)){  //si no encontro el email
                return redirect()->back()->with("errors", ["El correo y/o contraseña no es correcto"]);
            }


            //validar contraseña
            if(!password_verify($password, $user['password'])){ //si no son iguales
                return redirect()->back()->with("errors", ["El correo y/o contraseña no es correcto"]);
            }

            //Remember
            $remember = $this->request->getPost("remember");
            if($remember == 1){
                setcookie('email', $email, time() + 3600);
                setcookie('password', $password, time() + 3600);
            }else{
                setcookie('email', $email, time()-3600);
                setcookie('password', $password, time()-3600);
            }

            //se guardan los datos de sesión
            session()->set([
                "user_id" => $user['id'],
                "nombre" => $user['name'],
                "email" => $user['email'],
                "is_logged" => true,
                "rol" => $user['rol']
            ]);

            return redirect()->to(base_url("/tablero"));

        } catch (\Throwable $th) {
            return redirect()->back()->with("errors", [$th->getMessage()]);
        }
    }

    public function logout(){
        session_destroy();  //se eliminan todas las variables de sesion
        return redirect()->to(base_url('/')); //redirijo a el login
    }
}
