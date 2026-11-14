<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiKilometrosException.php';

/**
 * Distancia recorrida en la carrera, en kilómetros.
 */
final class CarreraTaxiKilometros
{
    private const MAX_KILOMETROS = 1000.0;

    private float $value;

    public function __construct(float $value)
    {
        if ($value <= 0) {
            throw InvalidCarreraTaxiKilometrosException::becauseValueIsNotPositive($value);
        }

        if ($value > self::MAX_KILOMETROS) {
            throw InvalidCarreraTaxiKilometrosException::becauseValueIsTooHigh(self::MAX_KILOMETROS);
        }

        $this->value = round($value, 2);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equals(CarreraTaxiKilometros $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
