<?php

declare(strict_types=1);

final class InvalidCarreraTaxiDuracionMinutosException extends InvalidArgumentException
{
    public static function becauseValueIsNotPositive(int $duracionMinutos): self
    {
        return new self('La duración de la carrera debe ser mayor que cero minutos: ' . $duracionMinutos);
    }
}
