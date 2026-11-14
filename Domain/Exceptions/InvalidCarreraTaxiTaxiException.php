<?php

declare(strict_types=1);

final class InvalidCarreraTaxiTaxiException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('La placa del taxi no puede estar vacía.');
    }

    public static function becauseFormatIsInvalid(string $placa): self
    {
        return new self('La placa del taxi no es válida: ' . $placa . '. Formato esperado: ABC123.');
    }
}
