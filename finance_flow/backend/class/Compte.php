<?php   

class Compte {

    private $id;
    private $id_user;
    private $compte_name;

    private $creation_date;
    private $description;
    private $solde;

    public function __construct( 
        int $id = null, 
        int $id_user = null, 
        string $compte_name = "", 
        string $creation_date = null,
        string $description = "", 
        int $solde = null, 
        
    ) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->compte_name = $compte_name;
        $this->creation_date = $creation_date;
        $this->description = $description;
        $this->solde = $solde;
    } 

    public function getId(): int {
        return $this->id;
    }
    public function setId(int $id): Compte {
        $this->id = $id;
        return $this;
    }
    public function getId_user(): int {
        return $this->id_user;
    }
    public function setId_user(int $id_user): Compte {
        $this->id_user = $id_user;
        return $this;
    }
    public function getCompteName(): string {
        return $this->compte_name;
    }
    public function setCompteName(string $compte_name): Compte {
        $this->compte_name = $compte_name;
        return $this;
    }
    public function getCreationDate(): string {
        return $this->creation_date;
    }
    public function setCreationDate(string $creation_date): Compte {
        $this->creation_date = $creation_date;
        return $this;
    }
    public function getDescription(): string {
        return $this->description;
    }
    public function setDescription(string $description): Compte {
        $this->description = $description;
        return $this;
    }
    public function getSolde(): int {
        return $this->solde;
    }
    public function setSolde(int $solde): Compte {
        $this->solde = $solde;
        return $this;
    }


}

?>