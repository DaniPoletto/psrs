<?php

namespace Alura\Cursos\Entity;
// o \ no JsonSerializable indica q é uma classe com namespace global

/**
 * @Entity
 * @Table(name="cursos")
 */
class Curso implements \JsonSerializable
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $descricao;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao
        ];
    }
}
