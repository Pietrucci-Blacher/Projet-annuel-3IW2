<?php

namespace App\Models;
use App\Core\Database;
class User extends Database
{
    private ?int $id = null;
    protected string $email;
    protected string $password;
    protected string $firstname;
    protected string $lastname;
    protected ?int $status = null;
    protected ?int $token = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public function setEmail($email): void
    {
        $this->email = strtolower(trim($email));
    }


    public function getPassword(): string
    {
        return $this->password;
    }


    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


    public function getFirstname(): string
    {
        return $this->firstname;
    }


    public function setFirstname($firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }


    public function getLastname(): string
    {
        return $this->lastname;
    }


    public function setLastname($lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }


    public function getStatus(): int
    {
        return $this->status;
    }


    public function setStatus($status): void
    {
        $this->status = $status;
    }


    public function getToken(): ?string
    {
        return $this->token;
    }


    public function generateToken(): void
    {
        $this->token = str_shuffle(md5(uniqid()));
    }

}