<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllCarrerasTaxiUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllCarrerasTaxiPort.php';

final class GetAllCarrerasTaxiService implements GetAllCarrerasTaxiUseCase
{
    private GetAllCarrerasTaxiPort $getAllCarrerasTaxiPort;

    public function __construct(GetAllCarrerasTaxiPort $getAllCarrerasTaxiPort)
    {
        $this->getAllCarrerasTaxiPort = $getAllCarrerasTaxiPort;
    }

    /**
     * @return CarreraTaxiModel[]
     */
    public function execute(GetAllCarrerasTaxiQuery $query): array
    {
        return $this->getAllCarrerasTaxiPort->getAll();
    }
}
