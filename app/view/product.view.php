<?php


class ProductView
{

    public function showProduct($products)
    {
        $count = count($products);

        require 'templates/views/products.phtml';
    }

    public function showProductById($product){
        require 'templates/views/product.phtml';

    }
    public function showError($error)
    {

        require 'templates/errors/rror.phtml';
    }
}

?>