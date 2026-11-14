<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteCarreraTaxiUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteCarreraTaxiPort.php';
require_once __DIR__ . '/../Ports/Out/GetCarreraTaxiByIdPort.php';
require_once __DIR__ . '/Mappers/CarreraTaxiApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/CarreraTaxiNotFoundException.php';

final class DeleteCarreraTaxiService implements DeleteCarreraTaxiUseCase
{
    private DeleteCarreraTaxiPort $deleteCarreraTaxiPort;
    private GetCarreraTaxiByIdPort $getCarreraTaxiByIdPort;

    public function __construct(
        DeleteCarreraTaxiPort $deleteCarreraTaxiPort,
        GetCarreraTaxiByIdPort $getCarreraTaxiByIdPort
    ) {
        $this->deleteCarreraTaxiPort = $deleteCarreraTaxiPort;
        $this->getCarreraTaxiByIdPort = $getCarreraTaxiByIdPort;
    }

    public function execute(DeleteCarreraTaxiCommand $command): void
    {
        $carreraId = CarreraTaxiApplicationMapper::fromDeleteCommandToCarreraTaxiId($command);
        $existingCarrera = $this->getCarreraTaxiByIdPort->getById($carreraId);

        if ($existingCarrera === null) {
            throw CarreraTaxiNotFoundException::becauseIdWasNotFound($carreraId->value());
        }

        $this->deleteCarreraTaxiPort->delete($carreraId);
    }
}
