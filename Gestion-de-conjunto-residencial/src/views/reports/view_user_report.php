<?php
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
            <h1 class="my-4">Informe de Usuario</h1>
            
            <?php if (isset($user) && $user):
                $foto_url = BASE_URL . '/public/assets/img/FOTO-SIN-PERFIL.jpg';
                if (!empty($user['foto_perfil'])) {
                    $foto_url = BASE_URL . '/public/uploads/profile_pics/' . htmlspecialchars($user['foto_perfil']);
                }

                // Estilo condicional para la imagen
                $image_style = 'width: 40%; height: auto; display: block; margin-left: auto; margin-right: auto;'; // Estilo por defecto
                if ($user['rol'] === 'Administrador') {
                    $image_style = 'width: 150px; height: 150px; object-fit: cover; display: block; margin-left: auto; margin-right: auto;'; // Estilo para Admin
                }
            ?>
                <div class="card">
                    <div class="card-body">
                        <img src="<?php echo $foto_url; ?>" alt="Foto de perfil" class="img-fluid rounded-circle mb-3" style="<?php echo $image_style; ?>">
                        <h5 class="card-title"><?php echo htmlspecialchars($user['nombre']) . ' ' . htmlspecialchars($user['apellido']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($user['correo']); ?></p>
                        <p class="card-text"><strong>Rol:</strong> <?php echo htmlspecialchars($user['rol']); ?></p>
                    </div>
                </div>

                <h2 class="my-4">Registros de Actividad (Últimos 30 días)</h2>
                <?php if (isset($records) && !empty($records)): ?>
                    <ul class="list-group">
                        <?php foreach ($records as $record): ?>
                            <li class="list-group-item">
                                <strong>Tipo:</strong> <?php echo htmlspecialchars($record['tipo']); ?> - 
                                <strong>Fecha:</strong> <?php echo htmlspecialchars($record['fecha_hora']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No hay registros de actividad en los últimos 30 días.</p>
                <?php endif; ?>

            <?php else: ?>
                <p>Usuario no encontrado.</p>
            <?php endif; ?>
            
            <a href="index.php?action=report" class="btn btn-primary mt-4">Volver a generar informe</a>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
