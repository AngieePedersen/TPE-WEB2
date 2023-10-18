<?php

require_once './app/model/product.model.php';
require_once './app/view/product.view.php';
require_once './app/view/home.view.php';

class HomeController{

    private $productModel;
    private $categoryModel;

    private $view;

    private $loggedIn;

    public function __construct(){
 
         $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->view = new HomeView();
 
    }

    public function showHome(){
       
        $products = $this->productModel->getProducts();
        $categories = $this->categoryModel->getCategory();
        $this->view->showHome($products, $categories);
 }
}
?>