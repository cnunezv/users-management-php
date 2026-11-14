<?php

declare(strict_types=1);

/**
 * Query (CQRS): consulta de una carrera de taxi por su id.
 */
final class GetCarreraTaxiByIdQuery
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = trim($id);
    }

    public function getId(): string
    {
        return $this->id;
    }
}
