<?php
require_once 'Models/Product.php';
class ProductController{
    private $model;
    public function __construct(){
        $this->model = new Product();
    }

    public function index(){
        $products = $this->model->getAllProducts();
        require 'View/index.php';
    }
    public function show($id){
        $products = $this->model->getProductById($id);
        require 'View/Show.php';
    }
    public function Add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->model->AddProduct($_POST["name"],$_POST["price"]);
            header('Location: index.php');
            exit;
        }else{
            require 'View/Add.php';
        }
    }
    public function Edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $this->model->EditProduct($id, $name, $price);
            header('Location: index.php');
        } else {
            $product = $this->model->getProductById($id);
            include 'View/Edit.php';
        }
    }
    public function Delete($id){
        $this->model->DeleteProduct($id);
        header('Location: index.php');
    }

}
?>