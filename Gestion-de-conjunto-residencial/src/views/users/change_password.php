<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container">
    <div class="form-container" style="max-width: 500px;">
        <a href="index.php?action=<?php echo $cancel_url; ?>" class="back-link">&larr; Volver</a>
        <h2 class="form-title">Cambiar Contraseña</h2>

        <?php if (!empty($mensaje)): ?>
            <div class="message error-message"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=changePassword&from=<?php echo $from; ?>">
            <?php if ($pedir_correo): ?>
                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" required>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="actual">Contraseña Actual</label>
                <input type="password" id="actual" name="actual" required>
            </div>

            <div class="form-group">
                <label for="nueva">Nueva Contraseña</label>
                <input type="password" id="nueva" name="nueva" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
