<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container content-high-center">
    <div class="form-container" style="max-width: 500px;">
        <a href="index.php?action=dashboard" class="back-link">&larr; Volver al Panel</a>
        <h2 class="form-title">Registrar Entrada</h2>
        <p style="text-align: center; margin-bottom: 2rem;">Confirma para registrar tu hora de entrada al conjunto residencial.</p>

        <?php if (!empty($mensaje)): ?>
            <div class="message success-message"><?php echo htmlspecialchars($mensaje); ?></div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=registerEntry">
            <button type="submit" class="btn btn-primary btn-block">Confirmar Entrada</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
