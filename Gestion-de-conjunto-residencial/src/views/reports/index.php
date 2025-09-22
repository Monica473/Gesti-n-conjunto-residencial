<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container">
    <div class="users-card">
        <div class="card-header">
            <h1>Generar Informe de Usuarios</h1>
            <a href="index.php?action=dashboard" class="btn btn-secondary">Volver al Panel</a>
        </div>

        <table class="users-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                        <td>
                            <a href="index.php?action=viewUserReport&id=<?php echo $usuario['id']; ?>" class="btn btn-primary btn-sm">Generar informe</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
.users-card {
    background-color: #fff;
    border-radius: 20px; /* Esquinas más curvas */
    box-shadow: var(--shadow-md);
    padding: 2rem;
    margin-top: 2rem;
    border: 1px solid #e0e0e0;
}
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
}
.card-header h1 {
    margin: 0;
}
.users-table {
    width: 100%;
    border-collapse: collapse;
}
.users-table th, .users-table td {
    padding: 0.9rem;
    text-align: left;
    vertical-align: middle;
    border: 1px solid #ddd; /* Borde delgado y oscuro */
}
.users-table th {
    background-color: #f8f9fa;
    font-weight: 600;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
