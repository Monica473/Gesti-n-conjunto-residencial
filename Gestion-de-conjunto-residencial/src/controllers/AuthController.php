<?php
class AuthController {
    protected $conn;
    protected $userModel;

    public function __construct($conn) {
        $this->conn = $conn;
        require_once '../src/models/UserModel.php';
        $this->userModel = new UserModel($conn);
    }

    public function showLogin($mensaje = '') {
        $title = 'Iniciar Sesión';
        require_once '../src/views/layouts/header.php';
        require_once '../src/views/auth/login.php';
        require_once '../src/views/layouts/footer.php';
    }

    public function showRegister($mensaje = '') {
        $title = 'Registro de Usuario';
        require_once '../src/views/layouts/header.php';
        require_once '../src/views/auth/register.php';
        require_once '../src/views/layouts/footer.php';
    }

    public function handleLogin() {
        $correo = trim($_POST['correo'] ?? '');
        $contraseña = $_POST['contraseña'] ?? '';

        if (!$correo || !$contraseña) {
            return $this->showLogin('Por favor, completa todos los campos.');
        }

        $usuario = $this->userModel->findUserByEmail($correo);

        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];
            $_SESSION['rol'] = $usuario['rol'];
            $_SESSION['foto_perfil'] = $usuario['foto_perfil'];
            header('Location: index.php?action=dashboard');
            exit;
        } else {
            return $this->showLogin('Correo o contraseña incorrectos.');
        }
    }

    public function handleRegister() {
        $nombre = trim($_POST['nombre'] ?? '');
        $apellido = trim($_POST['apellido'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $rol = $_POST['rol'] ?? '';
        $contraseña = $_POST['contraseña'] ?? '';
        $confirmar_contraseña = $_POST['confirmar_contraseña'] ?? '';
        $foto_perfil = $_FILES['foto_perfil'] ?? null;

        if (!$nombre || !$apellido || !$correo || !$rol || !$contraseña || !$confirmar_contraseña) {
            return $this->showRegister('Todos los campos obligatorios deben ser completados.');
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return $this->showRegister('El correo electrónico no es válido.');
        }
        if ($contraseña !== $confirmar_contraseña) {
            return $this->showRegister('Las contraseñas no coinciden.');
        }
        if ($this->userModel->findUserByEmail($correo)) {
            return $this->showRegister('El correo electrónico ya está registrado.');
        }

        $foto_perfil_nombre = null;
        if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
            $upload_dir = __DIR__ . '/../../public/uploads/profile_pics/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $extension = pathinfo($foto_perfil['name'], PATHINFO_EXTENSION);
            $foto_perfil_nombre = 'perfil_' . uniqid() . '.' . $extension;
            move_uploaded_file($foto_perfil['tmp_name'], $upload_dir . $foto_perfil_nombre);
        }

        if ($this->userModel->createUser($nombre, $apellido, $correo, $rol, $contraseña, $foto_perfil_nombre)) {
            // Buscar el usuario recién creado y refrescar la sesión
            $usuario = $this->userModel->findUserByEmail($correo);
            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['apellido'] = $usuario['apellido'];
                $_SESSION['rol'] = $usuario['rol'];
                // Refuerzo: asegurar que la foto de perfil esté en sesión, aunque sea null
                $_SESSION['foto_perfil'] = !empty($usuario['foto_perfil']) ? $usuario['foto_perfil'] : null;
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                return $this->showLogin('Registro exitoso, pero hubo un problema iniciando sesión. Inicia sesión manualmente.');
            }
        } else {
            return $this->showRegister('Error al registrar el usuario.');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}
?>
