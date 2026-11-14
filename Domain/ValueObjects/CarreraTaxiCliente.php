<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiClienteException.php';

/**
 * Nombre del cliente que solicita la carrera.
 */
final class CarreraTaxiCliente
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidCarreraTaxiClienteException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < self::MIN_LENGTH) {
            throw InvalidCarreraTaxiClienteException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidCarreraTaxiClienteException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(CarreraTaxiCliente $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
