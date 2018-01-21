<?php

class User{
    
    protected $user_id;
    protected $username;
    protected $email;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $phone;
    protected $university;
    protected $degree;
    protected $gender;
    protected $DOB;
    protected $photo;
    protected $hobbies;
    protected $about;
    protected $dateOfCreation;
    protected $lastLogin;
    protected $active;
    protected $hash;

    
    
    public function getUser_id(){
        return $this->user_id; 
    }
    public function getUsername(){
        return $this->username;
    }
    public function getEmail(){
        return $this->email;
    }
    protected function getPassword(){
        return $this->password;
    }
    public function getFirstname(){
        return $this->firstname;
    }
    public function getLastname(){
        return $this->lastname;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getUniversity(){
        return $this->university;
    }
    public function getActive(){
        return $this->active;
    }
    public function setUsername($username){
        $this->$username =$username;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setFirstname($firstname){
        $this->firstname = $firstname;
    }
    public function setLastname($lastname){
        $this->lastname = $lastname;
    }
    public function setPhone($phone){
        $this->phone = $phone;
    }
    public function setUniversity($university){
        $this->university = $university;
    }
    
    public function getGender(){
        return $this->gender;
    }

    public function getDegree(){
        return $this->degree;
    }

    public function setdegree($degree){
        $this->degree = $degree;
    }

    public function setGender($gender){
        $this->gender = $gender;
    }

    public function getDOB(){
        return $this->DOB;
    }

    public function setDOB($DOB){
        $this->DOB = $DOB;
    }

    public function getHobbies(){
        return $this->hobbies;
    }

    public function setHobbies($hobbies){
        $this->hobbies = $hobbies;
    }

    public function getDateOfCreation(){
        return $this->dateOfCreation;
    }

    public function setDateOfCreation($dateOfCreation){
        $this->dateOfCreation = $dateOfCreation;
    }

    public function getLastLogin(){
        return $this->lastLogin;
    }

    public function setlastLogin($lastLogin){
        $this->lastLogin = $lastLogin;
    }

    public function getPhoto(){
        return $this->photo;
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }

    public function getAbout(){
        return $this->about;
    }

    public function setAbout($about){
        $this->about = $about;
    }

    public function gethash(){
        return $this->hash;
    }


    //gets user info from the database
    public function getUserInfoFromDatabase($user_id){
        global $database;
        
        $sql = "SELECT * from users WHERE user_id = '$user_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            $this->getMessage("getUserInfo function worked fine");

            $fetchedUserAssoc = $resultSet->fetch_assoc();

            $this->user_id = $fetchedUserAssoc['user_id'];
            $this->username = $fetchedUserAssoc['username'];
            $this->email = $fetchedUserAssoc['email'];
            $this->firstname = $fetchedUserAssoc['firstname'];
            $this->lastname = $fetchedUserAssoc['lastname'];
            $this->phone = $fetchedUserAssoc['phone'];
            $this->university = $fetchedUserAssoc['university'];
            $this->degree = $fetchedUserAssoc['degree'];
            $this->gender = $fetchedUserAssoc['gender'];
            $this->DOB = $fetchedUserAssoc['DOB'];
            $this->photo = $fetchedUserAssoc['photo'];
            $this->about = $fetchedUserAssoc['about_user'];
            $this->hobbies = $fetchedUserAssoc['hobbies'];
            $this->dateOfCreation = $fetchedUserAssoc['dateOfCreation'];
            $this->lastLogin = $fetchedUserAssoc['last_login'];
            $this->active = $fetchedUserAssoc['active'];
            $this->hash = $fetchedUserAssoc['hash'];


        }else{
            $this->getMessage("getUserInfo didnt work");
        }  
        
    }
    
    public function updateUserInfo($sent_user_id)
     {
        global $database;

        $sql = "SELECT * from users WHERE user_id = '$sent_user_id' LIMIT 1";
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);

        if($result){
                
            

            
            $final = strtotime($this->DOB);
            $updated_DOB = date('Y-m-d', $final);

            $sql1 = "UPDATE users SET university ='$this->university', phone = '$this->phone', hobbies = '$this->hobbies', degree = '$this->degree', DOB = '$updated_DOB', about_user = '$this->about' WHERE user_id = '$sent_user_id' ";
            $resultSet1 = $database->query($sql1);

            if($database->affectedRows($resultSet1)){

                $this->getMessage("updateUserInfo function worked fine");
                return 1;
            }else{

                $this->getMessage("updateUserInfo function didt work!");
                return 0;
            }

        }else{
            $this->getMessage("getUserInfo didnt work");
            return 0;
        }

    }




    protected function getMessage($msg){
        echo "
            <script>
                alert('$msg');
            </script>
        ";
    }


