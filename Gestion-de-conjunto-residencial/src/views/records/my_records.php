<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container content-high-center">
    <div class="users-card records-centered">
        <div class="card-header">
            <h1>Mis Registros de Entradas y Salidas</h1>
            <a href="index.php?action=dashboard" class="btn btn-secondary">Volver al Panel</a>
        </div>

        <div class="mb-3">
            <strong>Usuario:</strong> <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?> <br>
            <strong>Rol:</strong> <?php echo htmlspecialchars($_SESSION['rol']); ?>
        </div>

        <?php if (empty($registros)): ?>
            <div class="alert alert-info">No tienes registros de entrada o salida.</div>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $r): ?>
                        <tr>
                            <td><?php echo ucfirst(htmlspecialchars($r['tipo'])); ?></td>
                            <td><?php echo htmlspecialchars($r['fecha_hora']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
