<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                //Comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario) {
                    //Verificar el password
                    if ($usuario->comprobarPassVerificado($auth->password)) {
                        //Autenticar el usuario
                        if (!isset($_SESSION)) {
                            session_start();
                        }

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento

                        if ($usuario->admin === "1") {
                            $_SESSION['admin'] === $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    } 
                }else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('/auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        echo "Desde Logout";
       
        
    }

    public static function olvide(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){ 
            }

        }
        
        $router->render('auth/olvide-password', [
            'alertas' =>$alertas
        ]);
        
    }

    public static function recuperar(){
        echo"Desde recuperar";
        
    }

    public static function crear(Router $router){

    //Instanciar usuario
        $usuario = new Usuario;

        //Alertas Vacio
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio
            if(empty($alertas)){
                //Validar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                }else{
                    //Hashear el password
                    $usuario->hashPassword();

                    // Generar un Token unico
                    $usuario->crearToken();

                    //Enviar el Email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location:/mensaje');
                    }

                    // debuguear($usuario);

                }
            }
        }
        $router->render('auth/crear-cuenta', [
            'usuario'=> $usuario,
            'alertas'=> $alertas

        ]);
        
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje');

    }

    public static function confirmar(Router $router){
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            //Mostrarmensaje de error
            Usuario::setAlerta('error', 'Token No Valido');

        }else{
            //Mostrar Usuario Confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito','Cuenta Comprobada Correctamente');
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',[
            'alertas' =>$alertas
        ]);
    }

}
