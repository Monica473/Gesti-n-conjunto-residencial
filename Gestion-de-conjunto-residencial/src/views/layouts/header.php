<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Gestión de Conjunto Residencial'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/custom.css">
</head>
<body>
    <?php if (isset($_SESSION['usuario_id'])):
        // Lógica para determinar la URL de la foto de perfil
        $foto_perfil_url = BASE_URL . '/public/assets/img/FOTO-SIN-PERFIL.jpg'; // Foto por defecto
        if (isset($_SESSION['foto_perfil']) && !empty($_SESSION['foto_perfil'])) {
            $foto_perfil_url = BASE_URL . '/public/uploads/profile_pics/' . htmlspecialchars($_SESSION['foto_perfil']);
        }
    ?>
        <header class="header">
            <a href="index.php?action=dashboard">
                <img src="<?php echo BASE_URL; ?>/public/assets/img/M-S-LOGO-PROYECTO.jpg" alt="Logo" class="logo">
            </a>
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></span>
                <a href="index.php?action=profile">
                    <img src="<?php echo $foto_perfil_url; ?>" alt="Foto de perfil" class="profile-pic">
                </a>
                <a href="index.php?action=logout" class="btn btn-outline-dark">Cerrar Sesión</a>
            </div>
        </header>
    <?php endif; ?>

    <div class="main-container <?php echo isset($_SESSION['usuario_id']) ? 'dashboard' : ''; ?>">
