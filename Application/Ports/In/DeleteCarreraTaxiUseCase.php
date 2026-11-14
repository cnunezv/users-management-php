<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteCarreraTaxiCommand.php';

interface DeleteCarreraTaxiUseCase
{
    public function execute(DeleteCarreraTaxiCommand $command): void;
}
