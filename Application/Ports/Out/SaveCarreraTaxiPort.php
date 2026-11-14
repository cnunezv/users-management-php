<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

interface SaveCarreraTaxiPort
{
    public function save(CarreraTaxiModel $carrera): CarreraTaxiModel;
}
