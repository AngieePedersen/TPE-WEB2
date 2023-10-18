<?php 
require './app/view/user.view.php';
require './app/model/user.model.php';
 
class UserController{

    private $view;
    private $model;

    private $productModel;
    private $categoryModel;
    function __construct(){
        $this->view = new UserView();
       $this->model = new UserModel();
       $this->productModel = new ProductModel();
       $this->categoryModel= new CategoryModel();

    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function autenticar() {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if (empty($user_name) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // Traigo el usuario de la base de datos.
        $user = $this->model->getByUsername($user_name);

        if ($user && ($password == ($user->Password)) ){

            AuthHelper::login($user);

            header('Location: ' . BASE_URL . 'dashboard');
            
            $this->view->showLogin('Usuario logueado correctamente.');

        } else {
            $this->view->showLogin('Usuario Inválido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
    


    
    public function showDashboard(){
        AuthHelper::verify();

        $products = $this->productModel->getProducts();
        $categories= $this->categoryModel->getCategory();
        $this->view->showDashboard($products, $categories);
    }

    public function showProductForm( ){
                AuthHelper::verify();

        $product_id = isset($_GET['product-id']) ? $_GET['product-id'] : null;
        $product = $this->productModel->getProductById($product_id);
        $categories = $this->categoryModel->getCategory();
        if ($product_id !== null) {
            $action = "edit-product";
        } else {
            $action = "create-product";
        }
        $this->view->showProductForm($product, $action, $categories);
    }
    

    public function showCategoryForm(){
                AuthHelper::verify();

        $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
        $category = $this->categoryModel->getCategoryById($category_id);
       
        if ($category_id !== null) {
            $action = "update-category";
        } else {
            $action = "create-category";
        }
        $this->view->editCategoryForm($category, $action);
    }
}


?>