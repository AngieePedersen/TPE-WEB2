<?php 

class HomeView{
    public function showHome($products, $categories){

        $countProducts = count($products);
        $countCategories = count($categories);

        require 'templates/views/home.phtml';
    }
}

?>