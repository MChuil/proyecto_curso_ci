<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Dompdf\Dompdf;

class SalesController extends BaseController
{

    public function __construct(){
        session();
    }

    public function index()
    {
        $mensaje = null;
        $carrito = (session('carrito'))? session('carrito') : [];
        if(!empty($this->request->getPost('product')) && !empty($this->request->getPost('quantity'))){
            //buscar el producto y validar la existencia
            $code =  $this->request->getPost('product');
            $quantity =  $this->request->getPost('quantity');
            $products = new Product();
            $product = $products->where('code', $code)->first();

            $existe = false;
            $num = null;
            for($i=0; $i < count($carrito); $i++){
                if($carrito[$i]['code'] == $code){
                    $existe = true;
                    $num = $i;
                }
            }

            if($existe){
                    //buscara que al sumar las cantidades no se pase de la existencia
                    if(($carrito[$num]['quantity'] + $quantity) > $product['quantity']){
                        $mensaje = "No hay existencia suficiente...";
                    }else{//si no, solo aumento la cantidad en el carrito

                        // $nuevaCantidad = $carrito[$num]['quantity'] + $quantity;
                        // $carrito[$num]['quantity'] = $nuevaCantidad;

                        // $carrito[$num]['quantity'] = $carrito[$num]['quantity'] + $quantity;

                        $carrito[$num]['quantity'] += $quantity;

                        //actualizar a la sesion
                        session()->set([
                            'carrito' => $carrito
                        ]);
                    }
            }else{ //no existe
                //validamos que haya producto suficiente
                if($quantity > $product['quantity']){  //si la cantidad que pido es mayo a la existencia
                    $mensaje = "No hay existencia suficiente...";
                }else{
                    if(!empty(session('carrito'))){
                        $details = session('carrito');
                    }else{
                        $details = [];
                    }
                    $detail = [
                        'id' => $product['id'],
                        'code' => $product['code'],
                        'description' => $product['title'],
                        'price' => $product['price'],
                        'quantity' => $quantity
                    ];
        
                    array_push($details, $detail);
        
                    session()->set([
                        'carrito' => $details
                    ]);
                    $carrito = session('carrito');
                }
            }          
        }
        
        $data= [
            'title'=>'Venta de productos',
            'mensaje' => $mensaje,
            'num' => 0,
            'total' => 0,
            'carrito' => $carrito
        ];

        return view('sales/index', $data);
    }

    public function cancel(){
        //session()->remove('carrito');
        unset($_SESSION['carrito']);
        return redirect()->back();
    }

    public function save(){
        if(empty($this->request->getPOST("customer_id")) || empty($this->request->getPost('total'))){
            return redirect()->back()->with("error", "Datos incompletos, no se puede realizar la venta. Intente de nuevo");
        }
        try{
            $customer = new Customer();
            $cliente = $customer->find($this->request->getPOST("customer_id"));
            $data = [
                "customer_id" =>$this->request->getPOST("customer_id"),
                "employee_id" => session('user_id'),
                "total" =>  $this->request->getPost('total'),
                "created_at" => date('Y-m-d h:i:s')
            ];
            $sales = new Sale();
            $saleId = $sales->insert($data);  //inserta la venta general
            foreach (session('carrito') as $row) { //recorremos cada detalle(producto)
                $saleDetails = new SaleDetail();
                $products = new Product();
                $data  = [
                    'sale_id' => $saleId, 
                    'product_id' => $row['id'], 
                    'quantity' => $row['quantity'], 
                    'price' => $row['price'],
                    "created_at" => date('Y-m-d h:i:s')
                ];
                $saleDetails->insert($data); //insertamos el detalle
                //Restamos existencias
                $product = $products->find($row['id']);
                $newQuantity = $product['quantity'] - $row['quantity'];
                $products->update($row['id'], ['quantity' => $newQuantity]);
            }

            //impresion PDF
            $dompdf = new Dompdf();
            $dompdf->loadHtml(view('sales/factura', [
                'carrito' =>session('carrito'),
                'cliente'=> $cliente['name'],
                'total' => $this->request->getPost('total'),
                'factura' => $saleId,
                'fecha' => date('Y-m-d')
            ]));

            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('letter', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser
            $dompdf->stream();

            //borrar el carrito
            session()->remove('carrito');
            return redirect()->to(base_url("/venta"))->with('success', "Venta realizada correctamente");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    public function reporte(){
        $ventas = [];
        if(!empty($this->request->getPost('date'))){ //si no esta vacio date
            //buscar las ventas de esa fecha
            $date = $this->request->getPost('date');
            //venta general, venta detalle, productos, clientes y empleados
            $details = new SaleDetail();
            $details->select("saledetails.product_id, saledetails.quantity, saledetails.price, sales.*, products.title, customers.name");
            $details->join("sales", "saledetails.sale_id = sales.id");
            $details->join("products", "saledetails.product_id = products.id");
            $details->join("customers","sales.customer_id = customers.id");
            $details->where("DATE(sales.created_at) =", $date);
            $ventas = $details->findAll();
            session()->set(["pdfVentas" => $ventas]);

        }
        $data= [
            'title'=>'Reporte de ventas',
            'ventas' => $ventas
        ];
        return view("sales/report", $data);
    }

    public function pdf(){
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('sales/pdf', [
            'ventas' => session("pdfVentas")
        ]));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('letter', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
