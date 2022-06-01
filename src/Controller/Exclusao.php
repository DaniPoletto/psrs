<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Alura\Cursos\Entity\Curso;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Helper\FlashMessageTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Exclusao implements RequestHandlerInterface
{
    use FlashMessageTrait;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function handle(ServerRequestInterface $request):ResponseInterface
    {
        $id = filter_var(
            $request->getQueryParams()['id'],
            FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/listar-cursos']);
        if(is_null($id) || $id === false){
            $this->defineMensagem(
                'danger',
                'Curso inexistente'
            );
            return $resposta;
        }

        $entidade = $this->entityManager
                        ->getReference(Curso::class, $id);
        $this->entityManager->remove($entidade);
        $this->entityManager->flush();

        $this->defineMensagem(
            'success',
            'Curso excluído com sucesso'
        );

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}