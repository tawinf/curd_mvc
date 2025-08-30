<?php
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../models/Product.php';

class ProductController {

    // แสดงรายการสินค้า
    public function index() {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);
        $stmt = $product->read();
        
        include_once __DIR__ . '/../views/products/index.php';
    }

    // แสดงฟอร์มสร้างและจัดการการสร้างสินค้า
    public function create() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            $product = new Product($db);

            // --- Validation ---
            if (empty($_POST['name'])) {
                $errors[] = 'กรุณากรอกชื่อสินค้า';
            }
            if (empty($_POST['price']) || !is_numeric($_POST['price'])) {
                $errors[] = 'กรุณากรอกราคาเป็นตัวเลขเท่านั้น';
            }

            if (empty($errors)) {
                $product->name = $_POST['name'];
                $product->description = $_POST['description'];
                $product->price = $_POST['price'];

                if ($product->create()) {
                    header('Location: index.php?action=index&status=success');
                } else {
                    $errors[] = 'ไม่สามารถสร้างสินค้าได้';
                }
            }
        }
        // ถ้ามี error หรือยังไม่ได้ submit form ให้แสดงฟอร์ม
        include_once __DIR__ . '/../views/products/create.php';
    }
    
    // แสดงฟอร์มแก้ไข 
    public function edit($id) {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);
        $product->id = $id;

        if (!$product->readOne()) {
            // Error Handling: ไม่พบสินค้า
            die('ไม่พบสินค้าที่ต้องการแก้ไข');
        }

        include_once __DIR__ . '/../views/products/edit.php';
    }

    // จัดการการอัปเดตข้อมูล
    public function update() {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $database = new Database();
            $db = $database->getConnection();
            $product = new Product($db);

            // --- Validation ---
            if (empty($_POST['name'])) {
                $errors[] = 'กรุณากรอกชื่อสินค้า';
            }
            if (empty($_POST['price']) || !is_numeric($_POST['price'])) {
                $errors[] = 'กรุณากรอกราคาเป็นตัวเลขเท่านั้น';
            }

            if (empty($errors)) {
                $product->id = $_POST['id'];
                $product->name = $_POST['name'];
                $product->description = $_POST['description'];
                $product->price = $_POST['price'];

                if ($product->update()) {
                    header('Location: index.php?action=index&status=updated');
                } else {
                    $errors[] = 'ไม่สามารถอัปเดตสินค้าได้';
                }
            }

            // ถ้ามี error ให้กลับไปหน้า edit พร้อมข้อมูลเดิมและ error
            if (!empty($errors)) {
                $this->edit($_POST['id']); // สามารถปรับปรุงให้ส่ง $errors กลับไปได้
            }
        }
    }

    // จัดการการลบข้อมูล
    public function delete($id) {
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);
        $product->id = $id;

        if ($product->delete()) {
            header('Location: index.php?action=index&status=deleted');
        } else {
            die('ไม่สามารถลบสินค้าได้');
        }
    }
}
?>
