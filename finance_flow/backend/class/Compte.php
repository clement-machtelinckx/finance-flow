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

    public function createCompte($data) {
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "financeflow";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erreur de connexion : " . $e->getMessage()]);
            return; // Ajoutez un return pour sortir de la fonction si la connexion échoue
        }
    
        if (isset($data["compte_name"]) && isset($data["solde"]) && isset($data["id"])) {
            $id_user = $data["id"];
            $compte_name = $data["compte_name"];
            $solde = $data["solde"];
            $description = "";
    
            $sql = "INSERT INTO compte (id_user, compte_name,  creation_date, description, solde) VALUES (:id_user, :compte_name, NOW(), :description, :solde)";
    
            try {
                $sth = $conn->prepare($sql);
                $sth->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $sth->bindParam(':compte_name', $compte_name, PDO::PARAM_STR);
            
                $sth->bindParam(':description', $description, PDO::PARAM_STR);
                $sth->bindParam(':solde', $solde, PDO::PARAM_INT);
    
                $sth->execute();
                echo json_encode(["result" => "success", "message" => "Données insérées avec succès."]);
            } catch (PDOException $e) {
                echo json_encode(["error" => "Erreur : " . $e->getMessage()]);
            }
        } else {
            echo json_encode(["error" => "Les données ne sont pas complètes"]);
        }
    }
}
?>
