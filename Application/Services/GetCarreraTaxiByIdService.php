<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetCarreraTaxiByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetCarreraTaxiByIdPort.php';
require_once __DIR__ . '/Mappers/CarreraTaxiApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/CarreraTaxiNotFoundException.php';

final class GetCarreraTaxiByIdService implements GetCarreraTaxiByIdUseCase
{
    private GetCarreraTaxiByIdPort $getCarreraTaxiByIdPort;

    public function __construct(GetCarreraTaxiByIdPort $getCarreraTaxiByIdPort)
    {
        $this->getCarreraTaxiByIdPort = $getCarreraTaxiByIdPort;
    }

    public function execute(GetCarreraTaxiByIdQuery $query): CarreraTaxiModel
    {
        $carreraId = CarreraTaxiApplicationMapper::fromGetByIdQueryToCarreraTaxiId($query);
        $carrera = $this->getCarreraTaxiByIdPort->getById($carreraId);

        if ($carrera === null) {
            throw CarreraTaxiNotFoundException::becauseIdWasNotFound($carreraId->value());
        }

        return $carrera;
    }
}
