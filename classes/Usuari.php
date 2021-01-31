<?php


class Usuari
{
    private $idUsuari;
    private $rol;
    private $correu;
    private $nom;
    private $cognoms;
    private $contra;
    private $dni;
    private $adreça;
    private $token;
    private $activat;

    /**
     * Usuari constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdUsuari()
    {
        return $this->idUsuari;
    }

    /**
     * @param mixed $idUsuari
     */
    public function setIdUsuari($idUsuari)
    {
        $this->idUsuari = $idUsuari;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getCorreu()
    {
        return $this->correu;
    }

    /**
     * @param mixed $correu
     */
    public function setCorreu($correu)
    {
        $this->correu = $correu;
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
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     * @param mixed $cognoms
     */
    public function setCognoms($cognoms)
    {
        $this->cognoms = $cognoms;
    }

    /**
     * @return mixed
     */
    public function getContra()
    {
        return $this->contra;
    }

    /**
     * @param mixed $contra
     */
    public function setContra($contra)
    {
        $this->contra = $contra;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @return mixed
     */
    public function getAdreça()
    {
        return $this->adreça;
    }

    /**
     * @param mixed $adreça
     */
    public function setAdreça($adreça)
    {
        $this->adreça = $adreça;
    }


    public function setDades($usuari){

    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getActivat()
    {
        return $this->activat;
    }

    /**
     * @param mixed $activat
     */
    public function setActivat($activat)
    {
        $this->activat = $activat;
    }
}


