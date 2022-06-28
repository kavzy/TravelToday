<?php
    include './Database.php';

    class Authenticate
    {
        private $db;

        public function __construct()
        {
            $conn = new Database();
            $this->db = $conn->db();

        }
        
        public function login($email, $password)
        {
            
            $query = $this->db->query("SELECT count('id') AS total, users.id, users.username, users.email, users.password, role_users.role_id, users.is_active FROM users INNER JOIN role_users ON users.id = role_users.user_id WHERE (username = '$email' OR email = '$email') LIMIT 1");

            while($current_user = $query->fetch_assoc())
            {
                if($current_user['total'] == 1 && $current_user['is_active'] == 0){
                    echo '<p class="d-flex justify-content-center links" style="color:red; text-align:center;">Your account is inactivated. Please contact Admin.</p>';
                    die;
                }
                
                if($current_user['total'] == 1 && $this->verifyPassword($password, $current_user['password']) == TRUE)
                {
                    session_start();
                    $_SESSION['id'] = $current_user['id'];
                    $_SESSION['username'] = $current_user['username'];
                    $_SESSION['role_id'] = $current_user['role_id'];
                    $_SESSION['is_logged'] = TRUE;

                    if($current_user['role_id'] == 1){
                        header("Location: Admin/dashboard.php");
                    }elseif($current_user['role_id'] == 2){
                        if(isset($_SESSION['pkgid'])){
                            $pkgid = $_SESSION['pkgid'];
                            header("Location: booking.php?id=$pkgid");
                        }else{
                        header("Location: Customer/dashboard.php");
                        }
                    }else{
                        header("Location: denied.php");
                        die;
                    }
                }
                else
                {
                    echo '<p class="d-flex justify-content-center links" style="color:red; text-align:center;">Invalid user credentials.</p>';
                }
            }
        }

        public function verifyPassword($password, $enc_password)
        {
            if(password_verify($password, $enc_password))
            {
                return TRUE;
            }
        }

        public function userEmailExists($email)
        {
            $query = $this->db->query("SELECT email FROM users WHERE email = '$email'");
            if($query->num_rows == 1)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        public function sendPasswordResetLink($email)
        {
            //generate account verification key
            $key = md5(time().$email);

            //expiry date
            $date = new DateTime;
            $date = $date->format("Y-m-d H:i:s");
            $exp_date = date('Y-m-d H:i:s', strtotime('+1 hours', strtotime($date)));

            if($this->db->query("INSERT INTO `password_reset_temp`(`email`, `email_key`, `exp_date`) VALUES ('$email', '$key', '$exp_date')"))
            {
                try {
                    // Create the SMTP transport
                    $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
                        ->setUsername(MAIL_USERNAME)
                        ->setPassword(MAIL_PASSWORD);
                
                    $mailer = new Swift_Mailer($transport);
                
                    // Create a message
                    $message = new Swift_Message();
                
                    $message->setSubject('Password Reset Link');
                    $message->setFrom(['noreply@lakderena.com' => 'Lakderena Hotel Chain']);
                    $message->addTo($email);
                    
                    // Set the plain-text part
                    $message->setBody('Please click the link to reset your password');
                     // Set the HTML part
                    $message->addPart('Please click the link to reset your password: <a href="http://lakderena.local/reset_password.php?token='. $key .'&email='.$email.'">Reset Password</a>', 'text/html');
                     // Send the message
                    $result = $mailer->send($message);
                } catch (Exception $e) {
                  echo $e->getMessage();
                }

                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

        public function validatePasswordRestLink($token, $email)
        {
            $query = $this->db->query("SELECT exp_date FROM password_reset_temp WHERE email_key = '$token' AND email = '$email'");
            if($query->num_rows == 1)
            {
                $date = new DateTime;
                $date = $date->format("Y-m-d H:i:s");
        
                while($current_user = $query->fetch_assoc())
                {
                    if($date < $current_user['exp_date'])
                    {
                        return TRUE;
                    }
                }
            }
            else
            {
                return FALSE;
            }
        }

        public function resetPassword($email, $password)
        {
            //hash password
            $enc_password = $this->ownHash($password);

            if($this->db->query("UPDATE users SET password = '$enc_password' WHERE email = '$email'"))
            {
                return TRUE;
            }
            else
            {
                echo $this->db->error;
            }
        }

        public function ownHash($password)
        {
            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            return $hash_pass;
        }

             //check user email exists function
             public function checkCusEmailExists($email)
             {   
                 require_once 'Database.php';
                 $conn = new Database();
                 $db = $conn->db();
                 $query = $db->query("SELECT email FROM users WHERE email = '$email'");
                 if($query->num_rows == 1)
                 {
                     return TRUE;
     
                 }else{
     
                     return FALSE;
                 }
             }
             //end check user email exists function
     
             //check user email exists funtion
             public function checkCusUsernameExists($username)
             {   
                 require_once 'Database.php';
                 $conn = new Database();
                 $db = $conn->db();
                 $query = $db->query("SELECT username FROM users WHERE username = '$username'");
                 if($query->num_rows == 1)
                 {
                     return TRUE;
     
                 }else{
     
                     return FALSE;
                 }
             }

         //customer account create function
         public function customerCreateAccount($firstName, $lastName, $email, $username, $address,$mobile, $password)
        {
                     require_once 'Database.php';
                     $conn = new Database();
                     $db = $conn->db();
        
                    $is_username_exists = $this->checkCusUsernameExists($username);
                    $is_email_exists = $this->checkCusEmailExists($email);
        
                     //prepare and bind
                     $hashPass = $this->ownHash($password);

                     $pkgid = $_SESSION['pkgid'];
        
                    if(!$is_username_exists){
                        if(!$is_email_exists){
        
                            $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, username, password, address, mobile) VALUES (?,?,?,?,?,?,?)");
                            $stmt->bind_param("sssssss", $firstName, $lastName, $email, $username, $hashPass, $address, $mobile);
                            
                            if($stmt->execute())
                            {
                                $role_userid = $stmt->insert_id;
                                $role = 2;

                                //update role
                                $stmt1 = $db->prepare("INSERT INTO role_users (role_id, user_id) VALUES (?,?)");
                                $stmt1->bind_param("ss", $role, $role_userid);
                
                                if($stmt1->execute()){
                                    $_SESSION['id'] = $stmt->insert_id;
                                    $_SESSION['username'] = $username;
                                    $_SESSION['role_id'] = $role;
                                    $_SESSION['is_logged'] = TRUE;

                                    $stmt->close();
                                    $stmt1->close();

                                  /*  echo'<script>
                                         location.replace("create_account.php?success=true");
                                        </script>'; */

                                    echo'<script>
                                        location.replace("booking.php?id='.$pkgid.'&success=true");
                                       </script>';


                                }
                             }else{
                                    echo'<script>
                                        location.replace("create_account.php?failed=true");
                                        </script>';
                
                                     }
        
                        }else{
        
                            echo'<script>
                            location.replace("create_account.php?email=false");
                            </script>';
        
                        }
        
                    }else{
        
                        echo'<script>
                        location.replace("create_account.php?username=false");
                        </script>';
        
                    }
                    
                     // prepare and bind
                   
                   
                            
                    //end update account function
        }
    }
?>