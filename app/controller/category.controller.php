<?php

require_once './app/model/category.model.php';
require_once './app/view/category.view.php';

class CategoryController
{

    private $model;
    private $view;


    public function __construct()
    {
        $this->model = new CategoryModel();
        $this->view = new CategoryView();
    }


    public function showCategory()
    {
        $categories = $this->model->getCategory();
        $this->view->showCategory($categories);
    }


    public function createCategory(){
        AuthHelper::verify();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_name = $_POST['category'];
        $result = $this->model->createCategory($category_name);
        if($result){
            header("Location: dashboard");
           }
        }
    }

    public function updateCategory() {
        AuthHelper::verify();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
            $category_name = $_POST['category'];
            $result = $this->model->updateCategory($category_id, $category_name);
            if ($result) {
                header("Location: dashboard");
            }
        }
    }
    
    public function deleteCategory() {
        AuthHelper::verify();
        $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
    
        if ($category_id) {
            $result = $this->model->deleteCategory($category_id);
            if ($result) {
                header("Location: dashboard");
                exit;
            } else {
                echo "Category deletion failed.";
            }
        } else {
            echo "Invalid category ID.";
        }
    }


}

?>