<?php

declare(strict_types=1);

/**
 * Datos de una carrera de taxi listos para mostrarse en las vistas.
 * Incluye valores calculados por el dominio (precio por km y velocidad promedio).
 */
final class CarreraTaxiResponse
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
    private float $precioPorKilometro;
    private float $velocidadPromedioKmH;

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
        int $duracionMinutos,
        float $precioPorKilometro,
        float $velocidadPromedioKmH
    ) {
        $this->id = $id;
        $this->cliente = $cliente;
        $this->taxi = $taxi;
        $this->kilometros = $kilometros;
        $this->barrioInicio = $barrioInicio;
        $this->barrioLlegada = $barrioLlegada;
        $this->cantidadPasajeros = $cantidadPasajeros;
        $this->taxista = $taxista;
        $this->precio = $precio;
        $this->duracionMinutos = $duracionMinutos;
        $this->precioPorKilometro = $precioPorKilometro;
        $this->velocidadPromedioKmH = $velocidadPromedioKmH;
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

    public function getPrecioPorKilometro(): float
    {
        return $this->precioPorKilometro;
    }

    public function getVelocidadPromedioKmH(): float
    {
        return $this->velocidadPromedioKmH;
    }

    /**
     * @return array<string, string|int|float>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'cliente' => $this->cliente,
            'taxi' => $this->taxi,
            'kilometros' => $this->kilometros,
            'barrioInicio' => $this->barrioInicio,
            'barrioLlegada' => $this->barrioLlegada,
            'cantidadPasajeros' => $this->cantidadPasajeros,
            'taxista' => $this->taxista,
            'precio' => $this->precio,
            'duracionMinutos' => $this->duracionMinutos,
            'precioPorKilometro' => $this->precioPorKilometro,
            'velocidadPromedioKmH' => $this->velocidadPromedioKmH,
        );
    }
}
