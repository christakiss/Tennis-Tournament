<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico">
        <title>Create Account</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        body {
        background-image: url("tennis.png");
        background-position:-20px -20px;
        background-attachment: fixed;
        }
        h1 {
        color: black;
        text-align: center;
        }
        h3 {
        color: black;
        text-align: left;
        }
        div {
        font-family: Arial, Helvetica, sans-serif;
        margin-top: 40px;
        margin-bottom: 100px;
        margin-right: 150px;
        margin-left: 80px;
        }
        button, button[type=submit]{
        background-color: #a8a8a8;
        border: none;
        border-radius: 2px;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        margin: 2px 1px;
        cursor: pointer;
        }
        input[type=text],input[type=password]{
        width: 10%;
        padding: 8px 16px;
        margin: 2px 1px;
        box-sizing: border-box;
        }
        </style>
        <script>
            function check1(){
                var cpass=document.forms["cForm"]["cpass"].value;
                if (cpass==null || cpass==""){
                    alert("Field cannot be empty");
                    return false;
                }
                if (cpass!="coach2016PLAY"){
                    alert("Not correct password. Try again or use Parent View");
                    return false;
                }else {
                    return true;
                }
            }

            function check2(){
                var uname=document.forms["form"]["uname"].value;
                var pass=document.forms["form"]["pass"].value;
                if ((uname==null || uname=="")||(pass==null|| pass=="")){
                    alert("All fields must be filled");
                    return false;
                }
                return true;
            }
    </script>
    </head>
    
<body>
    <div> 
            <?php
            //connect to the database
            $servername="devweb2016.cis.strath.ac.uk";
            $username="dkb14203";
            $password= "SeisuMoh2aik";
            $database="dkb14203"; 
            $conn=new mysqli($servername,$username,$password,$database);

            if ($conn->connect_error){
                die ("Connection failed: ".$conn->connect_error); 
            }
            //setting the username,password and coach password variables
            $uname=isset($_POST["uname"])? $conn-> real_escape_string($_POST["uname"]) : "" ;
            $pass=isset($_POST["pass"])? $conn-> real_escape_string($_POST["pass"]) : "" ;
            $cpass=isset($_POST["cpass"])? $conn-> real_escape_string($_POST["cpass"]) : "" ;
            ?>
            <h1><a href="login.php" style="text-decoration: none">Tennis Tournament</a></h1>
            <h3>Coach Login </h3>
            <h3>Submit the master password to create a new account:</h3>         
            <form method="post" name="cForm" onsubmit="return check1();">
            <label><b>Coach master password:</b></label>
            <input type="text" name="cpass" value="<?php echo $cpass;?>">
            <button type="submit">Submit</button><br><br>
            </form>
            <?php
            if ($cpass==="coach2016PLAY"){
                echo "<form method=\"post\" name=\"form\" onsubmit=\"return check2();\">";
                echo "<label><b>Create Username</b></label>";
                echo "<input type=\"text\" name=\"uname\" value=\"".$uname."\"><br><br>";
                echo "<label><b>Create Password</b></label>";
                echo "<input type=\"password\" name=\"pass\" value=\"".$pass."\"><br><br>";    
                echo "<button type=\"submit\">Submit</button><br><br>";
                echo "</form>";
                echo "Correct password given. You can now create your new account.\n";
                
            }
                if (empty($uname)&&empty($pass)){
                    echo "<br><br>";
                    echo "<button onclick=\"location.href='parentView.php'\">Parent View</button>";
                    echo "<button onclick=\"location.href='login.php'\">Back</button></div>";
                    die();
                }
                $sql = "INSERT INTO `users` (`uname`, `pass`) VALUES ('$uname', '$pass')";
                $result=$conn->query($sql);
                if (!$result){
                   die("Query failed: ".$conn->error);
                }else {
                     echo "New account created. Go back to login.<br>";
                }
                echo "<br><br>";
                echo "<button onclick=\"location.href='parentView.php'\">Parent View</button>";
                echo "<button onclick=\"location.href='login.php'\">Back</button>";    
            ?>       
    </div>
  </body>
</html>





