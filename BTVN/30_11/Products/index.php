<?php
global $pdo;
require_once 'Config/Database.php';
require_once 'Controller/ProductController.php';

$controller = new ProductController($pdo);

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;

    switch ($action) {
        case 'Show':
            $controller->Show($id);
            break;
        case 'Add':
            $controller->Add();
            break;
        case 'Edit':
            if ($id) {
                $controller->Edit($id);
            } else {
                echo "ID sản phẩm không hợp lệ.";
            }
            break;
        case 'Delete':
            if ($id) {
                $controller->Delete($id);
            } else {
                echo "ID sản phẩm không hợp lệ.";
            }
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
?>
