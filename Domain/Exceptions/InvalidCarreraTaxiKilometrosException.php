<?php

declare(strict_types=1);

final class InvalidCarreraTaxiKilometrosException extends InvalidArgumentException
{
    public static function becauseValueIsNotPositive(float $kilometros): self
    {
        return new self('Los kilómetros de la carrera deben ser mayores que cero: ' . $kilometros);
    }

    public static function becauseValueIsTooHigh(float $maxKilometros): self
    {
        return new self('Los kilómetros de la carrera no pueden superar ' . $maxKilometros . ' km.');
    }
}
