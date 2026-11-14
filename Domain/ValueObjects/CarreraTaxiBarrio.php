<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidCarreraTaxiBarrioException.php';

/**
 * Nombre de un barrio. Se usa tanto para el barrio de inicio como para el de llegada.
 */
final class CarreraTaxiBarrio
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidCarreraTaxiBarrioException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < self::MIN_LENGTH) {
            throw InvalidCarreraTaxiBarrioException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidCarreraTaxiBarrioException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(CarreraTaxiBarrio $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
