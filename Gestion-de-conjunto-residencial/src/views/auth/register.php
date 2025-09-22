<div class="form-container" style="max-width: 550px;">
    <div class="card">
        <div class="card-header">
            <h3>Registro de Usuario</h3>
        </div>
        <div class="card-body">
            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            <form action="index.php?action=handle_register" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-control" id="rol" name="rol" required>
                        <option value="Residente">Residente</option>
                        <option value="Guardia de seguridad">Guardia de seguridad</option>
                        <option value="Trabajador de aseo">Trabajador de aseo</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_contraseña" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confirmar_contraseña" name="confirmar_contraseña" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto_perfil" class="form-label">Foto de Perfil (Opcional)</label>
                    <input type="file" class="form-control" id="foto_perfil" name="foto_perfil">
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <p>¿Ya tienes una cuenta? <a href="index.php?action=login" class="link-primary">Inicia sesión</a></p>
            </div>
        </div>
    </div>
</div>
