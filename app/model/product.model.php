<?php
        require_once 'app/model/model.php';



class ProductModel extends Model
{ 

    //This function gets from the database ALL PRODUCTS
    public function getProducts()
    {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        // Fetch all rows from the query result
        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }


    public function getProductsByCategory($category_id) {
        $query = 'SELECT * FROM productos';
    
        if (is_numeric($category_id)) {
            $query .= ' WHERE IDcategoria = ?';
        }
    
        $params = is_numeric($category_id) ? [$category_id] : [];
    
        $query = $this->db->prepare($query);
        $query->execute($params);
    
         $products = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $products;
    }
    

    public function getProductById($product_id){
        $query = 'SELECT * FROM productos WHERE IDproducto = ?';
        $params = is_numeric($product_id) ? [$product_id] : [0]; // Use 0 as a placeholder when $product_id is not numeric.
        $query = $this->db->prepare($query);
        $query->execute($params);
    
        $product = $query->fetch(PDO::FETCH_OBJ);
    
        return $product;
    }
    
    function insertProduct( $name, $description, $size, $price, $category_id){
        $stock = 10;
        $query = $this->db->prepare('INSERT INTO productos (Nombre, Descripcion, Talle, Precio , IDcategoria) VALUES(?,?,?, ?, ?)');
        $query->execute([$name, $description, $size, $price, $category_id]);
     return $this->db->lastInsertId();
    }




    function updateProduct($product_id, $name, $description, $size, $price, $category_id ){
        $query = $this->db->prepare('UPDATE productos
        SET Nombre = ?, Descripcion = ?, Talle = ?, Precio = ?, IDcategoria = ? WHERE IDproducto = ?');
        $query->execute([ $product_id, $name, $description, $size, $price, $category_id, $product_id]);
        return $query;
    }
  

    function deleteProductById($product__id){   
      $query= $this->db->prepare('DELETE FROM productos WHERE IDproducto = ?');
      $query->execute([$product__id]);
      return $query;
    }

    function deleteAllProductsByCategory($category_id){
        $query = $this->db->prepare('DELETE FROM productos where IDcategoria = ?');
        $query->execute([$category_id]);
    }

}




?>