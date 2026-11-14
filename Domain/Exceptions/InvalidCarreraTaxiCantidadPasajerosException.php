<?php

declare(strict_types=1);

final class InvalidCarreraTaxiCantidadPasajerosException extends InvalidArgumentException
{
    public static function becauseValueIsOutOfRange(int $cantidad, int $min, int $max): self
    {
        return new self(
            'La cantidad de pasajeros debe estar entre ' . $min . ' y ' . $max . ': ' . $cantidad
        );
    }
}
