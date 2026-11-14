<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateCarreraTaxiCommand.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

interface CreateCarreraTaxiUseCase
{
    public function execute(CreateCarreraTaxiCommand $command): CarreraTaxiModel;
}
