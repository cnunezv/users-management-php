<?php

declare(strict_types=1);

/**
 * Comando (CQRS): intención de modificar una carrera de taxi existente.
 */
final class UpdateCarreraTaxiCommand
{
    private string $id;
    private string $cliente;
    private string $taxi;
    private float $kilometros;
    private string $barrioInicio;
    private string $barrioLlegada;
    private int $cantidadPasajeros;
    private string $taxista;
    private float $precio;
    private int $duracionMinutos;

    public function __construct(
        string $id,
        string $cliente,
        string $taxi,
        float $kilometros,
        string $barrioInicio,
        string $barrioLlegada,
        int $cantidadPasajeros,
        string $taxista,
        float $precio,
        int $duracionMinutos
    ) {
        $this->id = trim($id);
        $this->cliente = trim($cliente);
        $this->taxi = trim($taxi);
        $this->kilometros = $kilometros;
        $this->barrioInicio = trim($barrioInicio);
        $this->barrioLlegada = trim($barrioLlegada);
        $this->cantidadPasajeros = $cantidadPasajeros;
        $this->taxista = trim($taxista);
        $this->precio = $precio;
        $this->duracionMinutos = $duracionMinutos;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCliente(): string
    {
        return $this->cliente;
    }

    public function getTaxi(): string
    {
        return $this->taxi;
    }

    public function getKilometros(): float
    {
        return $this->kilometros;
    }

    public function getBarrioInicio(): string
    {
        return $this->barrioInicio;
    }

    public function getBarrioLlegada(): string
    {
        return $this->barrioLlegada;
    }

    public function getCantidadPasajeros(): int
    {
        return $this->cantidadPasajeros;
    }

    public function getTaxista(): string
    {
        return $this->taxista;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function getDuracionMinutos(): int
    {
        return $this->duracionMinutos;
    }
}
