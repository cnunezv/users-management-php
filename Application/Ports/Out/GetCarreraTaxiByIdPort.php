<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/CarreraTaxiId.php';

interface GetCarreraTaxiByIdPort
{
    public function getById(CarreraTaxiId $carreraId): ?CarreraTaxiModel;
}
