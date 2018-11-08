<?php

namespace Dotmailer\Entity;

final class Address implements Arrayable
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @param int|null $id
     * @param string $email
     */
    public function __construct(?int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email
        ];
    }
}
