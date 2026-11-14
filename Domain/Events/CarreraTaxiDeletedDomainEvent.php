<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiId.php';

final class CarreraTaxiDeletedDomainEvent extends DomainEvent
{
    private CarreraTaxiId $carreraId;

    public function __construct(CarreraTaxiId $carreraId)
    {
        parent::__construct('carrera_taxi.deleted');
        $this->carreraId = $carreraId;
    }

    public function carreraId(): CarreraTaxiId
    {
        return $this->carreraId;
    }

    /**
     * @return array<string, string>
     */
    public function payload(): array
    {
        return array(
            'id' => $this->carreraId->value(),
        );
    }
}
