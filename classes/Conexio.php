<?php

class Conexio
{
    private $host;
    private $db;
    private $dsn;
    private $user;
    private $pass;
    public $conexio;

    public function __construct()
    {
        $this->host = 'botiga-roba-rohit.cabv0dktetcn.us-east-1.rds.amazonaws.com';
        $this->db = "Shoppu";
        $this->dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db . ';';
        $this->user = 'rohit';
        $this->pass = "rohitisadmin";
    }

    public function openConnection()
    {
        try {
            $this->conexio = new PDO($this->dsn, $this->user, $this->pass);

            return $this->conexio;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
            return null;
        }
    }

    public function closeConnection()
    {
        try {
            $this->conexio = null;
            return $this->conexio;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
            return null;
        }
    }


    public function addUsuari($user)
    {
        try {
            $sql = "INSERT INTO usuaris (correu,nom,cognoms,contra,token,rol) VALUES(:correu, :nom, :cognoms, :contra, :token, :rol)";

            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':correu', $user->getCorreu());
            $statement->bindParam(':nom', $user->getNom());
            $statement->bindParam(':contra', $user->getContra());
            $statement->bindParam(':cognoms', $user->getCognoms());
            $statement->bindParam(':rol', $user->getRol());
            $statement->bindParam(':token', $user->getToken());
            $statement->execute();

            return null;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getAllUsuaris()
    {
        try {
            $query = "SELECT * FROM usuaris";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array());

            $result = $statement->fetchAll();

            $arrayReturn = [];

            for ($i = 0; $i < count($result); $i++) {
                $user = new Usuari();
                $user->setIdUsuari($result[$i]['idUsuari']);
                $user->setCorreu($result[$i]['correu']);
                $user->setCognoms($result[$i]['cognoms']);
                $user->setNom($result[$i]['nom']);
                $user->setContra($result[$i]['contra']);
                $user->setAdreça($result[$i]['adreca']);
                $user->setRol($result[$i]['rol']);
                $user->setDni($result[$i]['dni']);
                $user->setActivat($result[$i]['activat']);
                $user->setToken($result[$i]['token']);
                array_push($arrayReturn, $user);
            }
            return $arrayReturn;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getTokenByIdUsuari(string $idUsuari)
    {
        try {
            $query = "SELECT * FROM usuaris where idUsuari=:idUsuari ";
            $statement = $this->conexio->prepare($query);
            $statement->execute(
                array(
                    ':idUsuari' => $idUsuari
                )
            );
            $result = $statement->fetch();
            return $result['token'];
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getUsuariPerCorreu($correu)
    {
        try {
            $query = "SELECT * FROM usuaris WHERE correu=:correu";
            $statement = $this->conexio->prepare($query);
            $statement->execute(
                array(
                    ':correu' => $correu
                )
            );
            $result = $statement->fetch();

            $user = new Usuari();
            $user->setIdUsuari($result['idUsuari']);
            $user->setCorreu($result['correu']);
            $user->setCognoms($result['cognoms']);
            $user->setNom($result['nom']);
            $user->setContra($result['contra']);
            $user->setAdreça($result['adreca']);
            $user->setRol($result['rol']);
            $user->setDni($result['dni']);
            $user->setToken($result['token']);
            $user->setActivat($result['activat']);
            return $user;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function activarUser($idUsuari)
    {
        try {
            $sql = "UPDATE usuaris SET activat=true WHERE idUsuari=$idUsuari";
            $statement = $this->conexio->prepare($sql);
            $statement->execute();


        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getUsuariById($idUsuari)
    {
        try {
            $query = "SELECT * FROM usuaris WHERE idUsuari=$idUsuari";
            $statement = $this->conexio->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $user = new Usuari();
            $user->setIdUsuari($result['idUsuari']);
            $user->setCorreu($result['correu']);
            $user->setCognoms($result['cognoms']);
            $user->setNom($result['nom']);
            $user->setContra($result['contra']);
            $user->setAdreça($result['adreca']);
            $user->setRol($result['rol']);
            $user->setDni($result['dni']);
            $user->setToken($result['token']);
            $user->setActivat($result['activat']);




            return $user;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function changePassword($contra1, $idUsuari, $token)
    {
        try {
            $act = true;
            $sql = "UPDATE usuaris SET contra=:contra where idUsuari=:id AND token=:token";
            $statement = $this->conexio->prepare($sql);
            $contra1 = password_hash($contra1, PASSWORD_DEFAULT);
            $statement->bindParam(':contra', $contra1);
            $statement->bindParam(':id', $idUsuari);
            $statement->bindParam(':token', $token);

            $statement->execute();
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function comprovarEmail($mail)
    {
        try {
            $query = "SELECT * FROM usuaris WHERE correu=:mail ";
            $statement = $this->conexio->prepare($query);
            $statement->execute(
                array(
                    ':mail' => $mail
                )
            );
            $result = $statement->fetchAll();

            if (count($result) == 0) {
                return true;
            }
            return false;

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function desActivarUsuariByMail($mail)
    {
        try {
            $act = false;
            $sql = "UPDATE usuaris SET activat=:act where correu=:correu";
            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':act', $act);
            $statement->bindParam(':correu', $mail);
            $statement->execute();
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function canviarMailById($id, $mail)
    {
        try {
            $act = false;
            $sql = "UPDATE usuaris SET correu=:correuNou where idUsuari=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->bindParam(':correuNou', $mail);
            $statement->execute();
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function updateUser($user)
    {
        $nom = $user->getNom();
        $id = $user->getIdUsuari();
        $cognoms = $user->getCognoms();
        $dni = $user->getDni();
        $adreca = $user->getAdreça();
        try {
            $sql = "UPDATE usuaris SET nom=:nom, cognoms=:cognoms, dni=:dni,
                             adreca=:adreca WHERE idUsuari=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $id,
                    ':nom' => $nom,
                    ':cognoms' => $cognoms,
                    ':dni' => $dni,
                    ':adreca' => $adreca
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function goNoAdminById($idUser)
    {
        $idUser = intval($idUser);
        try {
            $sql = "UPDATE usuaris SET rol=2 WHERE idUsuari=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $idUser
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function goAdminById($idUser)
    {
        $idUser = intval($idUser);
        try {
            $sql = "UPDATE usuaris SET rol=1 WHERE idUsuari=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $idUser
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function goVerifiedById($idUser)
    {
        $idUser = intval($idUser);
        try {
            $sql = "UPDATE usuaris SET activat=1 WHERE idUsuari=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $idUser
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function goDeleteUser($idUser)
    {
        $idUser = intval($idUser);
        try {
            $sql = "Delete FROM usuaris WHERE idUsuari=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $idUser
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function crearProducte(Producte $product)
    {

        try {
            $sql = "INSERT INTO productes (nom,descripcio,preu,sexe,categoria, keyImatge, linkImatge, existeix) VALUES(:nom, :descripcio, :preu, :sexe, :categoria, :keyImatge, :linkImatge, true)";
            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':nom', $product->getNom());
            $statement->bindParam(':descripcio', $product->getDescripcio());
            $statement->bindParam(':preu', $product->getPreu());
            $statement->bindParam(':sexe', $product->getSexe());
            $statement->bindParam(':categoria', $product->getCategoria());
            $statement->bindParam(':keyImatge', $product->getKeyImatge());
            $statement->bindParam(':linkImatge', $product->getLinkImatge());
            $statement->execute();

            $sql = "SELECT * FROM productes WHERE existeix=true AND UPPER(nom) like UPPER(:pdfs)";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    "pdfs" => $product->getNom(),
                )
            );
            $result = $statement->fetch();

            foreach ($product->getArrayTalles() as $k => $v) {
                $sql = "INSERT INTO producte_stock (idProducte, quantitat, talla) VALUES(:idProducte, :quantitat, :talla)";
                $statement2 = $this->conexio->prepare($sql);
                $statement2->bindParam(':idProducte', $result['idProducte']);
                $statement2->bindParam(':quantitat', $v);
                $statement2->bindParam(':talla', $k);
                $statement2->execute();
            }

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function getAllProducts()
    {
        try {
            $query = "SELECT * FROM productes WHERE existeix=true";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array());

            $result = $statement->fetchAll();

            $arrayReturn = [];

            for ($i = 0; $i < count($result); $i++) {
                $producte = new Producte();
                $producte->setIdProducte($result[$i]['idProducte']);
                $producte->setNom($result[$i]['nom']);
                $producte->setDescripcio($result[$i]['descripcio']);
                $producte->setCategoria($result[$i]['categoria']);
                $producte->setSexe($result[$i]['sexe']);
                $producte->setPreu($result[$i]['preu']);
                $producte->setKeyImatge($result[$i]['keyImatge']);
                $producte->setLinkImatge($result[$i]['linkImatge']);
                $producte->setExisteix($result[$i]['existeix']);

                $query = "SELECT * FROM producte_stock WHERE idProducte=:id";
                $statement = $this->conexio->prepare($query);
                $statement->execute(array(
                    'id' => $result[$i]['idProducte'],
                ));

                $xd = $statement->fetchAll();

                $arrayTallas = array(
                    "xs" => intval($xd[0]['quantitat']),
                    "s" => intval($xd[1]['quantitat']),
                    "m" => intval($xd[2]['quantitat']),
                    "l" => intval($xd[3]['quantitat']),
                    "xl" => intval($xd[4]['quantitat']),
                    "xxl" => intval($xd[5]['quantitat']),
                    "xxxl" => intval($xd[6]['quantitat'])
                );

                $producte->setArrayTalles($arrayTallas);
                array_push($arrayReturn, $producte);
            }
            return $arrayReturn;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function borrarProducteById($idProd)
    {
        $idProducte = intval($idProd);
        try {
            $sql = "UPDATE productes SET existeix=false WHERE idProducte=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $idProducte
                ));

            $sql = "UPDATE producte_stock SET quantitat=0 WHERE idProducte=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $idProducte
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function contarImatge($keyImatge)
    {
        try {
            $query = "SELECT count(*) FROM productes where keyImatge=:keyImatge ";
            $statement = $this->conexio->prepare($query);

            $statement->execute(
                array(
                    ':keyImatge' => $keyImatge
                )
            );
            $result = $statement->fetch();
            $resultInt = intval($result['count(*)']);

            if ($resultInt > 1) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getProductePerID($idProducteAModificar)
    {
        try {
            $query = "SELECT * FROM productes where idProducte=:id AND existeix=true";
            $statement = $this->conexio->prepare($query);
            $statement->execute(
                array(
                    ':id' => $idProducteAModificar
                )
            );
            $result = $statement->fetch();

            if (isset($result['idProducte'])):

                $producte = new Producte();
                $producte->setIdProducte($result['idProducte']);
                $producte->setNom($result['nom']);
                $producte->setDescripcio($result['descripcio']);
                $producte->setCategoria($result['categoria']);
                $producte->setSexe($result['sexe']);
                $producte->setPreu($result['preu']);
                $producte->setKeyImatge($result['keyImatge']);
                $producte->setLinkImatge($result['linkImatge']);
                $producte->setExisteix($result['existeix']);


                $query = " SELECT ps.* FROM producte_stock ps, productes p where ps.idProducte=:id and p.idProducte=ps.idProducte and p.existeix=true ORDER BY ps.idProducte DESC";
                $statement = $this->conexio->prepare($query);
                $statement->execute(array(
                    'id' => $result['idProducte'],
                ));

                $xd = $statement->fetchAll();


                $arrayTallas = array(
                    "xs" => intval($xd[0]['quantitat']),
                    "s" => intval($xd[1]['quantitat']),
                    "m" => intval($xd[2]['quantitat']),
                    "l" => intval($xd[3]['quantitat']),
                    "xl" => intval($xd[4]['quantitat']),
                    "xxl" => intval($xd[5]['quantitat']),
                    "xxxl" => intval($xd[6]['quantitat'])
                );


                $producte->setArrayTalles($arrayTallas);

                return $producte;

            else:

                $sql = "Delete linia_comanda * FROM linia_comanda, comanda WHERE linia_comanda.idProducte=:id and comanda.idComanda=linia_comanda.idComanda and comanda.acabat=false";
                $statement = $this->conexio->prepare($sql);
                $statement->execute(
                    array(
                        ':id' => $idProducteAModificar,
                    ));

            endif;


//            return null;


        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function modificarProducte(Producte $producte)
    {
        try {
            $sql = "UPDATE productes SET idProducte=:idProducte, nom=:nom, descripcio=:descripcio, categoria=:categoria,
                             preu=:preu, sexe=:sexe, linkImatge=:linkImatge, keyImatge=:keyImatge WHERE idProducte=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':idProducte' => $producte->getIdProducte(),
                    ':nom' => $producte->getNom(),
                    ':descripcio' => $producte->getDescripcio(),
                    ':categoria' => $producte->getCategoria(),
                    ':preu' => $producte->getPreu(),
                    ':sexe' => $producte->getSexe(),
                    ':linkImatge' => $producte->getLinkImatge(),
                    ':keyImatge' => $producte->getKeyImatge(),
                    ':id' => $producte->getIdProducte()
                ));

            foreach ($producte->getArrayTalles() as $k => $v) {
                $sql = "UPDATE producte_stock SET quantitat=:quantitat WHERE talla=:talla AND idProducte=:id";
                $statement2 = $this->conexio->prepare($sql);
                $statement2->bindParam(':talla', $k);
                $statement2->bindParam(':id', $producte->getIdProducte());
                $statement2->bindParam(':quantitat', $v);

                $statement2->execute();
            }


        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function getProductesShop($radio1, $radio2, $radio3, $ordenar, $sexe)
    {
        try {
            $query = "SELECT * FROM producte_stock, productes WHERE productes.idProducte=producte_stock.idProducte AND quantitat > 0 AND existeix=true ";
            if ($radio1 != 'all') {
                $query = $query . " and categoria='$radio1' ";
            }
            if ($radio2 != 'all') {
                $query = $query . " and talla like '$radio2' ";
            }
            if ($radio3 != 'any') {
                if ($radio3 == '<1') {
                    $query = $query . " and preu $radio3";
                } elseif ($radio3 == "between 1 and 10") {
                    $query = $query . " and preu $radio3";
                } elseif ($radio3 == "between 10 and 50") {
                    $query = $query . " and preu $radio3";
                } elseif ($radio3 == "between 50 and 100") {
                    $query = $query . " and preu $radio3";
                } else {
                    $query = $query . " and preu $radio3";
                }
            }
            $query = $query . " AND (sexe like '$sexe' OR sexe like 'unisex') ";
            $query = $query . " group by productes.idProducte ";
            $query = $query . " ORDER BY preu $ordenar ";

            $statement = $this->conexio->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();


            $arrayReturn = [];

            for ($i = 0; $i < count($result); $i++) {
                $producte = new Producte();
                $producte->setIdProducte($result[$i]['idProducte']);
                $producte->setNom($result[$i]['nom']);
                $producte->setDescripcio($result[$i]['descripcio']);
                $producte->setCategoria($result[$i]['categoria']);
                $producte->setSexe($result[$i]['sexe']);
                $producte->setPreu($result[$i]['preu']);
                $producte->setKeyImatge($result[$i]['keyImatge']);
                $producte->setLinkImatge($result[$i]['linkImatge']);
                $producte->setExisteix($result[$i]['existeix']);

                array_push($arrayReturn, $producte);
            }
            return $arrayReturn;

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function comprovarNomProducte($text)
    {
        try {
            $query = "SELECT count(*) FROM productes WHERE existeix=true AND UPPER(nom) like UPPER('$text')";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array());

            $result = $statement->fetch();
            $resultInt = intval($result['count(*)']);

            if ($resultInt > 0) {
                return true;
            }

            return false;

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function comprobarQuanitatDelProducte($talla, int $idProducte, int $quantitat)
    {
        try {
            $query = "SELECT quantitat FROM producte_stock WHERE idProducte=:idProducte AND talla=:talla";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idProducte' => $idProducte,
                'talla' => $talla,
            ));
            $result = $statement->fetch();

            if (intval($quantitat) <= intval($result['quantitat'])) {
                return true;
            }
            array_push($_SESSION['arrayErrorsAfegirCarrito'], "There is no stock left there's only (" . intval($result['quantitat']) . ") left");
            return false;
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function comprobarComandaComançada($id)
    {
        try {
            $query = "SELECT * FROM comanda WHERE idUsuari=:idUsuari AND acabat=:boolean";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idUsuari' => $id,
                'boolean' => false,
            ));
            $result = $statement->fetchAll();

            if (count($result) > 0) {
                return true;
            }

            return false;

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function comprobarProducteITallaEnLaComandaNoAcabada($talla, int $idProducte, int $id)
    {
        try {
            $query = "SELECT idComanda FROM comanda WHERE idUsuari=:idUsuari AND acabat=:boolean";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idUsuari' => $id,
                'boolean' => false,
            ));
            $result = $statement->fetch();

            $idComanda = $result['idComanda'];

            $query = "SELECT * FROM linia_comanda WHERE idComanda=:idComanda AND talla=:talla AND idProducte=:idProducte";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idComanda' => $idComanda,
                'talla' => $talla,
                'idProducte' => $idProducte,
            ));
            $result = $statement->fetchAll();

            if (count($result) > 0) {
                return true;
            }

            return false;

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }


    }

    public function comprobarSumantQuantitats($talla, int $idProducte, $id, int $quantitat)
    {
        try {
            $query = "SELECT * FROM comanda WHERE idUsuari=:idUsuari AND acabat=false";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idUsuari' => $id,
            ));
            $result = $statement->fetch();

            $idComanda = intval($result['idComanda']);


            $query = "SELECT quantitat FROM linia_comanda WHERE idComanda=:idComanda AND talla=:talla AND idProducte=:idProducte";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idComanda' => $idComanda,
                'talla' => $talla,
                'idProducte' => $idProducte,
            ));
            $result = $statement->fetch();

            $sumaQuantitat = intval($result['quantitat']) + intval($quantitat);

            $query = "SELECT * FROM producte_stock WHERE idProducte=:idProducte AND talla=:talla";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idProducte' => $idProducte,
                'talla' => $talla,
            ));
            $result = $statement->fetchAll();



            if ($sumaQuantitat <= intval($result[0]['quantitat'])) {
                return true;
            }

            array_push($_SESSION['arrayErrorsAfegirCarrito'], "Error while adding this product to your cart, seem you already have this same product with the same size in your cart and by adding this amount, you exceed the stock of the product. <b>" . "You alredy have (" . $result[0]['quantitat'] . ") in your cart. ");

            return false;

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function actualitzarLiniaComanda($talla, int $idProducte, $id, int $quantitat)
    {

        try {
            $query = "SELECT * FROM comanda WHERE idUsuari=:idUsuari AND acabat=:boolean";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idUsuari' => $id,
                'boolean' => false,
            ));
            $result = $statement->fetch();

            $idComanda = $result['idComanda'];


            $query = "SELECT * FROM linia_comanda WHERE idComanda=:idComanda AND talla=:talla AND idProducte=:idProducte";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idComanda' => $idComanda,
                'talla' => $talla,
                'idProducte' => $idProducte,
            ));
            $result = $statement->fetch();


            $sumaQuantitat = intval($result['quantitat']) + intval($quantitat);

            $query = "SELECT * FROM producte_stock WHERE idProducte=:idProducte AND talla=:talla";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idProducte' => $idProducte,
                'talla' => $talla,
            ));
            $result = $statement->fetchAll();


            if ($sumaQuantitat <= intval($result[0]['quantitat'])) {


                $query = "SELECT * FROM productes WHERE idProducte=:id";
                $statement = $this->conexio->prepare($query);
                $statement->execute(array(
                    'id' => $idProducte,
                ));
                $result2 = $statement->fetchAll();

                $preuTotal = $sumaQuantitat * floatval($result2[0]['preu']);


                $sql = "UPDATE linia_comanda SET quantitat=:quantitat, preuTotal=:pt where idProducte=:idProducte AND talla=:talla";
                $statement = $this->conexio->prepare($sql);
                $statement->execute(array(
                    'idProducte' => $idProducte,
                    'talla' => $talla,
                    'quantitat' => $sumaQuantitat,
                    'pt' => $preuTotal,
                ));
                $statement->execute();
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function afegirNovaLiniaEnLaComanda(LiniaComanda $liniaComanda, $usuariLogged)
    {

        try {
            $query = "SELECT idComanda FROM comanda WHERE idUsuari=:idUsuari AND acabat=:boolean";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idUsuari' => $usuariLogged->getIdUsuari(),
                'boolean' => false,
            ));

            $result = $statement->fetch();
            $idComanda = $result['idComanda'];
            $liniaComanda->setIdComanda($idComanda);


            $sql = "INSERT INTO linia_comanda (idProducte,quantitat,preuTotal,talla,idComanda) VALUES(:idProducte, :quantitat, :preuTotal, :talla, :idComanda)";

            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':idProducte', $liniaComanda->getIdProducte());
            $statement->bindParam(':quantitat', $liniaComanda->getQuantitat());
            $statement->bindParam(':preuTotal', $liniaComanda->getPreuTotal());
            $statement->bindParam(':talla', $liniaComanda->getTalla());
            $statement->bindParam(':idComanda', $liniaComanda->getIdComanda());
            $statement->execute();

        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }


    }

    public function afegirNovaLiniaEnUnaComandaNova(LiniaComanda $liniaComanda, $usuariLogged, Comanda $comanda)
    {

        try {

            $sql = "INSERT INTO comanda (idUsuari,acabat,preuTotal,comandaIva, dataCompra) VALUES(:idUsuari, false, :preuTotal, 0, null)";
            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':idUsuari', $usuariLogged->getIdUsuari());
            $statement->bindParam(':preuTotal', $liniaComanda->getPreuTotal());
            $statement->execute();

            $liniaComanda->setIdComanda($this->conexio->lastInsertId());

            $sql = "INSERT INTO linia_comanda (idProducte,quantitat,preuTotal,talla,idComanda) VALUES(:idProducte, :quantitat, :preuTotal, :talla, :idComanda)";

            $statement = $this->conexio->prepare($sql);
            $statement->bindParam(':idProducte', $liniaComanda->getIdProducte());
            $statement->bindParam(':quantitat', $liniaComanda->getQuantitat());
            $statement->bindParam(':preuTotal', $liniaComanda->getPreuTotal());
            $statement->bindParam(':talla', $liniaComanda->getTalla());
            $statement->bindParam(':idComanda', $liniaComanda->getIdComanda());
            $statement->execute();


        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getLiniasComandaPerIdUsuari($user)
    {

        $query = "SELECT * FROM comanda WHERE idUsuari=:idUsuari AND acabat=false";
        $statement = $this->conexio->prepare($query);
        $statement->execute(array(
            'idUsuari' => intval($user->getIdUsuari()),
        ));
        $result = $statement->fetchAll();


        $arrayReturn = [];
        if (count($result) > 0) {

            $comanda = $result[0]['idComanda'];

            $query = "SELECT * FROM linia_comanda WHERE idComanda=:idComanda";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idComanda' => $comanda,
            ));

            $result = $statement->fetchAll();


            foreach ($result as $r) {

                $liniaComanda = new LiniaComanda();
                $liniaComanda->setIdComanda($r['idComanda']);
                $liniaComanda->setPreuTotal($r['preuTotal']);
                $liniaComanda->setTalla($r['talla']);
                $liniaComanda->setQuantitat($r['quantitat']);
                $liniaComanda->setIdLiniaComanda($r['idLiniaComanda']);
                $liniaComanda->setIdProducte($r['idProducte']);

                array_push($arrayReturn, $liniaComanda);
            }
        }
        return $arrayReturn;
    }

    public function borrarLiniaComandaPerID(int $id)
    {
        $id2 = intval($id);
        try {

            $sql = "Delete FROM linia_comanda WHERE idLiniaComanda=:id";
            $statement = $this->conexio->prepare($sql);
            $statement->execute(
                array(
                    ':id' => $id2,
                ));
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }

    }

    public function ferLaCompra(int $idUser, int $idComanda)
    {
        try {

            $query = "SELECT * FROM linia_comanda WHERE idComanda=:idComanda";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idComanda' => $idComanda,
            ));

            $result = $statement->fetchAll();


            $arr = [];

            $arrayP = $result;



            foreach ($arrayP as $r) {

                $quant = intval($r['quantitat']);
                $idProd = intval($r['idProducte']);
                $xd = $r['talla'];

                $sql = " SELECT * FROM producte_stock, productes WHERE existeix=true AND quantitat < :qt AND producte_stock.idProducte=:id AND talla=:t";
                $statement = $this->conexio->prepare($sql);
                $statement->execute(array(
                    ':qt' => $quant,
                    ':id' => $idProd,
                    ':t' => $xd
                ));

                $result = $statement->fetch();

                if (isset($result['idProducte'])) {
                    array_push($arr, $this->getProductePerID(intval($idProd)));
                }
            }


            if (count($arr) > 0) {
                $_SESSION['errorAlComprar'] = $arr;
                return null;

            } else {
                $_SESSION['compraFeta'] = "tezt";


                $sql = "SELECT round(abs (SUM(preuTotal)),2) from linia_comanda where idComanda=$idComanda";
                $statement = $this->conexio->prepare($sql);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_NUM);
                $suma = floatval($result[0]);
                $iva = round($suma * 0.21, 2);


                date_default_timezone_set('Europe/Madrid');
                $date = date('Y-m-d H:i:s');

                $sql = "UPDATE comanda SET acabat=true, preuTotal=$suma, comandaIva=$iva, dataCompra='$date'  WHERE idUsuari=:idU AND idComanda=:idC";
                $statement = $this->conexio->prepare($sql);
                $statement->bindParam(':idU', $idUser);
                $statement->bindParam(':idC', $idComanda);
                $statement->execute();

                foreach ($arrayP as $r) {
                    $quant = intval($r['quantitat']);
                    $idProd = intval($r['idProducte']);
                    $sql = "UPDATE producte_stock SET quantitat= (quantitat - :qt) WHERE idProducte=:idP AND talla=:t";
                    $statement = $this->conexio->prepare($sql);
                    $statement->bindParam(':qt', $quant);
                    $statement->bindParam(':idP', $idProd);
                    $statement->bindParam(':t', $r['talla']);
                    $statement->execute();
                }
            }
        } catch (PDOException $ex) {
            echo "Error: " . $ex;
        }
    }

    public function getAllFacturas($idUsuari)
    {
        $sql = "SELECT * FROM comanda WHERE idUsuari=$idUsuari AND acabat=true";
        $statement = $this->conexio->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $arrayReturn = [];
        if (count($result) > 0) {

            foreach ($result as $r) {
                $comada = new Comanda();
                $comada->setPreuTotal($r['preuTotal']);
                $comada->setComandaIva($r['comandaIva']);
                $comada->setIdComanda($r['idComanda']);
                $comada->setIdUsuari($r['idUsuari']);
                $comada->setAcabat($r['acabat']);
                $comada->setData($r['dataCompra']);
                array_push($arrayReturn, $comada);
            }
        }


        return $arrayReturn;


    }

    public function getLiniasComandaPerIdUsuariAndIdComandaPerElPDF($getIdUsuari, $idComanda)
    {
        $query = "SELECT * FROM comanda WHERE idUsuari=$getIdUsuari AND acabat=true AND idComanda=$idComanda";
        $statement = $this->conexio->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $arrayReturn = [];
        if (count($result) > 0) {

            $comanda = $result[0]['idComanda'];

            $query = "SELECT * FROM linia_comanda WHERE idComanda=:idComanda";
            $statement = $this->conexio->prepare($query);
            $statement->execute(array(
                'idComanda' => $comanda,
            ));

            $result = $statement->fetchAll();


            foreach ($result as $r) {

                $liniaComanda = new LiniaComanda();
                $liniaComanda->setIdComanda($r['idComanda']);
                $liniaComanda->setPreuTotal($r['preuTotal']);
                $liniaComanda->setTalla($r['talla']);
                $liniaComanda->setQuantitat($r['quantitat']);
                $liniaComanda->setIdLiniaComanda($r['idLiniaComanda']);
                $liniaComanda->setIdProducte($r['idProducte']);

                array_push($arrayReturn, $liniaComanda);
            }
        }

        return $arrayReturn;

    }

    public function getProducteNomPreu($getIdProducte)
    {
        $query = "SELECT * FROM productes WHERE idProducte=$getIdProducte";
        $statement = $this->conexio->prepare($query);
        $statement->execute();
        $result = $statement->fetch();

        $arrayReturn = array(
            'nom' => $result['nom'],
            'preu' => $result['preu']
        );

        return $arrayReturn;
    }

    public function getComandaIvaAndTotal($getIdComanda)
    {

        $query = "SELECT * FROM comanda WHERE idComanda=$getIdComanda";
        $statement = $this->conexio->prepare($query);
        $statement->execute();
        $result = $statement->fetch();

        $arrayReturn = array(
            'iva' => $result['comandaIva'],
            'preuTotal' => $result['preuTotal']
        );


        return $arrayReturn;
    }

    public function getHoraCompraByID($idComanda)
    {
        $query = "SELECT * FROM comanda WHERE idComanda=$idComanda";
        $statement = $this->conexio->prepare($query);
        $statement->execute();
        $result = $statement->fetch();


        return $result['dataCompra'];


    }

    public function changeAddress($getIdUsuari, $address)
    {

        $sql = "UPDATE usuaris SET adreca='$address' WHERE idUsuari=$getIdUsuari";
        $statement = $this->conexio->prepare($sql);
        $statement->execute();
    }


}

?>