<?php


class Adresse
{
    public PDO $bdd;
    public function __construct(PDO $db)
    {
        $this->bdd = $db;
    }

    public function addAdress($adresse)
    {
        $adresse = (object) $adresse;
        $sql = "INSERT INTO tb_adresse(adresse,ville,pays,code_postal) VALUES(?,?,?,?)";
        $queryAdresse = $this->bdd->prepare($sql);
        return $queryAdresse->execute([$adresse->adresse, $adresse->ville, $adresse->pays, $adresse->codePostal]);
    }
    public function updateAdresse($adresse)
    {
        $adresse = (object) $adresse;

        $sql = "UPDATE tb_adresse SET adresse=?,ville=?,pays=?,code_postal=? WHERE id=?";
        $queryAdresse = $this->bdd->prepare($sql);

        return   $queryAdresse->execute([$adresse->adresse, $adresse->ville, $adresse->pays, $adresse->codePostal, $adresse->id]);;
    }

    public function removeAdresse($id)
    {

        $sql = "DELETE FROM tb_adresse WHERE id=?";
        $queryAdresse = $this->bdd->prepare($sql);
        $queryAdresse->execute([$id]);
        return $queryAdresse;
    }

    public function getAllAdresse()
    {
        $adressQuery = $this->bdd->prepare("SELECT * FROM tb_adresse ORDER BY id DESC");
        $adressQuery->execute();
        return $adressQuery;
    }
    public function getAdresseById($id)
    {
        $adressQuery = $this->bdd->prepare("SELECT * FROM tb_adresse WHERE id=? ORDER BY id DESC");
        $adressQuery->execute([$id]);
        return $adressQuery;
    }
    public function searchAdresseByAdresse($adresse)
    {
        $adresse = addcslashes($adresse, '%_');
        $adressQuery = $this->bdd->prepare("SELECT * FROM tb_adresse WHERE adresse LIKE ? OR  ville LIKE ? OR pays LIKE ? OR code_postal LIKE ?");
        $adressQuery->execute(["$adresse%", "$adresse%", "$adresse%", "$adresse%"]);
        return $adressQuery;
    }
}
