<?php

namespace Alura\Cursos\Controller;

use Nyholm\Psr7\Response;
use Alura\Cursos\Entity\Curso;
use Psr\Http\Message\ResponseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Helper\FlashMessageTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
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
        $descricao = filter_var(
            $request->getParsedBody()['descricao'],
            FILTER_SANITIZE_STRING
        );
        
        $curso = new Curso();
        $curso->setDescricao($descricao);

        $id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

        //se tem id
        if(!is_null($id) && $id !== false){
            //atualizar
            $curso->setId($id);
            //unir isso com o q tem no banco
            $this->entityManager->merge($curso);
            $this->defineMensagem(
                'success',
                'Curso atualizado com sucesso'
            );
        }else{
            $this->entityManager->persist($curso);
            $this->defineMensagem(
                'success',
                'Curso inserido com sucesso'
            );
        }

        $this->entityManager->flush();

        return new Response(302, ['Location' => '/listar-cursos']);
    }
}