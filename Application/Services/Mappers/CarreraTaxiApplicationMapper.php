<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateCarreraTaxiCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateCarreraTaxiCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteCarreraTaxiCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetCarreraTaxiByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/CarreraTaxiModel.php';

/**
 * Traduce los DTOs de aplicación (comandos y queries) a objetos del dominio.
 * Aquí es donde los datos primitivos se convierten en value objects y,
 * por lo tanto, donde se disparan las validaciones del dominio.
 */
final class CarreraTaxiApplicationMapper
{
    public static function fromCreateCommandToModel(CreateCarreraTaxiCommand $command): CarreraTaxiModel
    {
        return CarreraTaxiModel::create(
            new CarreraTaxiId($command->getId()),
            new CarreraTaxiCliente($command->getCliente()),
            new CarreraTaxiTaxi($command->getTaxi()),
            new CarreraTaxiKilometros($command->getKilometros()),
            new CarreraTaxiBarrio($command->getBarrioInicio()),
            new CarreraTaxiBarrio($command->getBarrioLlegada()),
            new CarreraTaxiCantidadPasajeros($command->getCantidadPasajeros()),
            new CarreraTaxiTaxista($command->getTaxista()),
            new CarreraTaxiPrecio($command->getPrecio()),
            new CarreraTaxiDuracionMinutos($command->getDuracionMinutos())
        );
    }

    public static function fromUpdateCommandToModel(UpdateCarreraTaxiCommand $command): CarreraTaxiModel
    {
        return new CarreraTaxiModel(
            new CarreraTaxiId($command->getId()),
            new CarreraTaxiCliente($command->getCliente()),
            new CarreraTaxiTaxi($command->getTaxi()),
            new CarreraTaxiKilometros($command->getKilometros()),
            new CarreraTaxiBarrio($command->getBarrioInicio()),
            new CarreraTaxiBarrio($command->getBarrioLlegada()),
            new CarreraTaxiCantidadPasajeros($command->getCantidadPasajeros()),
            new CarreraTaxiTaxista($command->getTaxista()),
            new CarreraTaxiPrecio($command->getPrecio()),
            new CarreraTaxiDuracionMinutos($command->getDuracionMinutos())
        );
    }

    public static function fromGetByIdQueryToCarreraTaxiId(GetCarreraTaxiByIdQuery $query): CarreraTaxiId
    {
        return new CarreraTaxiId($query->getId());
    }

    public static function fromDeleteCommandToCarreraTaxiId(DeleteCarreraTaxiCommand $command): CarreraTaxiId
    {
        return new CarreraTaxiId($command->getId());
    }
}
