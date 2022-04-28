<?php

class Articles
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
     * @return bool
     */
    /**
     * Undocumented function
     *
     * @param string $email
     * @return PDOStatement
     */
    public function getArticlesById($id): PDOStatement
    {
        $sql = "SELECT * from articles WHERE  id=? ";
        $userQuery = $this->bdd->prepare($sql);
        $userQuery->execute([$id]);

        return $userQuery;
    }
    public function getArticlesByIdUser($id): PDOStatement
    {
        $sql = "SELECT * from articles WHERE  id_user=?  ";
        $userQuery = $this->bdd->prepare($sql);
        $userQuery->execute([$id]);

        return $userQuery;
    }

    public function getAllArticles()
    {
        $sql = "SELECT * from articles";
        $userQuery = $this->bdd->prepare($sql);
        $userQuery->execute();
        return $userQuery;
    }
}
