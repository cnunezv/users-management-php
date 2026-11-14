<?php

declare(strict_types=1);

final class InvalidCarreraTaxiPrecioException extends InvalidArgumentException
{
    public static function becauseValueIsNotPositive(float $precio): self
    {
        return new self('El precio de la carrera debe ser mayor que cero: ' . $precio);
    }
}
