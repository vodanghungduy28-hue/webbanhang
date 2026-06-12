<?php
class ProductModel
{
    private $conn;
    private $table_name = "product";
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getProducts($search = '', $categoryId = null)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
FROM " . $this->table_name . " p
LEFT JOIN category c ON p.category_id = c.id";
        $conditions = [];
        $params = [];

        if (!empty($search)) {
            $conditions[] = "p.name LIKE :search";
            $params[':search'] = '%' . $search . '%';
        }
        if (!empty($categoryId)) {
            $conditions[] = "p.category_id = :category_id";
            $params[':category_id'] = $categoryId;
        }

        if (count($conditions) > 0) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $query .= ' ORDER BY p.name ASC';

        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getProductById($id)
    {
        $query = "SELECT p.*, c.name AS category_name FROM " . $this->table_name . " p
LEFT JOIN category c ON p.category_id = c.id
WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function addProduct($name, $description, $price, $category_id, $image = null)
    {
        $errors = [];
        if (empty(trim($name))) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty(trim($description))) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        if ($category_id !== null && $category_id !== '' && !is_numeric($category_id)) {
            $errors['category_id'] = 'Danh mục không hợp lệ';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $image = $image !== null ? htmlspecialchars(strip_tags($image)) : null;

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        if ($category_id === null || $category_id === '') {
            $stmt->bindValue(':category_id', null, PDO::PARAM_NULL);
        } else {
            $category_id = (int)$category_id;
            $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        }
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $image)
    {
        $errors = [];
        if (empty(trim($name))) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty(trim($description))) {
            $errors['description'] = 'Mô tả không được để trống';
        }
        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }
        if ($category_id !== null && $category_id !== '' && !is_numeric($category_id)) {
            $errors['category_id'] = 'Danh mục không hợp lệ';
        }
        if (count($errors) > 0) {
            return $errors;
        }

        $query = "UPDATE " . $this->table_name . " SET name=:name,
description=:description, price=:price, category_id=:category_id, image=:image WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $image = $image !== null ? htmlspecialchars(strip_tags($image)) : null;

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        if ($category_id === null || $category_id === '') {
            $stmt->bindValue(':category_id', null, PDO::PARAM_NULL);
        } else {
            $category_id = (int)$category_id;
            $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        }
        $stmt->bindValue(':image', $image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