    public function setActive($send_email){
        global $database;

        

        $sql= "SELECT * FROM users WHERE email  = '$send_email' LIMIT 1";
        
        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);
        if ($result) {
            $fetchedUserAssoc = $resultSet->fetch_assoc();
            $stored_username = $fetchedUserAssoc['username'];

            if($fetchedUserAssoc['active'] == 0){

                $sql = "UPDATE users SET active = '1' WHERE username = '$stored_username'";
                $resultSet = $database->query($sql);

                if ($database->affectedRows($resultSet)) {
                    $this->getMessage(" verify worked");

                    return 1;

                }else{
                    $this->getMessage("verify didnt work");

                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }

    public function chechIfUserIsExistForRegister($username, $email){
        global $database;

        $sql= "SELECT * FROM users WHERE username = '$username' OR email  = '$email' LIMIT 1";
        
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);
        if ($result) {
            return $result;
        }else{
            return 0;
        }

    }

    public function checkIfUserIsExistByID($sent_user_id){
        global $database;

        $sql= "SELECT * FROM users WHERE user_id = '$sent_user_id' LIMIT 1";

        $resultSet = $database->query($sql);

        $result = $database->numRows($resultSet);
        if ($result) {
            return true;
        }else{
            return false;
        }

    }

    public function checkIfUserIsExistForForgotPassword($sent_email){
        global $database;

        $sql= "SELECT * FROM users WHERE email  = '$sent_email' LIMIT 1";
        
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);
        if ($result) {

            $fetchedUserAssoc = $resultSet->fetch_assoc();
            $stored_user_id = $fetchedUserAssoc['user_id'];

            $this->getUserInfoFromDatabase($stored_user_id);
            return $result;
        }else{
            return 0;
        }

    }

    public function verifyUserActivation($send_email, $hash){
        global $database;
        
        $sql= "SELECT * FROM users WHERE email = '$send_email' ";
        
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);
        if ($result) {
            
            $fetchedUserAssoc = $resultSet->fetch_assoc();
            $stored_hash = $fetchedUserAssoc['hash'];

            if(!strcmp($hash,$stored_hash) ){

                $this->getMessage("the two hashs are equal");

                if($this->setActive($send_email)){

                    $this->getMessage("Your account has been activated!");
                    return 1;
                
                }else{

                    $this->getMessage("Your account has not activated!");
                    return 0;
                }
            }else{
                return 0;
            }
            
        }else{
            return 0;
        }

    }

    public function checkIfUserIsExistForResetPassword($sent_email, $sent_hash){
        global $database;
        
        $sql= "SELECT * FROM users WHERE email = '$sent_email' AND hash = '$sent_hash' ";
        
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);
        if ($result) {
            
            return 1;
            
        }else{
            return 0;
        }

    }

    public function resetPassword($sent_email, $sent_hash, $sent_password){
        global $database;

        $sql= "SELECT * FROM users WHERE email = '$sent_email' AND hash = '$sent_hash' ";
        
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);
        if ($result) {
            
            $fetchedUserAssoc = $resultSet->fetch_assoc();
            $stored_username = $fetchedUserAssoc['username'];

            $sql = "UPDATE users SET password ='$sent_password' WHERE username = '$stored_username' ";
            $resultSet = $database->query($sql);
        
            if ($database->affectedRows()) {
                $this->getMessage("insert worked");

                return 1;
            }else{
                $this->getMessage("insert didnt work");

                return 0;
            }
            
        }else{
            return 0;
        }
    }

    public function checkIfUserIsExistForLogin($usernameOrEmail, $enteredPassword){
        global $database;

        $sql= "SELECT * FROM users WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail'";
        
        $resultSet = $database->query($sql);
        
        $result = $database->numRows($resultSet);
        if ($result) {
            $this->getMessage("user is exist");
            $fetchedUserAssoc = $resultSet->fetch_assoc();
            
        
            if ( password_verify($enteredPassword, $fetchedUserAssoc['password']) ) {
                $this->getMessage("user password is correct");

                $this->getUserInfoFromDatabase($fetchedUserAssoc['user_id']);
                
                return 1;
            }else {
                $this->getMessage("user password is not correct");
                return 0;
            }
        }else{
            $this->getMessage("user is not exist");
            return 0;
        }

    }

    public function registerUser($firstname, $lastname, $username, $email, $password, $gender, $hash){

        global $database;
        
        $date1 = date('Y-m-d H:i:s');
        $final1 = strtotime($date1);
        $lastLogin1 = date('Y-m-d H:i:s', $final1);

        $date2 = date('Y-m-d');
        $final2 = strtotime($date2);
        $dateOfCreation1 = date('Y-m-d', $final2);;
        
        

       $sql = "INSERT INTO users(firstname, lastname, username, email, password, gender, dateOfCreation, last_login, hash) VALUES('$firstname', '$lastname', '$username', '$email', '$password', '$gender', '$dateOfCreation1', '$lastLogin1', '$hash')";
       
        $resultSet = $database->query($sql);
        
        if ($database->affectedRows($resultSet)) {
            $this->getMessage(" insert worked");

            return 1;
        }else{
            $this->getMessage("insert didnt work");

            return 0;
        }

    }

    public function sanitize($input){
        global $database;
        
        $sanitizedInput = $database->escapeString(trim($input));
        return $sanitizedInput;
    }
    
    
    
}




?>

