<?php
class DashboardController {
    protected $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function index() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $title = 'Panel Principal';
        $nombre = $_SESSION['nombre'] ?? '';
        $apellido = $_SESSION['apellido'] ?? '';
        $rol = $_SESSION['rol'] ?? '';
        $foto_perfil = $_SESSION['foto_perfil'] ?? null;

        require_once '../src/views/layouts/header.php';
        require_once '../src/views/dashboard/index.php';
        require_once '../src/views/layouts/footer.php';
    }
}
?>
