<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar carrera de taxi</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=carreras.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($carrera->getId(), ENT_QUOTES, 'UTF-8') ?>">

    <?php
    // Si el formulario volvió con errores se muestran los datos digitados ($old);
    // si no, los datos actuales de la carrera.
    $values = !empty($old) ? $old : array(
        'cliente' => $carrera->getCliente(),
        'taxista' => $carrera->getTaxista(),
        'taxi' => $carrera->getTaxi(),
        'barrioInicio' => $carrera->getBarrioInicio(),
        'barrioLlegada' => $carrera->getBarrioLlegada(),
        'kilometros' => (string) $carrera->getKilometros(),
        'duracionMinutos' => (string) $carrera->getDuracionMinutos(),
        'cantidadPasajeros' => (string) $carrera->getCantidadPasajeros(),
        'precio' => (string) $carrera->getPrecio(),
    );
    require __DIR__ . '/_form.php';
    ?>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    &nbsp;
    <a class="btn" href="?route=carreras.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
