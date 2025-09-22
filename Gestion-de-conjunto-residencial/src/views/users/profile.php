<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container">
    <div class="form-container" style="max-width: 600px;">
        <a href="index.php?action=dashboard" class="back-link">&larr; Volver al Panel</a>
        <h2 class="form-title">Mi Perfil</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="message <?php echo $mensaje_tipo === 'success' ? 'success-message' : 'error-message'; ?>"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=profile" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($usuario['nombre']); ?>">
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required value="<?php echo htmlspecialchars($usuario['apellido']); ?>">
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required value="<?php echo htmlspecialchars($usuario['correo']); ?>">
            </div>

            <div class="form-group">
                <label for="rol">Rol</label>
                <input type="text" id="rol" name="rol" readonly disabled value="<?php echo htmlspecialchars($usuario['rol']); ?>">
            </div>

            <div class="form-group">
                <label for="foto_perfil">Foto de Perfil (Opcional)</label>
                <input type="file" id="foto_perfil" name="foto_perfil">
                <?php if (!empty($usuario['foto_perfil'])):
                    $foto_url = BASE_URL . '/public/uploads/profile_pics/' . htmlspecialchars($usuario['foto_perfil']);
                ?>
                    <div style="margin-top: 1rem;">
                        <p>Foto actual:</p>
                        <img src="<?php echo $foto_url; ?>" alt="Foto de perfil actual" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Actualizar Perfil</button>
        </form>

        <hr style="margin: 2rem 0;">

        <a href="index.php?action=changePassword&from=profile" class="btn btn-secondary btn-block">Cambiar Contraseña</a>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
