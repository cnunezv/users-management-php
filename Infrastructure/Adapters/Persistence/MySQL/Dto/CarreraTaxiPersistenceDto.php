<?php

declare(strict_types=1);

/**
 * DTO que viaja del modelo de dominio hacia la capa de persistencia.
 */
final class CarreraTaxiPersistenceDto
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

    public function id(): string
    {
        return $this->id;
    }

    public function cliente(): string
    {
        return $this->cliente;
    }

    public function taxi(): string
    {
        return $this->taxi;
    }

    public function kilometros(): float
    {
        return $this->kilometros;
    }

    public function barrioInicio(): string
    {
        return $this->barrioInicio;
    }

    public function barrioLlegada(): string
    {
        return $this->barrioLlegada;
    }

    public function cantidadPasajeros(): int
    {
        return $this->cantidadPasajeros;
    }

    public function taxista(): string
    {
        return $this->taxista;
    }

    public function precio(): float
    {
        return $this->precio;
    }

    public function duracionMinutos(): int
    {
        return $this->duracionMinutos;
    }
}
