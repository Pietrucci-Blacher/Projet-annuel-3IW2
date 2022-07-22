<?php

namespace App\Models;

use App\Core\Database;

class User extends Database
{

    protected $id = null;
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $status = null;
    protected $token = null;
    protected $confirmed;
    protected $role;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return mixed
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param null $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param null
     * Token char 32
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getRole(): string
    {
        return $this->role;
    }


    public function save()
    {
        parent::save();
    }


    public function getFormRegister(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "uploadform" => "multipart/form-data",
                "submit" => "S'inscrire"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "id" => "emailRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Email incorrect",
                    "unicity" => true,
                    "errorUnicity" => "Email existe déjà en bdd"
                ],
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Prénom ...",
                    "id" => "firstnameRegister",
                    "class" => "inputRegister",
                    "min" => 2,
                    "max" => 50,
                    "error" => "Votre prénom n'est pas correct",
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Nom ...",
                    "id" => "lastnameRegister",
                    "class" => "inputRegister",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom n'est pas correct",
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe ...",
                    "id" => "pwdRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire entre 4 et 16 et contenir des chiffres et des lettres",
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation ...",
                    "id" => "pwdConfirmRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "confirm" => "password",
                    "error" => "Votre mot de passe de confirmation doit être identique au mot de passe",
                ],
                // "captcha"=>[
                //     "type" => "",
                //     "class" => "h-captcha",
                //     "sitekey" => CAPTCHA_SITEKEY
                // ],
            ],
        ];
    }


    public function getFormLogin(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Se connecter"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "id" => "emailRegister",
                    "class" => "inputRegister",
                    "required" => true,
                ],
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe ...",
                    "id" => "pwdRegister",
                    "class" => "inputRegister",
                    "required" => true,
                ],

            ]

        ];
    }

    public function getFormResetPassword(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Envoyer"
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "id" => "emailRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Email incorrect",
                ],

            ]

        ];
    }

    public function getFormNewPassword(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "submit" => "Se connecter"
            ],
            "inputs" => [
                "password" => [
                    "type" => "password",
                    "placeholder" => "Votre mot de passe ...",
                    "id" => "pwdRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Votre mot de passe doit faire entre 4 et 16 et contenir des chiffres et des lettres",
                ],
                "passwordConfirm" => [
                    "type" => "password",
                    "placeholder" => "Confirmation ...",
                    "id" => "pwdConfirmRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "confirm" => "password",
                ],

            ]

        ];
    }


    public function getFormEditUser($value = []): array
    {


        $roles = [
            ["value" => "admin", "name" => "Admin", "selected" => $value["role"] == "admin"],
            ["value" => "user", "name" => "User", "selected" => $value["role"] == "user"],
        ];

        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "uploadform" => "multipart/form-data",
                "submit" => "Modifier"
            ],
            "inputs" => [
                "email" => [
                    "label" => "Email",
                    "type" => "email",
                    "placeholder" => "Votre email ...",
                    "value" => $value["email"] ?? "",
                    "id" => "emailRegister",
                    "class" => "inputRegister",
                    "required" => true,
                    "error" => "Email incorrect",
                    "unicity" => true,
                    "errorUnicity" => "Email existe déjà en bdd"
                ],
                "firstname" => [
                    "label" => "Prénom",
                    "type" => "text",
                    "placeholder" => "Prénom ...",
                    "value" => $value["firstname"] ?? "",
                    "id" => "firstnameRegister",
                    "class" => "inputRegister",
                    "min" => 2,
                    "max" => 50,
                    "error" => "Votre prénom n'est pas correct",
                ],
                "lastname" => [
                    "label" => "Nom",
                    "type" => "text",
                    "placeholder" => "Nom ...",
                    "value" => $value["lastname"] ?? "",
                    "id" => "lastnameRegister",
                    "class" => "inputRegister",
                    "min" => 2,
                    "max" => 100,
                    "error" => "Votre nom n'est pas correct",
                ],
                "select" => [
                    "label" => "Rôle",
                    "options" => $roles,
                    "type" => "select",
                    "id" => "role",
                    "class" => "role",
                    "error" => "Le rôle doit être sélectionnée",
                    "required" => true,
                ],
            ],
        ];
    }
}
