<?php

    namespace App\Controllers;
    use App\Models\Product;

    class ProductsController extends BaseController{

        public function index(){
            $productos = new Product();
            $query = $productos->findAll();

            return view("productos/index", 
                [
                    "title"     => "Listado de Productos",
                    "productos" => $query
                ]
            );
        }

        public function create(){
            return view("productos/new",['title' => 'Nuevo producto']);
        }

        public function save(){
            $validation = $this->validate([
                "code" => [
                    "rules" => "required|min_length[10]|max_length[20]",
                    "errors" => [
                        "required" => "El campo código es obligatorio",
                        "min_length" => "El código debe tener minimo 10 caracteres",
                        "max_length" => "El código no puede ser mayor a 20 caracteres" 
                    ]
                ],
                "title" => [
                    "rules" => "required|min_length[8]|max_length[255]",
                    "errors" => [
                        "required" => "El campo titulo es obligatorio",
                        "min_length" => "El titulo debe tener minimo 8 caracteres",
                        "max_length" => "El ttulo no puede ser mayor a 255 caracteres" 
                    ]
                ],
                "description" => [
                    "rules" => "required|min_length[20]",
                    "errors" => [
                        "required" => "El campo descripcion es obligatorio",
                        "min_length" => "La descripción debe tener minimo 20 caracteres",
                    ]
                ],
                "price" => [
                    "rules" => "required|numeric",
                    "errors" => [
                        "required" => "El campo precio es obligatorio",
                        "numeric" => "El precio no es numerico, verifique",
                    ]
                ], 
                "quantity" => [
                    "rules" => "required|numeric",
                    "errors" => [
                        "required" => "El campo cantidad es obligatorio",
                        "numeric" => "La cantidad no es numerico, verifique",
                    ]
                ] 
            ]);

            if($validation == false){ //si es false
                return redirect()->back()->with("errors", $this->validator->getErrors() )->withInput();
            }

            try {
                $data = [
                    'code' => $this->request->getPost("code"),
                    'title' => $this->request->getPost("title"),
                    'description' => $this->request->getPost("description"),
                    'price' => $this->request->getPost("price"),
                    'quantity' => $this->request->getPost("quantity"),
                    'created_at' =>  date('Y-m-d h:i:s')
                ];
                $productos = new Product();
                $productos->insert($data);
                return redirect()->to(base_url("/productos"))->with("success", "Producto agregado correctamente");
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", $th->getMessage())->withInput();
            }
        }


        public function edit($id = null){
            $productos = new Product();
            $query = $productos->find($id);

            return view("productos/edit", 
                [
                    "title"     => "Editando de Producto",
                    "producto" => $query
                ]
            );
        }

        public function update(){
            $validation = $this->validate([
                "code" => [
                    "rules" => "required|min_length[10]|max_length[20]",
                    "errors" => [
                        "required" => "El campo código es obligatorio",
                        "min_length" => "El código debe tener minimo 10 caracteres",
                        "max_length" => "El código no puede ser mayor a 20 caracteres" 
                    ]
                ],
                "title" => [
                    "rules" => "required|min_length[8]|max_length[255]",
                    "errors" => [
                        "required" => "El campo titulo es obligatorio",
                        "min_length" => "El titulo debe tener minimo 8 caracteres",
                        "max_length" => "El ttulo no puede ser mayor a 255 caracteres" 
                    ]
                ],
                "description" => [
                    "rules" => "required|min_length[20]",
                    "errors" => [
                        "required" => "El campo descripcion es obligatorio",
                        "min_length" => "La descripción debe tener minimo 20 caracteres",
                    ]
                ],
                "price" => [
                    "rules" => "required|numeric",
                    "errors" => [
                        "required" => "El campo precio es obligatorio",
                        "numeric" => "El precio no es numerico, verifique",
                    ]
                ], 
                "quantity" => [
                    "rules" => "required|numeric",
                    "errors" => [
                        "required" => "El campo cantidad es obligatorio",
                        "numeric" => "La cantidad no es numerico, verifique",
                    ]
                ] 
            ]);
            if($validation == false){ //si es false
                return redirect()->back()->with("errors", $this->validator->getErrors() )->withInput();
            }

            try {
                $id =  $this->request->getPost("id");
                $data = [
                    'code' => $this->request->getPost("code"),
                    'title' => $this->request->getPost("title"),
                    'description' => $this->request->getPost("description"),
                    'price' => $this->request->getPost("price"),
                    'quantity' => $this->request->getPost("quantity")
                ];
                $productos = new Product();
                $productos->update($id, $data);
                return redirect()->to(base_url("/productos"))->with("success", "Producto modificado correctamente");
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", $th->getMessage())->withInput();
            }
        }

        public function delete($id){
            try {
                $producto = new Product();
                $producto->delete($id);
                return redirect()->to(base_url("/productos"))->with("success", "El producto fue eliminado correctamente");
            } catch (\Throwable $th) {
                return redirect()->back()->with("error", $th->getMessage());
            }
        }

        public function search(){
            $buscar = $_GET["searchTerm"];
            $products = new Product();
            $products->select('code, title');
            $products->like('title', $buscar, 'both');
            echo json_encode($products->findAll());
            return;
        }
    }