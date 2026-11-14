<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateCarreraTaxiUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateCarreraTaxiPort.php';
require_once __DIR__ . '/../Ports/Out/GetCarreraTaxiByIdPort.php';
require_once __DIR__ . '/Mappers/CarreraTaxiApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/CarreraTaxiNotFoundException.php';

final class UpdateCarreraTaxiService implements UpdateCarreraTaxiUseCase
{
    private UpdateCarreraTaxiPort $updateCarreraTaxiPort;
    private GetCarreraTaxiByIdPort $getCarreraTaxiByIdPort;

    public function __construct(
        UpdateCarreraTaxiPort $updateCarreraTaxiPort,
        GetCarreraTaxiByIdPort $getCarreraTaxiByIdPort
    ) {
        $this->updateCarreraTaxiPort = $updateCarreraTaxiPort;
        $this->getCarreraTaxiByIdPort = $getCarreraTaxiByIdPort;
    }

    public function execute(UpdateCarreraTaxiCommand $command): CarreraTaxiModel
    {
        $carreraToUpdate = CarreraTaxiApplicationMapper::fromUpdateCommandToModel($command);
        $currentCarrera = $this->getCarreraTaxiByIdPort->getById($carreraToUpdate->id());

        if ($currentCarrera === null) {
            throw CarreraTaxiNotFoundException::becauseIdWasNotFound($carreraToUpdate->id()->value());
        }

        return $this->updateCarreraTaxiPort->update($carreraToUpdate);
    }
}
