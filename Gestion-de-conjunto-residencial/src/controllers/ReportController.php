<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/RecordModel.php';

class ReportController {
    private $userModel;
    private $recordModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
        $this->recordModel = new RecordModel($conn);
    }

    private function checkAccess() {
        if (!isset($_SESSION['usuario_id']) || !in_array($_SESSION['rol'], ['Administrador', 'Guardia de seguridad'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function index() {
        $this->checkAccess();

        $usuarios = $this->userModel->getUsers();

        require_once __DIR__ . '/../views/reports/index.php';
    }

    public function viewUserReport() {
        $this->checkAccess();

        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header('Location: index.php?action=generateReport');
            exit;
        }

        $userId = intval($_GET['id']);
        $user = $this->userModel->findUserById($userId);
        $records = $this->recordModel->getRecordsByUserIdForReport($userId);

        require_once __DIR__ . '/../views/reports/view_user_report.php';
    }
}
?>
