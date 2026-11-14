<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiCantidadPasajerosException.php';

/**
 * Cantidad de pasajeros transportados.
 * Regla de negocio: un taxi lleva mínimo 1 y máximo 4 pasajeros.
 */
final class CarreraTaxiCantidadPasajeros
{
    public const MIN = 1;
    public const MAX = 4;

    private int $value;

    public function __construct(int $value)
    {
        if ($value < self::MIN || $value > self::MAX) {
            throw InvalidCarreraTaxiCantidadPasajerosException::becauseValueIsOutOfRange(
                $value,
                self::MIN,
                self::MAX
            );
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(CarreraTaxiCantidadPasajeros $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
