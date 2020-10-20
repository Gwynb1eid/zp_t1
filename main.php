<div class="block_for_messages">
    <?php
 
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
            unset($_SESSION["error_messages"]);
        }
 
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 
<?php
    //isLogin
    if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
?>
 
    <div id="formLogin">
        <h2>Login</h2>
        <form action="login.php" method="post" name="formLogin">
            <table>
                <tbody>
                    
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>
          
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                </tr>
                
                    <td colspan="2">
                        <input type="submit" name="btn_submit_auth" id="btn_sbmt" value="Enter">
                        
                        <a href="formRegister.php">
                            <input type="button" name="btn_register" id="btn_reg" value="Register">
                        </a>
                        
                    </td>
                </tr>
                
                </tbody>
            </table>
        </form>
        
    </div>
 
<?php
    }else{
?>
 
    <div id="authorized">
        <h2>Signed in</h2>
    </div>
 
<?php
    }
?>