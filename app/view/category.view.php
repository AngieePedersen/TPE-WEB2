<?php


class CategoryView
{

    public function showCategory($categories)
    {
        $count = count($categories);

        require 'templates/views/category.phtml';
    }

    public function showError($error)
    {

        require 'templates/views/error.phtml';
    }
}

?>