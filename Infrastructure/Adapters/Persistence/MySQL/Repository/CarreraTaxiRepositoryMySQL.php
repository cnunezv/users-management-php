<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveCarreraTaxiPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateCarreraTaxiPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetCarreraTaxiByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllCarrerasTaxiPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteCarreraTaxiPort.php';

require_once __DIR__ . '/../Mapper/CarreraTaxiPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/CarreraTaxiModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/CarreraTaxiId.php';

/**
 * Adaptador de salida: implementa los puertos de persistencia de CarreraTaxi
 * sobre MySQL usando PDO con sentencias preparadas.
 */
final class CarreraTaxiRepositoryMySQL implements
    SaveCarreraTaxiPort,
    UpdateCarreraTaxiPort,
    GetCarreraTaxiByIdPort,
    GetAllCarrerasTaxiPort,
    DeleteCarreraTaxiPort
{
    private const COLUMNS = '
                id,
                cliente,
                taxi,
                kilometros,
                barrio_inicio,
                barrio_llegada,
                cantidad_pasajeros,
                taxista,
                precio,
                duracion_minutos,
                created_at,
                updated_at';

    private PDO $pdo;
    private CarreraTaxiPersistenceMapper $mapper;

    public function __construct(PDO $pdo, CarreraTaxiPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(CarreraTaxiModel $carrera): CarreraTaxiModel
    {
        $dto = $this->mapper->fromModelToDto($carrera);

        $sql = '
            INSERT INTO carreras_taxi (
                id,
                cliente,
                taxi,
                kilometros,
                barrio_inicio,
                barrio_llegada,
                cantidad_pasajeros,
                taxista,
                precio,
                duracion_minutos,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :cliente,
                :taxi,
                :kilometros,
                :barrio_inicio,
                :barrio_llegada,
                :cantidad_pasajeros,
                :taxista,
                :precio,
                :duracion_minutos,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->bindings($dto));

        $savedCarrera = $this->getById(new CarreraTaxiId($dto->id()));

        if ($savedCarrera === null) {
            throw new RuntimeException('The carrera de taxi could not be recovered after save.');
        }

        return $savedCarrera;
    }

    public function update(CarreraTaxiModel $carrera): CarreraTaxiModel
    {
        $dto = $this->mapper->fromModelToDto($carrera);

        $sql = '
            UPDATE carreras_taxi
               SET cliente = :cliente,
                   taxi = :taxi,
                   kilometros = :kilometros,
                   barrio_inicio = :barrio_inicio,
                   barrio_llegada = :barrio_llegada,
                   cantidad_pasajeros = :cantidad_pasajeros,
                   taxista = :taxista,
                   precio = :precio,
                   duracion_minutos = :duracion_minutos,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->bindings($dto));

        $updatedCarrera = $this->getById(new CarreraTaxiId($dto->id()));

        if ($updatedCarrera === null) {
            throw new RuntimeException('The carrera de taxi could not be recovered after update.');
        }

        return $updatedCarrera;
    }

    public function getById(CarreraTaxiId $carreraId): ?CarreraTaxiModel
    {
        $sql = '
            SELECT' . self::COLUMNS . '
            FROM carreras_taxi
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $carreraId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return CarreraTaxiModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT' . self::COLUMNS . '
            FROM carreras_taxi
            ORDER BY created_at DESC, cliente ASC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(CarreraTaxiId $carreraId): void
    {
        $sql = 'DELETE FROM carreras_taxi WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $carreraId->value(),
        ));
    }

    /**
     * @return array<string, string|int|float>
     */
    private function bindings(CarreraTaxiPersistenceDto $dto): array
    {
        return array(
            ':id' => $dto->id(),
            ':cliente' => $dto->cliente(),
            ':taxi' => $dto->taxi(),
            ':kilometros' => $dto->kilometros(),
            ':barrio_inicio' => $dto->barrioInicio(),
            ':barrio_llegada' => $dto->barrioLlegada(),
            ':cantidad_pasajeros' => $dto->cantidadPasajeros(),
            ':taxista' => $dto->taxista(),
            ':precio' => $dto->precio(),
            ':duracion_minutos' => $dto->duracionMinutos(),
        );
    }
}
