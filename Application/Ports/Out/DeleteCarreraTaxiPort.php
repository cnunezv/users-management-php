<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/CarreraTaxiId.php';

interface DeleteCarreraTaxiPort
{
    public function delete(CarreraTaxiId $carreraId): void;
}
