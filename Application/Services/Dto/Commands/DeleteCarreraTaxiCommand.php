<?php

declare(strict_types=1);

/**
 * Comando (CQRS): intención de eliminar una carrera de taxi.
 */
final class DeleteCarreraTaxiCommand
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
