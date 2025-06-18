<?php
class cliente
{
    private $pdo;
    public $cod_cliente;
    public $nombre;
    public $apellidos;
    public $fecha_nacimiento;
    public $ci;
    public $nit;
    public $direccion;
    public $telefono;
    public $email;
    public $estado;
    public function __construct()
    {
        try {
            $this->pdo = database::Conectar();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Listar()
    {
        //LLENAR LA LISTA DE LA TABLA
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM cliente WHERE estado=1");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Registrar(cliente $data)
    { //INSERTAR
        try {
            $sql = "INSERT INTO
cliente(nombre,apellidos,fecha_nacimiento,ci,nit,direccion,telefono,email,estado)
VALUES(?,?,?,?,?,?,?,?,?)";
            $this->pdo->prepare($sql)->execute(array(
                //$data->cod_cliente,
                $data->nombre,
                $data->apellidos,
                $data->fecha_nacimiento,
                $data->ci,
                $data->nit,
                $data->direccion,
                $data->telefono,
                $data->email,
                $data->estado
            ));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(cliente $data)
    { //EDITAR
        try {
            $sql = "UPDATE cliente SET
nombre=?,apellidos=?,fecha_nacimiento=?,ci=?,nit=?,direccion=?,telefono=?,email=?,est
ado=? WHERE cod_cliente=?";
            $this->pdo->prepare($sql)->execute(array(
                $data->nombre,
                $data->apellidos,
                $data->fecha_nacimiento,
                $data->ci,
                $data->nit,
                $data->direccion,
                $data->telefono,
                $data->email,
                $data->estado,
                $data->cod_cliente
            ));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Eliminar($cod_cliente)
    {
        //ELIMINAR
        try {
            $sql = "UPDATE cliente SET estado=0 WHERE cod_cliente=?";
            $this->pdo->prepare($sql)->execute(array($cod_cliente));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function Obtener($cod_cliente)
    {
        //OBTIENE EL REGISTRO MUESTRA EN EL FORMULARIO PARA MODIFICAR -- MODAL EDITAR
        try {
            $sql = "SELECT * FROM cliente WHERE cod_cliente=?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array($cod_cliente));
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
        }
    }
    public function Buscar($criterio)
    {
        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT cod_cliente, CONCAT_WS(' ',nombre,apellidos) AS
nomcliente, ci, nit, direccion FROM cliente WHERE nit LIKE '%$criterio%' OR ci
LIKE '%$criterio%' ORDER BY nit LIMIT 8");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}