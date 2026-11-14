<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiPrecioException.php';

/**
 * Precio cobrado por la carrera, en pesos colombianos (COP).
 */
final class CarreraTaxiPrecio
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value <= 0) {
            throw InvalidCarreraTaxiPrecioException::becauseValueIsNotPositive($value);
        }

        $this->value = round($value, 2);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equals(CarreraTaxiPrecio $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
