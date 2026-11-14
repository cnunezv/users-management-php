<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de carreras de taxi</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<p>
    <a class="btn btn-primary" href="?route=carreras.create">Registrar carrera</a>
</p>

<?php if (empty($carreras)): ?>
    <p>No hay carreras de taxi registradas todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Taxista</th>
                <th>Taxi</th>
                <th>Barrio inicio</th>
                <th>Barrio llegada</th>
                <th class="col-number">Km</th>
                <th class="col-number">Minutos</th>
                <th class="col-number">Pasajeros</th>
                <th class="col-number">Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carreras as $carrera): ?>
                <tr>
                    <td><?= htmlspecialchars($carrera->getCliente(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($carrera->getTaxista(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($carrera->getTaxi(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($carrera->getBarrioInicio(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($carrera->getBarrioLlegada(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-number"><?= number_format($carrera->getKilometros(), 2, ',', '.') ?></td>
                    <td class="col-number"><?= $carrera->getDuracionMinutos() ?></td>
                    <td class="col-number"><?= $carrera->getCantidadPasajeros() ?></td>
                    <td class="col-number">$ <?= number_format($carrera->getPrecio(), 0, ',', '.') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm"
                            href="?route=carreras.show&amp;id=<?= urlencode($carrera->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=carreras.edit&amp;id=<?= urlencode($carrera->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=carreras.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);" data-entity="la carrera de"
                            data-name="<?= htmlspecialchars($carrera->getCliente(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id"
                                value="<?= htmlspecialchars($carrera->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><small>Total de carreras: <?= count($carreras) ?></small></p>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
