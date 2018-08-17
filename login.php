<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico">
        <title>Log in</title>
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
        input[type=text], input[type=password] {
        width: 10%;
        padding: 8px 16px;
        margin: 2px 1px;
        box-sizing: border-box;
        }
        </style>
        <script>
            function check(){
                var uname=document.forms["liForm"]["uname"].value;
                var pass=document.forms["liForm"]["pass"].value;
                var errs="";

                if (uname==null || uname==""){
                    errs += " *Name is required\n";
                }
                if (pass==null || pass==""){
                    errs += " *Password is required\n";
                }
                if (errs!=""){
                    alert (errs);
                }
                return (errs=="");
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
                die ("Connection failed: ");
            }
            
             //setting the username,password variables
            $uname=isset($_POST["uname"])? $conn-> real_escape_string($_POST["uname"]) : "" ;
            $pass=isset($_POST["pass"])? $conn-> real_escape_string($_POST["pass"]) : "" ;
            
            $sql="SELECT * FROM `users`";
            $result= $conn->query($sql);
            if (!$result){
                die("Query failed: ");
            }
            if ($result->num_rows >0){
                while($row=$result->fetch_assoc()){
                    if ($row["uname"]==$uname && $row["pass"]==$pass){
                        header("Location: noPlayers.php");
                        die();
                    }                    
                }      
            }
        ?>
        <h1>Tennis Tournament</h1>
        <h3>Coach Login </h3>
        <form name="liForm" onsubmit="return check();" method="post">
        <label><b>Username</b></label>
        <input type="text" name="uname" value="<?php echo $uname?>"><br><br>
        <label><b>Password</b></label>
        <input type="password" name="pass" value="<?php echo $pass?>"><br><br>    
        <button type="submit">Login</button>
        <?php if ($uname!=""&&$pass!=""){
            echo "<span style='color: #ff0000;'>Username and Password have not been recognised.</span>";
        }?>
        <br><br></form> 
        <button onclick="location.href='createAccount.php'">Create account</button>
        <button onclick="location.href='parentView.php'">Parent View</button>
        
    </div>
</body>
</html>



