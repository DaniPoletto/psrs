<?php
require __DIR__ . '/../vendor/autoload.php';

use Nyholm\Psr7\Factory\Psr17Factory;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;
use Nyholm\Psr7Server\ServerRequestCreator;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if(!array_key_exists($caminho, $rotas)){
    http_response_code(404);
    exit();
}

// session_start();
// $ehRotaDeLogin = stripos($caminho, 'login');

// //está logado tentando acessar a página de login
// if(isset($_SESSION['logado']) && $ehRotaDeLogin!==false){
//     header("Location: /listar-cursos");
//     exit();
// }

// //não está logado e tenta acessar uma página que não é de login
// if(!isset($_SESSION['logado']) && $ehRotaDeLogin===false){
//     header("Location: /login");
//     exit();
// }

$psr17Factory = new Psr17Factory();

$creator = new ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory  // StreamFactory
);

$request = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];
/**@var InterfaceControladorRequisicao $controlador */
$controlador = new $classeControladora();
$resposta = $controlador->processaRequisicao($request);

foreach ($resposta->getHeaders() as $name => $value) {
    foreach($values as $value){
        header(sprintf('%s: %s', $name, $value), false);
    }
}

echo $resposta->getBody();
?>