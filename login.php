<?php
    session_start();
    
    require_once("dbconnect.php");
    
    $_SESSION["error_messages"] = '';
    
    $_SESSION["success_messages"] = '';

    //isBtn
    if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])) {
        
        //email check
        $email = trim($_POST["email"]);
            if(isset($_POST["email"])) {
             
                if(!empty($email)) {
                    $email = htmlspecialchars($email, ENT_QUOTES);
                    
                    $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";
                    
                    if( !preg_match($reg_email, $email)) {
                        
                        $_SESSION["error_messages"] .= "<p class='mesage_error' >Wrong Email</p>";
                        
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."index.php");
                        
                        exit();
                    }
                }else {
                    
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >No Email data</p>";
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."index.php");
                    
                    exit();
                }
                 
             
            }else {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error' >No Email</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."index.php");
                
                exit();
            }
             
            //password check
            if(isset($_POST["password"])) {
                
                $password = trim($_POST["password"]);
             
                if(!empty($password)) {
                    $password = htmlspecialchars($password, ENT_QUOTES);
                    
                    $password = md5($password."gigantaur");
                }else {
                    
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Enter your password</p>";
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."index.php");
                    
                    exit();
                }
                 
            }else {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error' >No password</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."index.php");
                
                exit();
            }
            
            //DB check
            $result_query_select = $mysqli->query("SELECT * FROM `users` WHERE email = '".$email."' AND password = '".$password."'");
                        
            if(!$result_query_select) {
                
                $_SESSION["error_messages"] .= "<p class='mesage_error' >DB Error</p>";
                
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."index.php");
                
                exit();
            }else {
                
                if($result_query_select->num_rows == 1) {
                    
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    
                                        
                    //$_SESSION['nickname'] = $nickname;
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."/index.php");
             
                }else {
                                         
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Wrong login or password</p>";
                    
                    header("HTTP/1.1 301 Moved Permanently");
                    header("Location: ".$address_site."index.php");
                    
                    exit();
                }
            }
            
            
    }else {
        exit("<p>No Data :)</p>");
    }