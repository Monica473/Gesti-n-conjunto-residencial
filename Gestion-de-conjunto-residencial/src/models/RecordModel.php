<?php
class RecordModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getRecordsByUserId($userId) {
        $stmt = $this->conn->prepare('SELECT tipo, fecha_hora FROM registros WHERE usuario_id = ? ORDER BY fecha_hora DESC');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function createRecord($userId, $type) {
        $stmt = $this->conn->prepare('INSERT INTO registros (usuario_id, tipo) VALUES (?, ?)');
        $stmt->bind_param('is', $userId, $type);
        return $stmt->execute();
    }

    public function getRecordsByUserIdForReport($userId) {
        $stmt = $this->conn->prepare('SELECT tipo, fecha_hora FROM registros WHERE usuario_id = ? AND fecha_hora >= DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY fecha_hora DESC');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
