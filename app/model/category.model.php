
<?php
    require_once 'app/model/model.php';


class CategoryModel extends Model
{
    public function getCategory()
    {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
    public function getCategoryById($category_id)
    {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE IDcategoria = ?');
        $query->execute([$category_id]);
        $category = $query->fetch(PDO::FETCH_OBJ);
        return $category;
    }
    
   public function createCategory($category_name){
    
    $query = $this->db->prepare('INSERT INTO categorias (Nombre) VALUES(?)');
    $query->execute([$category_name]);
    return $query;
   }

    
    public function updateCategory($category_id, $category_name){
        $query = $this->db->prepare('UPDATE categorias 
            SET Nombre = ? WHERE IDcategoria = ?');
        $query->execute([$category_name, $category_id]);
        return $query;
    }
    

    public function deleteCategory($category_id) {
        $checkQuery = $this->db->prepare('SELECT COUNT(*) FROM productos WHERE IDcategoria = ?');
        $checkQuery->execute([$category_id]);
        $productCount = $checkQuery->fetchColumn();
    
        if ($productCount > 0) {
            $deleteProductsQuery = $this->db->prepare('DELETE FROM productos WHERE IDcategoria = ?');
            $deleteProductsQuery->execute([$category_id]);
        }
    
        $deleteCategoryQuery = $this->db->prepare('DELETE FROM categorias WHERE IDcategoria = ?');
        $deleteCategoryQuery->execute([$category_id]);
    
        return  $deleteCategoryQuery;
    }
}


?>