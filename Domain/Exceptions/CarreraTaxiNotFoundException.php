<?php

declare(strict_types=1);

final class CarreraTaxiNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self('No se encontró la carrera de taxi con id ' . $id . '.');
    }
}
