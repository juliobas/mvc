<?php

class loginController extends Controller{
    
    private $_login;


    public function __construct() {
        parent::__construct();
        $this->_login = $this->loadModel('login');
    }
    public function index(){
        
        $this->_view->titulo = 'Iniciar Sesion';
        
        if($this->getInt('enviar') == 1)
        {
            $this->datos= $_POST;
            
            if(!$this->getAlphaNum('usuario')){
                $this->_view->_error = 'Debe introducir su nombre de usuario';
                $this->_view->renderizar('index', 'login');
                exit;
            }
            
            if(!$this->getSql('pass')){
                $this->_view->_error = 'Debe introducir su password';
                $this->_view->renderizar('index', 'login');
                exit;
            }
            
            $row = $this->_login->getUsuario($this->getAlphaNum('usuario'), $this->getSql('pass'));
            
            Session::set('autenticado', true);
            Session::set('level', 'usuario');
            Session::set('tiempo', time());
        }
        
        $this->_view->renderizar('index', 'login');
        
        
        
    }
    
    
    public function cerrar(){
        Session::destroy();
        $this->redireccionar();
    }
}
?>

