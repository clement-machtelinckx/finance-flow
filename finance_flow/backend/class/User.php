<?php


class User {
    private $id;
    private $nom;
    
    private $email;


    
    public function __construct(
        int $id = null,
        string $nom = "",
        string $email = "",

    )
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;

    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function inscripUser($nom, $email, $password){

        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "financeflow";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }


        if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirme_password"])){
            $nom = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hash_password = sha1($password);
            $confirme_password = $_POST["confirme_password"];
            
            if ($_POST["password"] === $_POST["confirme_password"]){
                
                $sql = "INSERT INTO users (name, prenom, email, password)
                VALUES (:name, :prenom, :email, :password)";
                
                try {
                    $sth = $conn->prepare($sql);
                    $sth->bindParam(':name', $nom, PDO::PARAM_STR);
                    $sth->bindParam(':email', $email, PDO::PARAM_STR);
                    $sth->bindParam(':password', $hash_password, PDO::PARAM_STR);
                
                    $sth->execute();
                    echo "Données insérées avec succès.";
                } catch(PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }

    }

    public function connecUser($email, $password){

        
        $servername = "localhost";
        $username = "root";
        $password = "Clement2203$";
        $dbname = "financeflow";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion réussie<br>";
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        if (isset($_POST["email"]) && $_POST["password"]){
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hash_password = sha1($password);

            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ($hash_password === $user["password"]){
                    $_SESSION["name"] = $user["name"];
                    $_SESSION['username'] = $user['email'];
                    $_SESSION["id"] = $user["id"];
                    //header("location: profil.php");
                    echo "connected";
                    var_dump($_SESSION);
                }
                else{
                    echo "incorect password";
                }
            }
            else{
                echo "User not found";
            }
        }
    }
}