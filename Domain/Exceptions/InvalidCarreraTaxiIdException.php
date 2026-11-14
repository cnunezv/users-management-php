<?php

declare(strict_types=1);

final class InvalidCarreraTaxiIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El id de la carrera no puede estar vacío.');
    }
}
