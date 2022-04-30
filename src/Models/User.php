<?php

class User
{
    public PDO $bdd;
    public function __construct(PDO $DB)
    {
        $this->bdd = $DB;
    }


    /**
     ** function permettant d'enregister un utilisateur
     *
     * @param array $user
     */
    public function register($user): bool
    {
        $user = (object) $user;
        $stmtUserEmail = $this->getUserEmail($user->email);

        if ($stmtUserEmail->rowCount() <= 0) {
            $sql = "INSERT INTO users(nom,prenom,adresse,email,password) VALUES(?,?,?,?,?)";
            $userQuery = $this->bdd->prepare($sql);

            return   $userQuery->execute([$user->nom, $user->prenom, $user->adresse, $user->email, $user->password]);;
        } else {
            return false;
        }
    }
    /**
     * Undocumented function
     *
     * @param string $email
     * @return PDOStatement
     */
    public function getUserEmail($email): PDOStatement
    {
        $sql = "SELECT * from users WHERE  email=? ";
        $userQuery = $this->bdd->prepare($sql);
        $userQuery->execute([$email]);

        return $userQuery;
    }
    public function getUserById($user): PDOStatement
    {
        $user = (object) $user;

        $sql = "SELECT * from users WHERE  id=? ";
        $userQuery = $this->bdd->prepare($sql);
        $userQuery->execute([$user->id]);

        return $userQuery;
    }

    public function getAllUser()
    {
        $sql = "SELECT * from users";
        $userQuery = $this->bdd->prepare($sql);
        $userQuery->execute();
        return $userQuery;
    }
}
