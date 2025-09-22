<?php
require_once __DIR__ . '/../models/UserModel.php';

class UserController {
    private $userModel;
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->userModel = new UserModel($conn);
    }

    private function checkAdmin() {
        if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'Administrador') {
            header('Location: index.php?action=login');
            exit;
        }
    }

    public function listUsers() {
        $this->checkAdmin();
        $usuarios = $this->userModel->getUsers();
        require_once __DIR__ . '/../views/users/list.php';
    }

    public function deleteUser() {
        $this->checkAdmin();
        $id = $_GET['id'] ?? 0;
        if ($id > 0 && $id != $_SESSION['usuario_id']) {
            // Opcional: Eliminar foto de perfil del servidor
            $user = $this->userModel->findUserById($id);
            if ($user && $user['foto_perfil']) {
                $path = __DIR__ . '/../../public/uploads/profile_pics/' . $user['foto_perfil'];
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $this->userModel->deleteUser($id);
        }
        header('Location: index.php?action=listUsers&success=delete');
        exit;
    }

    public function addUser() {
        $this->checkAdmin();
        $mensaje = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $rol = $_POST['rol'] ?? '';
            $contraseña = $_POST['contraseña'] ?? '';
            $confirmar_contraseña = $_POST['confirmar_contraseña'] ?? '';
            $foto_perfil = $_FILES['foto_perfil'] ?? null;

            if (empty($nombre) || empty($apellido) || empty($correo) || empty($rol) || empty($contraseña) || empty($confirmar_contraseña)) {
                $mensaje = 'Todos los campos obligatorios deben ser completados.';
            } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mensaje = 'El correo electrónico no es válido.';
            } elseif ($contraseña !== $confirmar_contraseña) {
                $mensaje = 'Las contraseñas no coinciden.';
            } elseif ($this->userModel->findUserByEmail($correo)) {
                $mensaje = 'El correo electrónico ya está registrado.';
            } else {
                $ruta_foto = null;
                if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($foto_perfil['name'], PATHINFO_EXTENSION);
                    $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array(strtolower($ext), $permitidas)) {
                        $nombre_archivo = uniqid('perfil_') . '.' . $ext;
                        $ruta_destino = __DIR__ . '/../../public/uploads/profile_pics/' . $nombre_archivo;
                        if (move_uploaded_file($foto_perfil['tmp_name'], $ruta_destino)) {
                            $ruta_foto = $nombre_archivo;
                        } else {
                            $mensaje = 'Error al subir la foto de perfil.';
                        }
                    } else {
                        $mensaje = 'Formato de imagen no permitido.';
                    }
                }

                if (empty($mensaje)) {
                    // Corregido el orden de los argumentos
                    if ($this->userModel->createUser($nombre, $apellido, $correo, $rol, $contraseña, $ruta_foto)) {
                        header('Location: index.php?action=listUsers&success=add');
                        exit;
                    } else {
                        $mensaje = 'Error al registrar el usuario.';
                    }
                }
            }
        }
        require_once __DIR__ . '/../views/users/add.php';
    }

    public function editUser() {
        $this->checkAdmin();
        $id = $_GET['id'] ?? 0;
        if ($id <= 0) {
            header('Location: index.php?action=listUsers');
            exit;
        }

        $usuario = $this->userModel->findUserById($id);
        if (!$usuario) {
            header('Location: index.php?action=listUsers');
            exit;
        }

        $mensaje = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $rol = $_POST['rol'] ?? '';
            $foto_perfil_actual = $usuario['foto_perfil'];

            if (empty($nombre) || empty($apellido) || empty($correo) || empty($rol)) {
                $mensaje = 'Todos los campos son obligatorios.';
            } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $mensaje = 'El correo electrónico no es válido.';
            } else {
                $ruta_foto_nueva = $foto_perfil_actual;
                $foto_perfil = $_FILES['foto_perfil'] ?? null;

                if ($foto_perfil && $foto_perfil['error'] === UPLOAD_ERR_OK) {
                    $ext = pathinfo($foto_perfil['name'], PATHINFO_EXTENSION);
                    $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array(strtolower($ext), $permitidas)) {
                        $nombre_archivo = uniqid('perfil_') . '.' . $ext;
                        $ruta_destino = __DIR__ . '/../../public/uploads/profile_pics/' . $nombre_archivo;
                        if (move_uploaded_file($foto_perfil['tmp_name'], $ruta_destino)) {
                            $ruta_foto_nueva = $nombre_archivo;
                            // Eliminar foto anterior si existe y no es la por defecto
                            if ($foto_perfil_actual && $foto_perfil_actual !== 'FOTO-SIN-PERFIL.jpg' && file_exists(__DIR__ . '/../../public/uploads/profile_pics/' . $foto_perfil_actual)) {
                                unlink(__DIR__ . '/../../public/uploads/profile_pics/' . $foto_perfil_actual);
                            }
                        } else {
                            $mensaje = 'Error al subir la nueva foto.';
                        }
                    } else {
                        $mensaje = 'Formato de imagen no permitido.';
                    }
                }

                if (empty($mensaje)) {
                    if ($this->userModel->updateUser($id, $nombre, $apellido, $correo, $rol, $ruta_foto_nueva)) {
                        header('Location: index.php?action=listUsers&success=edit');
                        exit;
                    } else {
                        $mensaje = 'Error al actualizar el usuario.';
                    }
                }
            }
            // Recargar datos del usuario para mostrar en el formulario en caso de error
            $usuario['nombre'] = $nombre;
            $usuario['apellido'] = $apellido;
            $usuario['correo'] = $correo;
            $usuario['rol'] = $rol;
        }

        require_once __DIR__ . '/../views/users/edit.php';
    }

    public function profile() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $id = $_SESSION['usuario_id'];
        $mensaje = '';
        $mensaje_tipo = 'info';

        if (isset($_GET['update']) && $_GET['update'] === 'ok') {
            $mensaje = 'Perfil actualizado correctamente.';
            $mensaje_tipo = 'success';
        }
        if (isset($_GET['cambio']) && $_GET['cambio'] === 'ok') {
            $mensaje = 'Contraseña cambiada correctamente.';
            $mensaje_tipo = 'success';
        }

        $usuario = $this->userModel->findUserById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_nuevo = trim($_POST['nombre'] ?? '');
            $apellido_nuevo = trim($_POST['apellido'] ?? '');
            $correo_nuevo = trim($_POST['correo'] ?? '');
            $foto_perfil_nueva = $_FILES['foto_perfil'] ?? null;

            if (empty($nombre_nuevo) || empty($apellido_nuevo) || empty($correo_nuevo)) {
                $mensaje = 'Todos los campos obligatorios deben ser completados.';
                $mensaje_tipo = 'error';
            } elseif (!filter_var($correo_nuevo, FILTER_VALIDATE_EMAIL)) {
                $mensaje = 'El correo electrónico no es válido.';
                $mensaje_tipo = 'error';
            } else {
                $existingUser = $this->userModel->findUserByEmail($correo_nuevo);
                if ($existingUser && $existingUser['id'] != $id) {
                    $mensaje = 'El correo electrónico ya está registrado en otro usuario.';
                    $mensaje_tipo = 'error';
                } else {
                    $ruta_foto_actualizada = $usuario['foto_perfil'];

                    if ($foto_perfil_nueva && $foto_perfil_nueva['error'] === UPLOAD_ERR_OK) {
                        $ext = pathinfo($foto_perfil_nueva['name'], PATHINFO_EXTENSION);
                        $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                        if (in_array(strtolower($ext), $permitidas)) {
                            $nombre_archivo = uniqid('perfil_') . '.' . $ext;
                            $ruta_destino = __DIR__ . '/../../public/uploads/profile_pics/' . $nombre_archivo;

                            if (move_uploaded_file($foto_perfil_nueva['tmp_name'], $ruta_destino)) {
                                // Si la foto anterior existe y no es la de por defecto, eliminarla
                                if ($ruta_foto_actualizada && $ruta_foto_actualizada !== 'FOTO-SIN-PERFIL.jpg' && file_exists(__DIR__ . '/../../public/uploads/profile_pics/' . $ruta_foto_actualizada)) {
                                    unlink(__DIR__ . '/../../public/uploads/profile_pics/' . $ruta_foto_actualizada);
                                }
                                $ruta_foto_actualizada = $nombre_archivo;
                            } else {
                                $mensaje = 'Error al subir la nueva foto de perfil.';
                                $mensaje_tipo = 'error';
                            }
                        } else {
                            $mensaje = 'Formato de imagen no permitido.';
                            $mensaje_tipo = 'error';
                        }
                    }

                    if (empty($mensaje)) {
                        if ($this->userModel->updateUserProfile($id, $nombre_nuevo, $apellido_nuevo, $correo_nuevo, $ruta_foto_actualizada)) {
                            // Actualizar la sesión si el usuario actual se edita a sí mismo
                            if ($id == $_SESSION['usuario_id']) {
                                $_SESSION['nombre'] = $nombre_nuevo;
                                $_SESSION['apellido'] = $apellido_nuevo;
                                $_SESSION['correo'] = $correo_nuevo;
                                $_SESSION['foto_perfil'] = $ruta_foto_actualizada;
                            }
                            header('Location: index.php?action=profile&update=ok');
                            exit;
                        } else {
                            $mensaje = 'Error al actualizar el perfil.';
                            $mensaje_tipo = 'error';
                        }
                    }
                }
            }
            // Recargar datos del usuario para mostrar en el formulario en caso de error
            $usuario['nombre'] = $nombre_nuevo;
            $usuario['apellido'] = $apellido_nuevo;
            $usuario['correo'] = $correo_nuevo;
        }

        require_once __DIR__ . '/../views/users/profile.php';
    }

    public function changePassword() {
        $mensaje = '';
        $from = $_GET['from'] ?? 'login';
        $cancel_url = ($from === 'profile') ? 'profile' : 'login';

        if ($from === 'profile' && !isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $pedir_correo = ($from === 'login');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $actual = trim($_POST['actual'] ?? '');
            $nueva = trim($_POST['nueva'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $user = null;

            if ($pedir_correo) {
                if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $mensaje = 'Debes ingresar un correo válido.';
                } else {
                    $user = $this->userModel->findUserByEmail($correo);
                }
            } else {
                $user = $this->userModel->findUserById($_SESSION['usuario_id']);
            }

            if (!$user) {
                $mensaje = 'Usuario no encontrado.';
            } elseif (empty($actual) || empty($nueva)) {
                $mensaje = 'Completa todos los campos.';
            } elseif (password_verify($actual, $user['contraseña'])) {
                if ($this->userModel->changePassword($user['id'], $nueva)) {
                    $redirect_url = ($from === 'profile') ? 'index.php?action=profile&cambio=ok' : 'index.php?action=login&cambio=ok';
                    header('Location: ' . $redirect_url);
                    exit;
                } else {
                    $mensaje = 'Error al actualizar la contraseña.';
                }
            } else {
                $mensaje = 'La contraseña actual es incorrecta.';
            }
        }

        require_once __DIR__ . '/../views/users/change_password.php';
    }

    public function viewPhoto() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $foto_perfil = $_SESSION['foto_perfil'] ?? null;
        $ruta_foto = $foto_perfil ? 'uploads/' . $foto_perfil : 'assets/img/FOTO-SIN-PERFIL.jpg';

        $volver = 'dashboard'; // Default return path
        if (isset($_SERVER['HTTP_REFERER'])) {
            $referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
            if (strpos($referer, 'action=profile') !== false) {
                $volver = 'profile';
            }
        }

        require_once __DIR__ . '/../views/users/view_photo.php';
    }
}
?>
