<?php
class UserModel {
    protected $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function findUserByEmail($email) {
        $stmt = $this->conn->prepare('SELECT id, nombre, apellido, contraseña, rol, foto_perfil FROM usuarios WHERE correo = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($nombre, $apellido, $correo, $rol, $contraseña, $foto_perfil_nombre) {
        $hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare('INSERT INTO usuarios (nombre, apellido, correo, rol, contraseña, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('ssssss', $nombre, $apellido, $correo, $rol, $hash, $foto_perfil_nombre);
        return $stmt->execute();
    }

    public function getUsers() {
        $stmt = $this->conn->prepare("SELECT id, nombre, apellido, correo, rol, foto_perfil FROM usuarios ORDER BY rol, nombre");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function findUserById($id) {
        $stmt = $this->conn->prepare("SELECT id, nombre, apellido, correo, rol, foto_perfil, contraseña FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($id, $nombre, $apellido, $correo, $rol, $foto_perfil) {
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, rol = ?, foto_perfil = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssi', $nombre, $apellido, $correo, $rol, $foto_perfil, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function updateUserProfile($id, $nombre, $apellido, $correo, $foto_perfil) {
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ?, foto_perfil = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssi', $nombre, $apellido, $correo, $foto_perfil, $id);
        return $stmt->execute();
    }

    public function changePassword($userId, $newPassword) {
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("UPDATE usuarios SET contraseña = ? WHERE id = ?");
        $stmt->bind_param('si', $hash, $userId);
        return $stmt->execute();
    }
}
?>
