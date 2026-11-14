<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de la carrera de taxi</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table class="detail-table">
    <tr>
        <th>ID</th>
        <td class="col-id"><?= htmlspecialchars($carrera->getId(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Cliente</th>
        <td><?= htmlspecialchars($carrera->getCliente(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Taxista</th>
        <td><?= htmlspecialchars($carrera->getTaxista(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Taxi (placa)</th>
        <td><?= htmlspecialchars($carrera->getTaxi(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Barrio de inicio</th>
        <td><?= htmlspecialchars($carrera->getBarrioInicio(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Barrio de llegada</th>
        <td><?= htmlspecialchars($carrera->getBarrioLlegada(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Kilómetros</th>
        <td><?= number_format($carrera->getKilometros(), 2, ',', '.') ?> km</td>
    </tr>
    <tr>
        <th>Duración</th>
        <td><?= $carrera->getDuracionMinutos() ?> minutos</td>
    </tr>
    <tr>
        <th>Pasajeros</th>
        <td><?= $carrera->getCantidadPasajeros() ?></td>
    </tr>
    <tr>
        <th>Precio</th>
        <td>$ <?= number_format($carrera->getPrecio(), 0, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Precio por km</th>
        <td>$ <?= number_format($carrera->getPrecioPorKilometro(), 0, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Velocidad promedio</th>
        <td><?= number_format($carrera->getVelocidadPromedioKmH(), 1, ',', '.') ?> km/h</td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=carreras.edit&amp;id=<?= urlencode($carrera->getId()) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=carreras.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
