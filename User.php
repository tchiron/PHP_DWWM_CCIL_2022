<?php

class User
{
    protected int $id_user;
    protected string $pseudo;
    protected ?string $pwd;
    protected string $email;
    protected string $created_at;

    /**
     * Vérifie la correspondance de la propriété pwd avec une chaîne de caractère fourni
     *
     * @param string $pwd Chaîne de caractère à vérifier
     * @return bool Renvoi true si la correspondance est vrai, sinon false
     */
    public function verifyPwd(string $pwd) : bool
    {
        return ($this->pwd === $pwd);
    }

    /**
     * Suppression du mot de passe de la propriété de l'objet
     */
    public function erasePwd()
    {
        $this->pwd = null;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->id_user;
    }

    /**
     * @param int $id_user
     */
    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * @return string
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd(string $pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}