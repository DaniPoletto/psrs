# Gerenciador de cursos implementando PSRS 

Projeto Desenvolvido durante curso de MVC da Alura mostrando uso de MVC implementando PSRS.

![Alt Text](https://github.com/DaniPoletto/psrs/blob/main/demo.gif)

![Alt Text](https://github.com/DaniPoletto/psrs/blob/main/demo2.gif)

### Projeto sem as PSRS

[Projeto sem as PSRS](https://github.com/DaniPoletto/gerenciador-de-curso)

### Requisitos

Instalação do [composer](https://getcomposer.org/). 

### Inicialização
Na pasta do projeto, abra o terminal e digite o comando para instalar as dependências:

```
composer install
```

Suba um servidor teste com o comando:
```
php -S localhost:8080 -t public
```

Somente a pasta public ficará acessível. 

E acesse pelo link 
```
http://localhost:8080/listar-cursos
```

Em caso de erro nas classes usando Doctrine
```
vendor\bin\doctrine orm:generate-proxies
```

Em casos de outros erros:
```
composer require symfony/cache
```

```
composer require doctrine/annotations
```

Pacotes utilizado:
```
composer require psr/http-message
```

```
composer require nyholm/psr7
```

```
composer require nyholm/psr7-server
```

```
composer require psr/http-server-handler
```

```
composer require php-di/php-di
```

PSRS implementadas:

PSR-4 - Autoloading

PSR-7 - HTTP message interface

PSR-11 - Container interface

PSR-15 - HTTP Server Request Handlers

[Mais informações sobre PSRS](https://www.php-fig.org/psr/)

