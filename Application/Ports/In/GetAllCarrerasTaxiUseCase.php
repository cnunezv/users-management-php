<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllCarrerasTaxiQuery.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

interface GetAllCarrerasTaxiUseCase
{
    /**
     * @return CarreraTaxiModel[]
     */
    public function execute(GetAllCarrerasTaxiQuery $query): array;
}
