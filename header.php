 <?php 
    session_start(); 
 ?> 

<!doctype html>

<html>
    
    <head>
        
        <title>test 1</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                "use strict";
                //regex
                var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
                var mail = $('input[name=email]');
                 
                mail.blur(function() {
                    if(mail.val() != '') {
                                 
                        if(mail.val().search(pattern) == 0){
                            
                            $('#valid_email_message').text('');
                            
                            $('input[type=submit]').attr('disabled', false);
                        }else {
                            
                            $('#valid_email_message').text('Wrong Email');
                            
                            $('input[type=submit]').attr('disabled', true);
                        }
                    }else {
                        $('#valid_email_message').text('Enter your email');
                    }
                });
         
                //pswd lenght check
                var password = $('input[name=password]');
                 
                password.blur(function(){
                    if(password.val() != '') {
                        
                        if(password.val().length < 6) {
                            
                            $('#valid_password_message').text('6 symb min');
                            
                            $('input[type=submit]').attr('disabled', true);
                             
                        }else {
                            
                            $('#valid_password_message').text('');
                            
                            $('input[type=submit]').attr('disabled', false);
                        }
                    }else {
                        $('#valid_password_message').text('Enter your password');
                    }
                });
            });
        </script>
            
    </head>
    
    <body>
        <div id="header">
            <h1>GIGANTAUR опжа</h1>
        </div>
        
<!--        authorization check-->
        <div id="auth_block">
            <?php
            
                if(isset($_SESSION['email']) && isset($_SESSION['password'])) {
                    
                    //echo $_SESSION['password'];
                    echo 'Hello, ';
                    echo $_SESSION['email'];
            ?> 
            
            <div>
                <a href="logout.php">Logout</a>
            </div>
            
            <?php
                }
            ?>
        </div>