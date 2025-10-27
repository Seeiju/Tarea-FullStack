<?php
class Usuario {
    public int $id;
    public string $nombre;
    public string $apellido;
    public string $correo;
    public string $contrasena;

    public function __construct(int $id, string $nombre, string $apellido, string $correo, string $contrasena) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
    }
    public function getId(): int {
        return $this->id;
    }
    public function getNom(): string {
        return $this->nombre;
    }
    public function getApellido(): string {
        return $this->apellido;
    }
    public function getCorreo(): string {
        return $this->correo;
    }
    public function getContrasena(): string {
        return $this->contrasena;
    }
}