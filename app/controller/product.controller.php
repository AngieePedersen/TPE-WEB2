<?php

require_once './app/model/product.model.php';

require_once './app/model/category.model.php';

require_once './app/view/product.view.php';
require_once './app/view/home.view.php';

class ProductController
{

    private $productModel;
    private $homeView;
    private $productView;

    private $categoryModel;

    public function __construct()
    {
         $this->productModel = new ProductModel();
        $this->productView = new ProductView();
        $this->categoryModel = new CategoryModel;
         $this->homeView = new HomeView();
     }


   public function showProducts() {
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $products= $this->productModel->getProductsByCategory($category);
    ///
    $categories = $this->categoryModel->getCategory(); //  
   ///
    $this->homeView->showHome($products, $categories);
}


public function showProductById() {
    $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
     $product = $this->productModel->getProductById($product_id);
    
    if ($product) {
        $this->productView->showProductById($product);
    } else {
        echo "Product not found.";
    }
}

public function submitProduct() {
    AuthHelper::verify();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $category = $_POST['category'];
       
        $result = $this->productModel->insertProduct($name, $description, $size, $price, $category);
        if ($result) {
            header("Location: dashboard");
            exit;
        } else {
            echo "Product operation failed.";
        }
    }
}

public function putProduct() {
    AuthHelper::verify();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = isset($_GET['product-id']) ? $_GET['product-id'] : null;
        $name = $_POST['name'];
        $description = $_POST['description'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        
        $result = $this->productModel->updateProduct($product_id, $name, $description, $size, $price, $category);
        if ($result) {
            header("Location: dashboard");
            exit;
        } else {
            echo "Product operation failed.";
        }
    }
}




 public function deleteProductById(){
    AuthHelper::verify();

    $productId = isset($_GET['product-id']) ? $_GET['product-id'] : null;

    if ($productId !== null) {
        $result = $this->productModel->deleteProductById($productId);
        if($result){
            header("Location: dashboard");
            exit;
        }else{
            echo "Product deletion failed.";
        }
    } 
 }

}

?>