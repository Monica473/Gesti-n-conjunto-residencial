<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container">
    <div class="form-container" style="max-width: 600px;">
        <a href="index.php?action=listUsers" class="back-link">&larr; Volver a la lista</a>
        <h2 class="form-title">Editar Usuario</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="message error-message"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=editUser&id=<?php echo $usuario['id']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" class="form-control" value="<?php echo htmlspecialchars($usuario['correo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <select name="rol" id="rol" class="form-control" required>
                    <option value="Administrador" <?php echo ($usuario['rol'] === 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="Guardia de seguridad" <?php echo ($usuario['rol'] === 'Guardia de seguridad' || $usuario['rol'] === 'Guardia') ? 'selected' : ''; ?>>Guardia de seguridad</option>
                    <option value="Residente" <?php echo ($usuario['rol'] === 'Residente') ? 'selected' : ''; ?>>Residente</option>
                    <option value="Trabajador de aseo" <?php echo ($usuario['rol'] === 'Trabajador de aseo') ? 'selected' : ''; ?>>Trabajador de aseo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto_perfil">Foto de Perfil (Opcional)</label>
                <input type="file" name="foto_perfil" id="foto_perfil" class="form-control">
                <?php if ($usuario['foto_perfil']): ?>
                    <p class="form-text">Foto actual:</p>
                    <img src="uploads/profile_pics/<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto actual" style="max-width: 100px; border-radius: 8px; margin-top: 5px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
