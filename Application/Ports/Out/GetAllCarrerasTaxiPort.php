<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

interface GetAllCarrerasTaxiPort
{
    /**
     * @return CarreraTaxiModel[]
     */
    public function getAll(): array;
}
