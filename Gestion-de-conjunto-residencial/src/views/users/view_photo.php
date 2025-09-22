<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="main-container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="text-center">
        <img src="<?php echo $ruta_foto; ?>" alt="Foto de perfil" class="profile-pic-large-view">
        <a href="index.php?action=<?php echo $volver; ?>" class="btn btn-primary mt-4">
            Volver
        </a>
    </div>
</div>

<style>
.profile-pic-large-view {
    width: 280px;
    height: 280px;
    object-fit: cover;
    border-radius: 50%;
    border: 6px solid var(--primary-color);
    box-shadow: var(--shadow-lg);
}
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
