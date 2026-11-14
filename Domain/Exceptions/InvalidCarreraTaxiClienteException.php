<?php

declare(strict_types=1);

final class InvalidCarreraTaxiClienteException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('El nombre del cliente no puede estar vacío.');
    }

    public static function becauseLengthIsTooShort(int $minLength): self
    {
        return new self('El nombre del cliente debe tener al menos ' . $minLength . ' caracteres.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('El nombre del cliente no puede superar los ' . $maxLength . ' caracteres.');
    }
}
