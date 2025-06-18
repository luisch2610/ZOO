<?php
require_once 'model/cliente.php';
class ClienteController
{
    private $model;
    public function __construct()
    {
        $this->model = new cliente();
    }
    public function Index()
    {
        require_once 'view/header.php';
        require_once 'view/cliente/cliente.php';
        require_once 'view/footer.php';
    }
    public function Crud()
    {
        $prod = new cliente();
        if (isset($_REQUEST['cod_cliente'])) {
            $prod = $this->model->Obtener($_REQUEST['cod_cliente']);
        }
        require_once 'view/header.php';
        require_once 'view/cliente/cliente.php';
        require_once 'view/footer.php';
    }
    public function Nuevo()
    {
        $prod = new cliente();
        require_once 'view/header.php';
        require_once 'view/cliente/cliente.php';
        require_once 'view/footer.php';
    }
    public function Guardar()
    { //NUEVO
        $prod = new cliente();
        $prod->cod_cliente = $_REQUEST['cod_cliente'];
        $prod->nombre = $_REQUEST['nombre'];
        $prod->apellidos = $_REQUEST['apellidos'];
        $prod->fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
        $prod->ci = $_REQUEST['ci'];
        $prod->nit = $_REQUEST['nit'];
        $prod->direccion = $_REQUEST['direccion'];
        $prod->telefono = $_REQUEST['telefono'];
        $prod->email = $_REQUEST['email'];
        $prod->estado = $_REQUEST['estado'];
        $this->model->Registrar($prod);
        header('Location: index.php?c=cliente');
    }
    public function Editar()
    {
        $prod = new cliente();
        $prod->cod_cliente = $_REQUEST['cod_cliente'];
        $prod->nombre = $_REQUEST['nombre'];
        $prod->apellidos = $_REQUEST['apellidos'];
        $prod->fecha_nacimiento = $_REQUEST['fecha_nacimiento'];
        $prod->ci = $_REQUEST['ci'];
        $prod->nit = $_REQUEST['nit'];
        $prod->direccion = $_REQUEST['direccion'];
        $prod->telefono = $_REQUEST['telefono'];
        $prod->email = $_REQUEST['email'];
        $prod->estado = $_REQUEST['estado'];
        $this->model->Actualizar($prod);
        header('Location: index.php?c=cliente');
    }
    public function Eliminar()
    {
        $this->model->Eliminar($_REQUEST['cod_cliente']);
        header('Location: index.php?c=cliente');
    }
}