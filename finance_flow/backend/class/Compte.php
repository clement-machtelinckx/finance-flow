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



    public function showBDD($id_user){
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

        if(isset($id_user)){
            
        
        $sql ="SELECT * FROM compte WHERE id_user = $id_user";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $compte = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($compte);
        }

    }

    public function operationBDD($id_compte, $montant, $operator) {
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "financeflow";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erreur de connexion : " . $e->getMessage()]);
            return;
        }
        $compte = new Compte();
        try {
            if (isset($id_compte) && isset($montant) && isset($operator)) {
                $sql = "";
                if ($operator == "addition") {
                    $sql = "UPDATE compte SET solde = solde + :montant WHERE id = :id_compte";

                } elseif ($operator == "soustraction") {
                    $sql = "UPDATE compte SET solde = solde - :montant WHERE id = :id_compte";

                }
    
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':montant', $montant, PDO::PARAM_INT);
                $stmt->bindParam(':id_compte', $id_compte, PDO::PARAM_INT);
                $stmt->execute();
                $compte->entreTransaction($id_compte, $montant, $operator);



                // echo json_encode(["result" => "success", "message" => "Données mises à jour avec succès."]);
            }
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erreur d'exécution de la requête : " . $e->getMessage()]);
        }
    }

    public function entreTransaction($id_compte, $montant, $operator) {
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "financeflow";
    
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Erreur de connexion : " . $e->getMessage()]);
            return;
        }
    
        try {
            $conn->beginTransaction();
    
            // Requête SELECT pour obtenir le solde actuel du compte
            $sqlSelectSolde = "SELECT solde FROM compte WHERE id = :id_compte";
            $stmtSelectSolde = $conn->prepare($sqlSelectSolde);
            $stmtSelectSolde->bindParam(':id_compte', $id_compte, PDO::PARAM_INT);
            $stmtSelectSolde->execute();
            $soldeActuel = $stmtSelectSolde->fetchColumn();
    
            // Votre code d'INSERT
            $id_cate = 1;
            $sqlInsert = "INSERT INTO transaction (id_compte, montant, solde_time, calculator, date, id_cate) VALUES (:id_compte, :montant, :solde_time, :calculator, NOW(), :id_cate)";
            $stmtInsert = $conn->prepare($sqlInsert);
            $stmtInsert->bindParam(':id_compte', $id_compte, PDO::PARAM_INT);
            $stmtInsert->bindParam(':montant', $montant, PDO::PARAM_INT);
            $stmtInsert->bindParam(':solde_time', $soldeActuel, PDO::PARAM_STR);
            $stmtInsert->bindParam(':calculator', $operator, PDO::PARAM_STR);
            $stmtInsert->bindParam(':id_cate', $id_cate, PDO::PARAM_INT);

            $stmtInsert->execute();
    
            $conn->commit();
    
            echo json_encode(["result" => "success", "message" => "Transaction insérée avec succès.", "solde_compte" => $soldeActuel]);
        } catch (PDOException $e) {
            $conn->rollBack();
            echo json_encode(["error" => "Erreur d'exécution de la requête : " . $e->getMessage()]);
        }
    }
    
    
    public function showTransaction($id_compte){
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

        if(isset($id_compte)){
            
        
        $sql ="SELECT * FROM transaction WHERE id_compte = $id_compte";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $transaction = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($transaction);
        }

    }

    public function deleteCompte($id_compte){
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

        if(isset($id_compte)){

            $sql = "DELETE FROM compte WHERE id = :id_compte";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_compte', $id_compte, PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(["result" => "success", "message" => "Données supprimées avec succès."]);

        }

    }


}
?>
