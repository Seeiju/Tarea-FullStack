<?php
class Tarea {
    public int $id;
    public string $creador;
    public string $titulo;
    public string $descripcion;
    public $fechainicio = date("Y-m-d H:i:s");
    public $fechafin = date("Y-m-d H:i:s");
    public float $duracion;

    public function __construct(int $id, string $creador, string $titulo, string $descripcion, string $fechainicio, string $fechafin, float $duracion) {
        $this->id = $id;
        $this->creador = $creador;
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fechainicio = $fechainicio;
        $this->fechafin = $fechafin;
        $this->duracion = $duracion;
    }
    public function getId(): int {
        return $this->id;
    }
    public function getCreador(): string {
        return $this->creador;
    }
    public function getTitulo(): string {
        return $this->titulo;
    }
    public function getDescripcion(): string {
        return $this->descripcion;
    }
    public function getFechainicio() {
        return $this->fechainicio;
    }
    public function getFechafin() {
        return $this->fechafin;
    }
}