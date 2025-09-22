<?php
require_once __DIR__ . '/../models/RecordModel.php';

class RecordController {
    private $recordModel;

    public function __construct($conn) {
        $this->recordModel = new RecordModel($conn);
    }

    private function checkLogin() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }

    private function checkAccess() {
        $this->checkLogin();
        if (!in_array($_SESSION['rol'], ['Residente', 'Guardia de seguridad', 'Trabajador de aseo'])) {
             header('Location: index.php?action=dashboard');
             exit;
        }
    }

    public function myRecords() {
        $this->checkLogin();
        $registros = $this->recordModel->getRecordsByUserId($_SESSION['usuario_id']);
        require_once __DIR__ . '/../views/records/my_records.php';
    }

    public function registerEntry() {
        $this->checkAccess();
        $mensaje = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->recordModel->createRecord($_SESSION['usuario_id'], 'entrada')) {
                $mensaje = 'Entrada registrada correctamente.';
            } else {
                $mensaje = 'Error al registrar la entrada.';
            }
        }
        require_once __DIR__ . '/../views/records/register_entry.php';
    }

    public function registerExit() {
        $this->checkAccess();
        $mensaje = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->recordModel->createRecord($_SESSION['usuario_id'], 'salida')) {
                $mensaje = 'Salida registrada correctamente.';
            } else {
                $mensaje = 'Error al registrar la salida.';
            }
        }
        require_once __DIR__ . '/../views/records/register_exit.php';
    }
}
?>
