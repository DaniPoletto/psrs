<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Alura\Cursos\Entity\Curso;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class ListarCursos implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait;
    /**
     * @var ObjectRepository
     */
    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request):ResponseInterface
    {
        $cursos = $this->repositorioDeCursos->findAll();

        $html = $this->renderizaHtml('cursos/listar-cursos.php',[
            'cursos' => $cursos,
            'titulo' =>"Lista de Cursos"
        ]);
        return new Response(200, [], $html);
    }
}

?>