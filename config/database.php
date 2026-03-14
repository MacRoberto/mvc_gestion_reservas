<?php

class Database
{
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $basedatos = 'mvp_reservas_hotel';

    public function conectar()
    {
        try {
            $conexion = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->basedatos . ';charset=utf8',
                $this->usuario,
                $this->password
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $conexion;
        } catch (PDOException $e) {
            echo '<h2>Error de conexion</h2>';
            echo '<p>' . $e->getMessage() . '</p>';
            return false;
        }
    }
}
