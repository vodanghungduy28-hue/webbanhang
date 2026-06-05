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
    private function ensureAdmin()
    {
        if (!class_exists('SessionHelper')) {
            require_once __DIR__ . '/../helpers/SessionHelper.php';
        }
        SessionHelper::start();
        if (!SessionHelper::isAdmin()) {
            header('Location: /webbanhang/Product/');
            exit;
        }
    }
    public function index()
    {
        $this->ensureAdmin();
        $this->list();
    }
    public function list()
    {
        $this->ensureAdmin();
        $categories = $this->categoryModel->getCategories();
        $error = $_GET['error'] ?? '';
        include 'app/views/category/list.php';
    }
    public function add()
    {
        $this->ensureAdmin();
        include 'app/views/category/add.php';
    }
    public function save()
    {
        $this->ensureAdmin();
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
        $this->ensureAdmin();
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit.php';
        } else {
            echo "Không tìm thấy danh mục.";
        }
    }
    public function update()
    {
        $this->ensureAdmin();
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
        $this->ensureAdmin();
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
