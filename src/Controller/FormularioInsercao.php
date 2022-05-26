<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    public function processaRequisicao(ServerRequestInterface $request):ResponseInterface
    {
        $html = "Teste";
        return new Response('200', [], $html);
    }
}