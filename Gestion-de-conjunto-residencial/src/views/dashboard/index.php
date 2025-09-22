<?php
$saludo = 'Hola, ' . htmlspecialchars($rol);
?>
<div class="dashboard-card">
    <h2><?php echo $saludo; ?></h2>
    <p>Bienvenido al panel de gestión del conjunto residencial.</p>
    
    <div class="quick-actions">
        <?php 
        // Acciones rápidas según el rol
        if ($rol === 'Administrador') {
            echo '<a href="index.php?action=listUsers" class="btn btn-primary">Gestionar Usuarios</a>';
            echo '<a href="index.php?action=addUser" class="btn btn-success">Añadir Usuario</a>';
            echo '<a href="index.php?action=report" class="btn btn-info">Generar Informes</a>';
        } elseif ($rol === 'Guardia de seguridad') {
            echo '<a href="index.php?action=registerEntry" class="btn btn-success">Registrar Entrada</a>';
            echo '<a href="index.php?action=registerExit" class="btn btn-secondary">Registrar Salida</a>';
            echo '<a href="index.php?action=report" class="btn btn-info">Generar Informes</a>';
        } elseif ($rol === 'Residente' || $rol === 'Trabajador de aseo') {
            echo '<a href="index.php?action=registerEntry" class="btn btn-success">Registrar mi Entrada</a>';
            echo '<a href="index.php?action=registerExit" class="btn btn-secondary">Registrar mi Salida</a>';
            echo '<a href="index.php?action=myRecords" class="btn btn-outline-dark">Ver mis Registros</a>';
        }
        ?>
    </div>
</div>
