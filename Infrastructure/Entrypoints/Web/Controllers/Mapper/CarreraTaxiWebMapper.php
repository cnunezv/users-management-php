<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateCarreraTaxiRequest.php';
require_once __DIR__ . '/../Dto/UpdateCarreraTaxiRequest.php';
require_once __DIR__ . '/../Dto/CarreraTaxiResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateCarreraTaxiCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateCarreraTaxiCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteCarreraTaxiCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetCarreraTaxiByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/CarreraTaxiModel.php';

/**
 * Traduce entre el mundo web (texto de formularios) y la capa de aplicación
 * (comandos y queries tipados), y del modelo de dominio a la respuesta web.
 */
final class CarreraTaxiWebMapper
{
    public function fromCreateRequestToCommand(CreateCarreraTaxiWebRequest $request): CreateCarreraTaxiCommand
    {
        return new CreateCarreraTaxiCommand(
            $request->getId(),
            $request->getCliente(),
            $request->getTaxi(),
            $this->toFloat($request->getKilometros()),
            $request->getBarrioInicio(),
            $request->getBarrioLlegada(),
            (int) $request->getCantidadPasajeros(),
            $request->getTaxista(),
            $this->toFloat($request->getPrecio()),
            (int) $request->getDuracionMinutos()
        );
    }

    public function fromUpdateRequestToCommand(UpdateCarreraTaxiWebRequest $request): UpdateCarreraTaxiCommand
    {
        return new UpdateCarreraTaxiCommand(
            $request->getId(),
            $request->getCliente(),
            $request->getTaxi(),
            $this->toFloat($request->getKilometros()),
            $request->getBarrioInicio(),
            $request->getBarrioLlegada(),
            (int) $request->getCantidadPasajeros(),
            $request->getTaxista(),
            $this->toFloat($request->getPrecio()),
            (int) $request->getDuracionMinutos()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetCarreraTaxiByIdQuery
    {
        return new GetCarreraTaxiByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteCarreraTaxiCommand
    {
        return new DeleteCarreraTaxiCommand($id);
    }

    public function fromModelToResponse(CarreraTaxiModel $carrera): CarreraTaxiResponse
    {
        return new CarreraTaxiResponse(
            $carrera->id()->value(),
            $carrera->cliente()->value(),
            $carrera->taxi()->value(),
            $carrera->kilometros()->value(),
            $carrera->barrioInicio()->value(),
            $carrera->barrioLlegada()->value(),
            $carrera->cantidadPasajeros()->value(),
            $carrera->taxista()->value(),
            $carrera->precio()->value(),
            $carrera->duracionMinutos()->value(),
            $carrera->precioPorKilometro(),
            $carrera->velocidadPromedioKmH()
        );
    }

    /**
     * @param CarreraTaxiModel[] $carreras
     * @return CarreraTaxiResponse[]
     */
    public function fromModelsToResponses(array $carreras): array
    {
        $responses = array();

        foreach ($carreras as $carrera) {
            $responses[] = $this->fromModelToResponse($carrera);
        }

        return $responses;
    }

    /**
     * Acepta coma o punto como separador decimal ("6,4" o "6.4").
     */
    private function toFloat(string $value): float
    {
        return (float) str_replace(',', '.', $value);
    }
}
