<?php
    session_start();

    require_once("dbconnect.php");

    $_SESSION["error_messages"] = '';

    $_SESSION["success_messages"] = '';

    //isBtn
    if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])) {
                    
            if(isset($_POST["email"])) {

                $email = trim($_POST["email"]);

                if(!empty($email)) {
                    
                    $email = htmlspecialchars($email, ENT_QUOTES);

                    $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
                    
                    if(!preg_match($reg_email, $email)) {
                         
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Wrong email</p>";
                        
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."formRegister.php");
                        
                        exit();
                    }
                    
                    $query_isEmail_exist = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");
                    
                    if($query_isEmail_exist->num_rows == 1) {
                        
                        if(($row = $query_isEmail_exist->fetch_assoc()) != false) {
                            
                                $_SESSION["error_messages"] .= "<p class='mesage_error' >Email already exist</p>";
                                
                                header("HTTP/1.1 301 Moved Permanently");
                                header("Location: ".$address_site."formRegister.php");
                            
                        }else {
                            
                            $_SESSION["error_messages"] .= "<p class='mesage_error' >DB ERROR</p>";
                            
                            header("HTTP/1.1 301 Moved Permanently");
                            header("Location: ".$address_site."formRegister.php");
                        }
                        
                        $query_isEmail_exist->close();
                        
                        exit();
                    }
                    
                    $query_isEmail_exist->close();
                }else {
                    
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your email</p>";
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."formRegister.php");
                    
                    exit();
                }

            }else {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле для ввода Email</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."formRegister.php");
                
                exit();
            }
            
            
            
            if(isset($_POST["password"])) {
                
                $password = trim($_POST["password"]);

                if(!empty($password)) {
                    $password = htmlspecialchars($password, ENT_QUOTES);
                    
                    $password = md5($password."gigantaur"); 
                }else {
                    
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your password</p>";
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."formRegister.php");
                    
                    exit();
                }

            }else {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error'>No password</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."formRegister.php");
                
                exit();
            }
            
            if(isset($_POST["nickname"])) {
                
                $nickname = trim($_POST["nickname"]);

                if(!empty($nickname)) {
                    
                    $nickname = htmlspecialchars($nickname, ENT_QUOTES);
                }else {
                    
                    $_SESSION["error_messages"] .= "<p class='mesage_error'>Enter your nickname</p>";
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."formRegister.php");
                    
                    exit();
                }

                
            }else {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с nick</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."formRegister.php");
                
                exit();
            }
            
            
            
            $query_register_insert = $mysqli->query("INSERT INTO `users` (email, password, nickname) VALUES ('".$email."', '".$password."', '".$nickname."')");

            if(!$query_register_insert) {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error' >DB ERROR</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."formRegister.php");
                
                exit();
            }else {

                $_SESSION["success_messages"] = "<p class='success_message'>Welcome to the club, buddy :)</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."index.php");
            }
            
            $query_register_insert->close();
            
            $mysqli->close();
            
        

    }else {

        exit("<p>No DATA :(</p>");
    }
?>