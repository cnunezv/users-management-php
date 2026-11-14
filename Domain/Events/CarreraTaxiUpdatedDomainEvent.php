<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../Models/CarreraTaxiModel.php';

final class CarreraTaxiUpdatedDomainEvent extends DomainEvent
{
    private CarreraTaxiModel $carrera;

    public function __construct(CarreraTaxiModel $carrera)
    {
        parent::__construct('carrera_taxi.updated');
        $this->carrera = $carrera;
    }

    public function carrera(): CarreraTaxiModel
    {
        return $this->carrera;
    }

    /**
     * @return array<string, string|int|float>
     */
    public function payload(): array
    {
        return $this->carrera->toArray();
    }
}
