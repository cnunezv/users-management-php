<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateCarreraTaxiCommand.php';
require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

interface UpdateCarreraTaxiUseCase
{
    public function execute(UpdateCarreraTaxiCommand $command): CarreraTaxiModel;
}
