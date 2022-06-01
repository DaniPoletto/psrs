<?php
namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Alura\Cursos\Entity\Curso;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Helper\FlashMessageTrait;
use Doctrine\Persistence\ObjectRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Alura\Cursos\Helper\RenderizadorDeHtmlTrait;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorDeHtmlTrait, FlashMessageTrait;

    /**
     * @var ObjectRepository
     */
    private $repositorioCursos;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioCursos = $this->entityManager
            ->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request):ResponseInterface
    {
        $id = filter_var($request->getQueryParams()['id'], 
                        FILTER_VALIDATE_INT);

        if(is_null($id) || $id === false){
            $this->defineMensagem(
                'danger',
                'ID de curso inválido'
            );
            return new Response(302, ['Location' => '/listar-cursos']);
        }

        $curso = $this->repositorioCursos->find($id);

        $html = $this->renderizaHtml('cursos/formulario.php',[
            'curso' => $curso,
            'titulo' => "Alterar Curso ".$curso->getDescricao()
        ]);

        return new Response(200, [], $html);
    }
}
?>