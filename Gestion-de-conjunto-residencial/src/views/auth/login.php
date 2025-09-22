<div class="form-container" style="max-width: 450px;">
    <div class="card">
        <div class="card-header">
            <h3>Iniciar Sesión</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            <form action="index.php?action=handle_login" method="POST">
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <p>¿No tienes una cuenta? <a href="index.php?action=register" class="link-primary">Regístrate aquí</a></p>
                <p><a href="index.php?action=changePassword&from=login" class="link-primary">¿Olvidaste tu contraseña?</a></p>
            </div>
        </div>
    </div>
</div>
