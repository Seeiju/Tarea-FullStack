<?php
class TareaCompartida {
    public int $tareaId;
    public int $usuarioId;
    public $fechaCompartida = date("Y-m-d H:i:s");

    public function __construct(int $tareaId, int $usuarioId, string $fechaCompartida) {
        $this->tareaId = $tareaId;
        $this->usuarioId = $usuarioId;
        $this->fechaCompartida = $fechaCompartida;
    }
    public function getTareaId(): int {
        return $this->tareaId;
    }
    public function getUsuarioId(): int {
        return $this->usuarioId;
    }
    public function getFechaCompartida(): string {
        return $this->fechaCompartida;
    }
}