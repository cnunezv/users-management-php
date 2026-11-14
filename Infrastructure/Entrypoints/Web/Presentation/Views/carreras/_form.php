<?php declare(strict_types=1); ?>
<?php
/**
 * Campos compartidos por los formularios de registro y edición de carreras.
 *
 * Variables esperadas:
 * @var array<string, string> $values  Valores actuales de cada campo.
 * @var array<string, string> $errors  Errores de validación por campo.
 * @var int $minPasajeros
 * @var int $maxPasajeros
 */
$e = static function (string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
};

$fieldError = static function (string $field) use ($errors, $e): string {
    return empty($errors[$field]) ? '' : '<div class="field-error">' . $e($errors[$field]) . '</div>';
};
?>

<div class="form-group">
    <label for="cliente">Cliente</label><br>
    <input type="text" id="cliente" name="cliente" maxlength="100" required
        value="<?= $e($values['cliente'] ?? '') ?>">
    <?= $fieldError('cliente') ?>
</div>

<div class="form-group">
    <label for="taxista">Taxista</label><br>
    <input type="text" id="taxista" name="taxista" maxlength="100" required
        value="<?= $e($values['taxista'] ?? '') ?>">
    <?= $fieldError('taxista') ?>
</div>

<div class="form-group">
    <label for="taxi">Taxi <small>(placa, formato ABC123)</small></label><br>
    <input type="text" id="taxi" name="taxi" maxlength="7" required placeholder="ABC123"
        value="<?= $e($values['taxi'] ?? '') ?>">
    <?= $fieldError('taxi') ?>
</div>

<div class="form-group">
    <label for="barrioInicio">Barrio de inicio</label><br>
    <input type="text" id="barrioInicio" name="barrioInicio" maxlength="100" required
        value="<?= $e($values['barrioInicio'] ?? '') ?>">
    <?= $fieldError('barrioInicio') ?>
</div>

<div class="form-group">
    <label for="barrioLlegada">Barrio de llegada</label><br>
    <input type="text" id="barrioLlegada" name="barrioLlegada" maxlength="100" required
        value="<?= $e($values['barrioLlegada'] ?? '') ?>">
    <?= $fieldError('barrioLlegada') ?>
</div>

<div class="form-group">
    <label for="kilometros">Kilómetros</label><br>
    <input type="number" id="kilometros" name="kilometros" min="0.01" step="0.01" required
        value="<?= $e($values['kilometros'] ?? '') ?>">
    <?= $fieldError('kilometros') ?>
</div>

<div class="form-group">
    <label for="duracionMinutos">Duración <small>(minutos)</small></label><br>
    <input type="number" id="duracionMinutos" name="duracionMinutos" min="1" step="1" required
        value="<?= $e($values['duracionMinutos'] ?? '') ?>">
    <?= $fieldError('duracionMinutos') ?>
</div>

<div class="form-group">
    <label for="cantidadPasajeros">Cantidad de pasajeros</label><br>
    <select id="cantidadPasajeros" name="cantidadPasajeros">
        <?php for ($n = $minPasajeros; $n <= $maxPasajeros; $n++): ?>
            <option value="<?= $n ?>" <?= ((string) ($values['cantidadPasajeros'] ?? '') === (string) $n) ? 'selected' : '' ?>>
                <?= $n ?>
            </option>
        <?php endfor; ?>
    </select>
    <?= $fieldError('cantidadPasajeros') ?>
</div>

<div class="form-group">
    <label for="precio">Precio <small>(COP)</small></label><br>
    <input type="number" id="precio" name="precio" min="1" step="0.01" required
        value="<?= $e($values['precio'] ?? '') ?>">
    <?= $fieldError('precio') ?>
</div>
