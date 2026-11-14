<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateCarreraTaxiUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveCarreraTaxiPort.php';
require_once __DIR__ . '/Mappers/CarreraTaxiApplicationMapper.php';

final class CreateCarreraTaxiService implements CreateCarreraTaxiUseCase
{
    private SaveCarreraTaxiPort $saveCarreraTaxiPort;

    public function __construct(SaveCarreraTaxiPort $saveCarreraTaxiPort)
    {
        $this->saveCarreraTaxiPort = $saveCarreraTaxiPort;
    }

    public function execute(CreateCarreraTaxiCommand $command): CarreraTaxiModel
    {
        $carrera = CarreraTaxiApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveCarreraTaxiPort->save($carrera);
    }
}
