<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Alura\Cursos\Infra\EntityManagerCreator;

$containerBuilder = new ContainerBuilder();

//quando requisitar um EntityManagerInterface, automaticamente vai retornar um EntityManager
$containerBuilder->addDefinitions([
    EntityManagerInterface::class => function (){
       return (new EntityManagerCreator())->getEntityManager(); 
    },
]);

return $containerBuilder->build();