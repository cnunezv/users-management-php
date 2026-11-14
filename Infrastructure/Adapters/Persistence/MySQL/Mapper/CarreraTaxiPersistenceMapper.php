<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CarreraTaxiPersistenceDto.php';
require_once __DIR__ . '/../Entity/CarreraTaxiEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/CarreraTaxiModel.php';

final class CarreraTaxiPersistenceMapper
{
    public function fromModelToDto(CarreraTaxiModel $carrera): CarreraTaxiPersistenceDto
    {
        return new CarreraTaxiPersistenceDto(
            $carrera->id()->value(),
            $carrera->cliente()->value(),
            $carrera->taxi()->value(),
            $carrera->kilometros()->value(),
            $carrera->barrioInicio()->value(),
            $carrera->barrioLlegada()->value(),
            $carrera->cantidadPasajeros()->value(),
            $carrera->taxista()->value(),
            $carrera->precio()->value(),
            $carrera->duracionMinutos()->value()
        );
    }

    /**
     * @param array<string, mixed> $row
     */
    public function fromRowToEntity(array $row): CarreraTaxiEntity
    {
        return new CarreraTaxiEntity(
            (string) $row['id'],
            (string) $row['cliente'],
            (string) $row['taxi'],
            (float) $row['kilometros'],
            (string) $row['barrio_inicio'],
            (string) $row['barrio_llegada'],
            (int) $row['cantidad_pasajeros'],
            (string) $row['taxista'],
            (float) $row['precio'],
            (int) $row['duracion_minutos'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(CarreraTaxiEntity $entity): CarreraTaxiModel
    {
        return new CarreraTaxiModel(
            new CarreraTaxiId($entity->id()),
            new CarreraTaxiCliente($entity->cliente()),
            new CarreraTaxiTaxi($entity->taxi()),
            new CarreraTaxiKilometros($entity->kilometros()),
            new CarreraTaxiBarrio($entity->barrioInicio()),
            new CarreraTaxiBarrio($entity->barrioLlegada()),
            new CarreraTaxiCantidadPasajeros($entity->cantidadPasajeros()),
            new CarreraTaxiTaxista($entity->taxista()),
            new CarreraTaxiPrecio($entity->precio()),
            new CarreraTaxiDuracionMinutos($entity->duracionMinutos())
        );
    }

    /**
     * @param array<string, mixed> $row
     */
    public function fromRowToModel(array $row): CarreraTaxiModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return CarreraTaxiModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
