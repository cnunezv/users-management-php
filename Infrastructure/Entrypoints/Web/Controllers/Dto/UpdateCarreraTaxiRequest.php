<?php

declare(strict_types=1);

/**
 * Datos crudos (texto) del formulario web para editar una carrera de taxi.
 */
final class UpdateCarreraTaxiWebRequest
{
    private string $id;
    private string $cliente;
    private string $taxi;
    private string $kilometros;
    private string $barrioInicio;
    private string $barrioLlegada;
    private string $cantidadPasajeros;
    private string $taxista;
    private string $precio;
    private string $duracionMinutos;

    public function __construct(
        string $id,
        string $cliente,
        string $taxi,
        string $kilometros,
        string $barrioInicio,
        string $barrioLlegada,
        string $cantidadPasajeros,
        string $taxista,
        string $precio,
        string $duracionMinutos
    ) {
        $this->id = trim($id);
        $this->cliente = trim($cliente);
        $this->taxi = trim($taxi);
        $this->kilometros = trim($kilometros);
        $this->barrioInicio = trim($barrioInicio);
        $this->barrioLlegada = trim($barrioLlegada);
        $this->cantidadPasajeros = trim($cantidadPasajeros);
        $this->taxista = trim($taxista);
        $this->precio = trim($precio);
        $this->duracionMinutos = trim($duracionMinutos);
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

    public function getKilometros(): string
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

    public function getCantidadPasajeros(): string
    {
        return $this->cantidadPasajeros;
    }

    public function getTaxista(): string
    {
        return $this->taxista;
    }

    public function getPrecio(): string
    {
        return $this->precio;
    }

    public function getDuracionMinutos(): string
    {
        return $this->duracionMinutos;
    }
}
