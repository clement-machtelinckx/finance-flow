<?php


class User {
    private $id;
    private $name;
    private $email;


    
    public function __construct(
        int $id = null,
        string $name = "",
        string $email = "",

    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;

    }
    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }


        public function inscripUser($data) {
            $servername = "localhost";
            $username = "root";
            $password = "Clement2203$";
            $dbname = "financeflow";
    
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
    
            if (isset($data["name"]) && isset($data["email"]) && isset($data["password"])) {
                $name = $data["name"];
                $email = $data["email"];
                $password = $data["password"];
                $hash_password = sha1($password);
    
                if ($data["password"]) {
                    $sql = "INSERT INTO users (name, email, password)
                            VALUES (:name, :email, :password)";
    
                    try {
                        $sth = $conn->prepare($sql);
                        $sth->bindParam(':name', $name, PDO::PARAM_STR);
                        $sth->bindParam(':email', $email, PDO::PARAM_STR);
                        $sth->bindParam(':password', $hash_password, PDO::PARAM_STR);
    
                        $sth->execute();
    
                        echo "Inscription réussie!";
                    } catch(PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                }
            }
        }
    
    

        public function connecUser($data){
            $servername = "localhost";
            $username = "root";
            $password = "Clement2203$";
            $dbname = "financeflow";
        
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            } catch(PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
        
            if (isset($data["email"]) && isset($data["password"])) {
                $email = $data["email"];
                $password = $data["password"];
                $hash_password = sha1($password);
        
                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($user) {
                    if ($hash_password === $user["password"]) {
                        session_start();
                        $_SESSION["name"] = $user["name"];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION["id"] = $user["id"];
                        echo json_encode(["message" => "connected"]);

                    } else {
                        echo json_encode(["error" => "incorrect password"]);
                    }
                } else {
                    echo json_encode(["error" => "User not found"]);
                }
            }
        }
        

    public function getUserInfos($email){

            $servername = "localhost";
            $username = "root";
            $password = "Clement2203$";
            $dbname = "financeflow";

            
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }

        
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user){
            $this->name = $user["name"];
            $this->email = $user["email"];

            return $user;

        }
    }


    public function getConnectedUser() {
        // Vérifiez si l'utilisateur est connecté dans la session
        if (isset($_SESSION["name"], $_SESSION["email"], $_SESSION["id"])) {
            return [
                'name' => $_SESSION["name"],
                'email' => $_SESSION["email"],
                'id' => $_SESSION["id"],
            ];
        } else {
            return null;
        }
    }
    
    
}