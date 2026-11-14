<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiTaxiException.php';

/**
 * Taxi que realiza la carrera, identificado por su placa.
 * Regla de negocio: placa colombiana de servicio público, tres letras y tres dígitos (ABC123).
 * Se normaliza a mayúsculas y sin espacios ni guiones.
 */
final class CarreraTaxiTaxi
{
    private const PLACA_PATTERN = '/^[A-Z]{3}[0-9]{3}$/';

    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = strtoupper(str_replace(array(' ', '-'), '', trim($value)));

        if ($normalizedValue === '') {
            throw InvalidCarreraTaxiTaxiException::becauseValueIsEmpty();
        }

        if (preg_match(self::PLACA_PATTERN, $normalizedValue) !== 1) {
            throw InvalidCarreraTaxiTaxiException::becauseFormatIsInvalid($normalizedValue);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(CarreraTaxiTaxi $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
