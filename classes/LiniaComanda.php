<?php


class LiniaComanda
{
    private $idLiniaComanda;
    private $idProducte;
    private $quantitat;
    private $preuTotal;
    private $talla;
    private $idComanda;

    /**
     * LiniaComanda constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getIdLiniaComanda()
    {
        return $this->idLiniaComanda;
    }

    /**
     * @param mixed $idLiniaComanda
     */
    public function setIdLiniaComanda($idLiniaComanda)
    {
        $this->idLiniaComanda = $idLiniaComanda;
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
    public function getQuantitat()
    {
        return $this->quantitat;
    }

    /**
     * @param mixed $quantitat
     */
    public function setQuantitat($quantitat)
    {
        $this->quantitat = $quantitat;
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
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * @param mixed $talla
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    }

    /**
     * @return mixed
     */
    public function getIdComanda()
    {
        return $this->idComanda;
    }

    /**
     * @param mixed $idComanda
     */
    public function setIdComanda($idComanda)
    {
        $this->idComanda = $idComanda;
    }



}