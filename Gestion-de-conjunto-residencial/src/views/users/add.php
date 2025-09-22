<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container">
    <div class="form-container" style="max-width: 600px;">
        <div class="nav-links-container" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <a href="index.php?action=listUsers" class="back-link">&larr; Volver a la lista</a>
            <a href="index.php?action=dashboard" class="btn btn-secondary btn-sm">Volver al Panel</a>
        </div>
        <h2 class="form-title">Añadir Nuevo Usuario</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="message error-message"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=addUser" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required value="<?php echo htmlspecialchars($_POST['apellido'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required value="<?php echo htmlspecialchars($_POST['correo'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="" disabled selected>Seleccione un rol</option>
                    <option value="Administrador" <?php echo (($_POST['rol'] ?? '') === 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="Residente" <?php echo (($_POST['rol'] ?? '') === 'Residente') ? 'selected' : ''; ?>>Residente</option>
                    <option value="Guardia de seguridad" <?php echo (($_POST['rol'] ?? '') === 'Guardia de seguridad') ? 'selected' : ''; ?>>Guardia de seguridad</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>

            <div class="form-group">
                <label for="confirmar_contraseña">Confirmar Contraseña</label>
                <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
            </div>

            <div class="form-group">
                <label for="foto_perfil">Foto de Perfil (Opcional)</label>
                <input type="file" id="foto_perfil" name="foto_perfil">
            </div>

            <div class="form-group" style="margin-top: 1.5rem;">
                <button type="submit" class="btn-submit" style="width: 100%;">Añadir Usuario</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
