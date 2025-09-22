<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container">
    <div class="users-card">
        <div class="card-header">
            <h1>Gestión de Usuarios</h1>
            <div class="header-actions">
                <a href="index.php?action=dashboard" class="btn btn-secondary">Volver al Panel</a>
                <a href="index.php?action=addUser" class="btn btn-primary">Añadir Usuario</a>
            </div>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="message success-message">
                <?php 
                    if ($_GET['success'] === 'delete') echo 'Usuario eliminado correctamente.';
                    if ($_GET['success'] === 'add') echo 'Usuario añadido correctamente.';
                    if ($_GET['success'] === 'edit') echo 'Usuario actualizado correctamente.';
                ?>
            </div>
        <?php endif; ?>

        <table class="table users-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td>
                            <?php
                                $foto_url = BASE_URL . '/public/assets/img/FOTO-SIN-PERFIL.jpg';
                                if (!empty($usuario['foto_perfil'])) {
                                    $foto_url = BASE_URL . '/public/uploads/profile_pics/' . htmlspecialchars($usuario['foto_perfil']);
                                }
                            ?>
                            <img src="<?php echo $foto_url; ?>" alt="Foto de perfil" class="profile-pic-small">
                        </td>
                        <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['correo']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                        <td class="actions-cell">
                            <a href="index.php?action=editUser&id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <?php if ($_SESSION['usuario_id'] !== $usuario['id']): // Evitar que el admin se elimine a sí mismo ?>
                                <a href="index.php?action=deleteUser&id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">Eliminar</a>
                            <?php endif; ?>
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
    border-radius: 20px; /* Aumentado para esquinas más curvas */
    box-shadow: var(--shadow-md);
    padding: 2rem;
    margin-top: 2rem;
    border: 1px solid #e0e0e0; /* Borde sutil para la tarjeta */
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
    font-size: 1.8rem;
    color: var(--text-dark);
}
.header-actions {
    display: flex;
    gap: 1rem;
}
.users-table {
    width: 100%;
    border-collapse: collapse;
}
.users-table th, .users-table td {
    padding: 0.9rem;
    text-align: left;
    vertical-align: middle;
    border: 1px solid #ddd; /* Borde delgado y oscuro para todas las celdas */
}
.users-table th {
    background-color: #3f207a;
    font-weight: 600;
    color: var(--text-secondary);
}
.profile-pic-small {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
.actions-cell {
    display: flex;
    gap: 0.5rem;
}
.btn-sm {
    padding: 0.3rem 0.7rem;
    font-size: 0.85rem;
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
