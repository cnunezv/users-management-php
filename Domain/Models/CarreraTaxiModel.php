<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/CarreraTaxiId.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiCliente.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiTaxi.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiKilometros.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiBarrio.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiCantidadPasajeros.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiTaxista.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiPrecio.php';
require_once __DIR__ . '/../ValueObjects/CarreraTaxiDuracionMinutos.php';

/**
 * Modelo de dominio del ejercicio 19: una carrera (servicio) de taxi.
 *
 * Es inmutable: cada cambio devuelve una nueva instancia. Nunca puede existir
 * en estado inválido porque todas sus propiedades son value objects.
 */
final class CarreraTaxiModel
{
    private CarreraTaxiId $id;
    private CarreraTaxiCliente $cliente;
    private CarreraTaxiTaxi $taxi;
    private CarreraTaxiKilometros $kilometros;
    private CarreraTaxiBarrio $barrioInicio;
    private CarreraTaxiBarrio $barrioLlegada;
    private CarreraTaxiCantidadPasajeros $cantidadPasajeros;
    private CarreraTaxiTaxista $taxista;
    private CarreraTaxiPrecio $precio;
    private CarreraTaxiDuracionMinutos $duracionMinutos;

    public function __construct(
        CarreraTaxiId $id,
        CarreraTaxiCliente $cliente,
        CarreraTaxiTaxi $taxi,
        CarreraTaxiKilometros $kilometros,
        CarreraTaxiBarrio $barrioInicio,
        CarreraTaxiBarrio $barrioLlegada,
        CarreraTaxiCantidadPasajeros $cantidadPasajeros,
        CarreraTaxiTaxista $taxista,
        CarreraTaxiPrecio $precio,
        CarreraTaxiDuracionMinutos $duracionMinutos
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
    }

    public static function create(
        CarreraTaxiId $id,
        CarreraTaxiCliente $cliente,
        CarreraTaxiTaxi $taxi,
        CarreraTaxiKilometros $kilometros,
        CarreraTaxiBarrio $barrioInicio,
        CarreraTaxiBarrio $barrioLlegada,
        CarreraTaxiCantidadPasajeros $cantidadPasajeros,
        CarreraTaxiTaxista $taxista,
        CarreraTaxiPrecio $precio,
        CarreraTaxiDuracionMinutos $duracionMinutos
    ): self {
        return new self(
            $id,
            $cliente,
            $taxi,
            $kilometros,
            $barrioInicio,
            $barrioLlegada,
            $cantidadPasajeros,
            $taxista,
            $precio,
            $duracionMinutos
        );
    }

    public function id(): CarreraTaxiId
    {
        return $this->id;
    }

    public function cliente(): CarreraTaxiCliente
    {
        return $this->cliente;
    }

    public function taxi(): CarreraTaxiTaxi
    {
        return $this->taxi;
    }

    public function kilometros(): CarreraTaxiKilometros
    {
        return $this->kilometros;
    }

    public function barrioInicio(): CarreraTaxiBarrio
    {
        return $this->barrioInicio;
    }

    public function barrioLlegada(): CarreraTaxiBarrio
    {
        return $this->barrioLlegada;
    }

    public function cantidadPasajeros(): CarreraTaxiCantidadPasajeros
    {
        return $this->cantidadPasajeros;
    }

    public function taxista(): CarreraTaxiTaxista
    {
        return $this->taxista;
    }

    public function precio(): CarreraTaxiPrecio
    {
        return $this->precio;
    }

    public function duracionMinutos(): CarreraTaxiDuracionMinutos
    {
        return $this->duracionMinutos;
    }

    // ── Comportamiento del dominio ─────────────────────────────

    /**
     * Precio cobrado por cada kilómetro recorrido.
     */
    public function precioPorKilometro(): float
    {
        return round($this->precio->value() / $this->kilometros->value(), 2);
    }

    /**
     * Velocidad promedio de la carrera en km/h.
     */
    public function velocidadPromedioKmH(): float
    {
        return round($this->kilometros->value() / ($this->duracionMinutos->value() / 60), 2);
    }

    /**
     * Indica si la carrera empezó y terminó en el mismo barrio.
     */
    public function esDentroDelMismoBarrio(): bool
    {
        return mb_strtolower($this->barrioInicio->value()) === mb_strtolower($this->barrioLlegada->value());
    }

    public function changePrecio(CarreraTaxiPrecio $precio): self
    {
        return new self(
            $this->id,
            $this->cliente,
            $this->taxi,
            $this->kilometros,
            $this->barrioInicio,
            $this->barrioLlegada,
            $this->cantidadPasajeros,
            $this->taxista,
            $precio,
            $this->duracionMinutos
        );
    }

    public function changeTaxista(CarreraTaxiTaxista $taxista): self
    {
        return new self(
            $this->id,
            $this->cliente,
            $this->taxi,
            $this->kilometros,
            $this->barrioInicio,
            $this->barrioLlegada,
            $this->cantidadPasajeros,
            $taxista,
            $this->precio,
            $this->duracionMinutos
        );
    }

    /**
     * @return array<string, string|int|float>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'cliente' => $this->cliente->value(),
            'taxi' => $this->taxi->value(),
            'kilometros' => $this->kilometros->value(),
            'barrioInicio' => $this->barrioInicio->value(),
            'barrioLlegada' => $this->barrioLlegada->value(),
            'cantidadPasajeros' => $this->cantidadPasajeros->value(),
            'taxista' => $this->taxista->value(),
            'precio' => $this->precio->value(),
            'duracionMinutos' => $this->duracionMinutos->value(),
        );
    }
}
