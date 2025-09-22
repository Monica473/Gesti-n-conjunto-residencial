<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container content-high-center">
    <div class="form-container" style="max-width: 500px;">
        <a href="index.php?action=dashboard" class="back-link">&larr; Volver al Panel</a>
        <h2 class="form-title">Registrar Salida</h2>
        <p style="text-align: center; margin-bottom: 2rem;">Confirma para registrar tu hora de salida del conjunto residencial.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="message success-message"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=registerExit">
            <button type="submit" class="btn btn-primary btn-block" style="background-color: var(--primary-color);">Confirmar Salida</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
