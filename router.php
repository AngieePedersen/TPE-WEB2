<?php
require_once './app/controller/product.controller.php';
require_once './app/controller/category.controller.php';
require_once './app/controller/home.controller.php';
require_once './app/controller/user.controller.php';
require_once './app/helpers/auth.helper.php';
require_once 'config.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home'; // Default action

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}


 

$params = explode('/', $action);


switch ($params[0]) {
    case 'home':
 
        $controller = new HomeController();
        $controller->showHome();
        break;
    case 'products':
        $controller = new ProductController();
        $controller->showProducts();
        break;
    
     case 'product':
           $controller = new ProductController();
          $controller->showProductById();
          break;
    case 'categories':
        $controller = new CategoryController();
        $controller->showCategory();
        break;

    // ADMIN & LOGIN ROUTES
    case 'login':
        $controller = new UserController();
        $controller->showLogin();
        break;
    case 'auth':
        $controller = new UserController();
        $controller->autenticar();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;

    // ACCESS ONLY ALLOWED TO LOGGED IN USERS
    case 'dashboard':
        $controller = new UserController();
        $controller->showDashboard();
        break;

    // PRODUCT ACTIONS
    case 'product-form':
        $controller = new UserController();
        $controller->showProductForm();
        break;
    case 'create-product':
        $controller = new ProductController();
        $controller->submitProduct();
        break;
    case 'edit-product':
        $controller = new ProductController();
        $controller->putProduct();
        break;
    case 'delete-product':
        $controller = new ProductController();
        $controller->deleteProductById();
        break;

    // CATEGORY ACTIONS
    case 'category-form':
        $controller = new UserController();
        $controller->showCategoryForm();
        break;
    case 'create-category':
        $controller = new CategoryController();
        $controller->createCategory();
        break;
    case 'update-category':
        $controller = new CategoryController();
        $controller->updateCategory();
        break;
    case 'delete-category':
        $controller = new CategoryController();
        $controller->deleteCategory();
        break;

    default:
        echo "<p>404 Page not Found</p>";
        break;
}
?>