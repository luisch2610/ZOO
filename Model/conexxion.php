<?php
class conexion {
    public static function Conectar()
    {
        try 
        {
            $conex = new PDO("mysql:host=localhost;dbname=pos_Zoologico","root","");
            return $conex;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}