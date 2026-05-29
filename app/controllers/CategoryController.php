<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');
class CategoryController
{
    private $categoryModel;
    private $db;
    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }
    public function index()
    {
        $this->list();
    }
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        $error = $_GET['error'] ?? '';
        include 'app/views/category/list.php';
    }
    public function add()
    {
        include 'app/views/category/add.php';
    }
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $result = $this->categoryModel->addCategory($name, $description);
            if (is_array($result)) {
                $errors = $result;
                include 'app/views/category/add.php';
            } else {
                header('Location: /webbanhang/Category');
                exit;
            }
        }
    }
    public function edit($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Không tìm thấy danh mục.";
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $result = $this->categoryModel->updateCategory($id, $name, $description);
            if (is_array($result)) {
                $errors = $result;
                $category = (object)[
                    'id' => $id,
                    'name' => $name,
                    'description' => $description,
                ];
                include 'app/views/category/edit.php';
            } else {
                header('Location: /webbanhang/Category');
                exit;
            }
        }
    }
    public function delete($id)
    {
        if ($this->categoryModel->hasProducts($id)) {
            $message = urlencode('Không thể xóa danh mục này vì còn sản phẩm thuộc danh mục.');
            header('Location: /webbanhang/Category?error=' . $message);
            exit;
        }

        if ($this->categoryModel->deleteCategory($id)) {
            header('Location: /webbanhang/Category');
            exit;
        } else {
            $message = urlencode('Đã xảy ra lỗi khi xóa danh mục.');
            header('Location: /webbanhang/Category?error=' . $message);
            exit;
        }
    }
}
