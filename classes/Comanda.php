<?php


class Comanda
{

    private $idComanda;
    private $idUsuari;
    private $acabat;
    private $preuTotal;
    private $comandaIva;
    private $data;

    /**
     * Comanda constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdComanda()
    {
        return $this->idComanda;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @param mixed $idComanda
     */
    public function setIdComanda($idComanda)
    {
        $this->idComanda = $idComanda;
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
    public function getAcabat()
    {
        return $this->acabat;
    }

    /**
     * @param mixed $acabat
     */
    public function setAcabat($acabat)
    {
        $this->acabat = $acabat;
    }

    /**
     * @return mixed
     */
    public function getPreuTotal()
    {
        return $this->preuTotal;
    }

    /**
     * @param mixed $preuTotal
     */
    public function setPreuTotal($preuTotal)
    {
        $this->preuTotal = $preuTotal;
    }

    /**
     * @return mixed
     */
    public function getComandaIva()
    {
        return $this->comandaIva;
    }

    /**
     * @param mixed $comandaIva
     */
    public function setComandaIva($comandaIva)
    {
        $this->comandaIva = $comandaIva;
    }


}