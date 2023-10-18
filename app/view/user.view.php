<?php 

class UserView{


   public function showLogin($message = null) {
      require './templates/views/login.phtml';
  }

   public function showDashboard($products, $categories){
      $countProducts = count($products);
      $countCategories = count( $categories);

      require 'templates\views\dashboard.phtml';
   }

   public function showProductForm($product, $action, $categories){
       
      require 'templates\views\productForm.phtml';
   }

   public function editCategoryForm($category, $action){
      require 'templates\views\categoryForm.phtml';

   }
}

?>