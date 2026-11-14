<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiTaxistaException.php';

/**
 * Nombre del taxista que realiza la carrera.
 */
final class CarreraTaxiTaxista
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidCarreraTaxiTaxistaException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < self::MIN_LENGTH) {
            throw InvalidCarreraTaxiTaxistaException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidCarreraTaxiTaxistaException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(CarreraTaxiTaxista $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
