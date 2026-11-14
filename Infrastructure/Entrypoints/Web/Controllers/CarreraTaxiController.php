<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/CarreraTaxiWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreateCarreraTaxiUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateCarreraTaxiUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetCarreraTaxiByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllCarrerasTaxiUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteCarreraTaxiUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllCarrerasTaxiQuery.php';

/**
 * Adaptador de entrada web del CRUDL de CarreraTaxi.
 * Solo conoce los puertos de entrada (casos de uso), nunca sus implementaciones.
 */
final class CarreraTaxiController
{
    private CreateCarreraTaxiUseCase $createCarreraTaxiUseCase;
    private UpdateCarreraTaxiUseCase $updateCarreraTaxiUseCase;
    private GetCarreraTaxiByIdUseCase $getCarreraTaxiByIdUseCase;
    private GetAllCarrerasTaxiUseCase $getAllCarrerasTaxiUseCase;
    private DeleteCarreraTaxiUseCase $deleteCarreraTaxiUseCase;
    private CarreraTaxiWebMapper $mapper;

    public function __construct(
        CreateCarreraTaxiUseCase $createCarreraTaxiUseCase,
        UpdateCarreraTaxiUseCase $updateCarreraTaxiUseCase,
        GetCarreraTaxiByIdUseCase $getCarreraTaxiByIdUseCase,
        GetAllCarrerasTaxiUseCase $getAllCarrerasTaxiUseCase,
        DeleteCarreraTaxiUseCase $deleteCarreraTaxiUseCase,
        CarreraTaxiWebMapper $mapper
    ) {
        $this->createCarreraTaxiUseCase = $createCarreraTaxiUseCase;
        $this->updateCarreraTaxiUseCase = $updateCarreraTaxiUseCase;
        $this->getCarreraTaxiByIdUseCase = $getCarreraTaxiByIdUseCase;
        $this->getAllCarrerasTaxiUseCase = $getAllCarrerasTaxiUseCase;
        $this->deleteCarreraTaxiUseCase = $deleteCarreraTaxiUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return CarreraTaxiResponse[]
     */
    public function index(): array
    {
        $carreras = $this->getAllCarrerasTaxiUseCase->execute(new GetAllCarrerasTaxiQuery());

        return $this->mapper->fromModelsToResponses($carreras);
    }

    public function show(string $id): CarreraTaxiResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $carrera = $this->getCarreraTaxiByIdUseCase->execute($query);

        return $this->mapper->fromModelToResponse($carrera);
    }

    public function store(CreateCarreraTaxiWebRequest $request): CarreraTaxiResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $carrera = $this->createCarreraTaxiUseCase->execute($command);

        return $this->mapper->fromModelToResponse($carrera);
    }

    public function update(UpdateCarreraTaxiWebRequest $request): CarreraTaxiResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $carrera = $this->updateCarreraTaxiUseCase->execute($command);

        return $this->mapper->fromModelToResponse($carrera);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteCarreraTaxiUseCase->execute($command);
    }
}
