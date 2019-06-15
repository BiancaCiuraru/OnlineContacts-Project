<?php 
class Session{
    public function __construct()
    {
        $this->db= new Database();
    }
    public function genToken($id){
        if(!isset($_SESSION['user_token'])){
            $_SESSION['user_token']=md5(uniqid());
            $this->insertToken($id);
        }else{
            $statement = $this->db->prepare("SELECT * FROM tokens WHERE id_user=? AND token_value=?");
            $statement->bindParam(1, $id,PDO::PARAM_INT);
            $statement->bindParam(2, $_SESSION['user_token'],PDO::PARAM_STR);
            $statement->execute();
            if ($statement->rowCount()<1)
                {
                    $_SESSION['user_token']=md5(uniqid());
                    $this->insertToken($id);
                }   
        }
    }
    
    public function insertToken($id_user){
            $statement = $this->db->prepare("INSERT into tokens(token_value, id_user) VALUES (?,?);");
            $statement->bindParam(1, $_SESSION['user_token'], PDO::PARAM_STR);
            $statement->bindParam(2, $id_user, PDO::PARAM_INT);
            $statement->execute();
        }
    
    public function checkToken(){
            $statement = $this->db->prepare("SELECT * FROM tokens WHERE token_value=?");
            $statement->bindParam('s',$_SESSION['user_token']);
            $statement->execute();
            if ($statement->rowCount()<1)
            {
                header('location: register');
            }
    }
    
    public function checkLogedIn(){
        $statement = $this->db->prepare("SELECT * from tokens where token_value=?");
        $statement->bindParam(1, $_SESSION['user_token'], PDO::PARAM_STR);
        $statement->execute();
        if ($statement->rowCount() >= 1)
        {
            $_SESSION['loggedIn']=true;
            header('location: index');
        }
        else $_SESSION['loggedIn']=false;
    }
    
    
    public function distroySession(){
        $statement = $this->db->prepare("DELETE from tokens where token_value=?");
        $statement->bindParam(1, $_SESSION['user_token'], PDO::PARAM_STR);
        $statement->execute();
        session_unset();
        // session_destroy();
        // header('Location: register');
       
    }
}
?>
