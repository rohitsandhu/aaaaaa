<?php


class Producte
{

    private $idProducte;
    private $nom;
    private $descripcio;
//    private $talla;
    private $sexe;
    private $categoria;
    private $preu;
//    private $quantitat;
    private $keyImatge;
    private $linkImatge;
    private $arrayTalles;
    private $existeix;


    /**
     * Producte constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getExisteix()
    {
        return $this->existeix;
    }

    /**
     * @param mixed $existeix
     */
    public function setExisteix($existeix)
    {
        $this->existeix = $existeix;
    }

    /**
     * @return mixed
     */
    public function getKeyImatge()
    {
        return $this->keyImatge;
    }

    /**
     * @param mixed $keyImatge
     */
    public function setKeyImatge($keyImatge)
    {
        $this->keyImatge = $keyImatge;
    }

    /**
     * @return mixed
     */
    public function getLinkImatge()
    {
        return $this->linkImatge;
    }

    /**
     * @param mixed $linkImatge
     */
    public function setLinkImatge($linkImatge)
    {
        $this->linkImatge = $linkImatge;
    }


    /**
     * @return mixed
     */
    public function getIdProducte()
    {
        return $this->idProducte;
    }

    /**
     * @param mixed $idProducte
     */
    public function setIdProducte($idProducte)
    {
        $this->idProducte = $idProducte;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     * @param mixed $descripcio
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;
    }


    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getPreu()
    {
        return $this->preu;
    }

    /**
     * @param mixed $preu
     */
    public function setPreu($preu)
    {
        $this->preu = $preu;
    }

    /**
     * @return mixed
     */
    public function getArrayTalles()
    {
        return $this->arrayTalles;
    }

    /**
     * @param mixed $arrayTalles
     */
    public function setArrayTalles($arrayTalles)
    {
        $this->arrayTalles = $arrayTalles;
    }


}