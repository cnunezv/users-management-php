<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetCarreraTaxiByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

interface GetCarreraTaxiByIdUseCase
{
    public function execute(GetCarreraTaxiByIdQuery $query): CarreraTaxiModel;
}
