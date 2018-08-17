<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico" >
        <title>Submit score</title>
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
        select {
        width: 10%;
        padding: 8px 16px;
        border: none;
        border-radius: 2px;
        background-color: #f1f1f1;
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
        input[type=number] {
        width: 10%;
        padding: 8px 16px;
        margin: 2px 1px;
        box-sizing: border-box;
        }
        </style>
        <script>
            function checkForm(){
                var nameA=document.forms["form"]["nameA"].value;
                var scoreA=document.forms["form"]["scoreA"].value;
                var scoreB=document.forms["form"]["scoreB"].value;
                var nameB=document.forms["form"]["nameB"].value;
                var errs="";
                var a=Number(scoreA);
                var b=Number(scoreB);
                var total=eval("a+b");
                
                if (nameA==nameB){
                    errs += " * A player cannot play against himself\n";
                }
                if((scoreA==null || scoreA=="")||(scoreB==null || scoreB=="")){
                    errs += " * Scores cannot be empty\n";
                } 
                if (scoreA==scoreB){
                    errs += " * A game cannot end as a tie\n";
                }
                if (total!=6){
                    if(!((scoreA==3&&scoreB==4)||(scoreA==4&&scoreB==3))){
                    errs += " * Score does not add to 6 (or tiebreak 7)\n";
                    }
                } 
                if (errs!=""){
                    alert(errs);
                }
                return (errs=="");       
            }
        </script>
    </head>
    <body>
        <div>
            <h1><a href="mainPage.php" style="text-decoration: none">Tennis Tournament</a></h1>
            <h3>Please select one of the options below:</h3>
            <button onclick="location.href='showTables.php'">Show Tables</button>
            <button onclick="location.href='submitScore.php'">Submit Score</button>
            <button onclick="location.href='login.php'">Log out</button>
            <h3>Submit Score</h3>
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
            $nameA=isset($_POST["nameA"])? $conn-> real_escape_string($_POST["nameA"]) : "" ;
            $scoreA=isset($_POST["scoreA"])? $conn-> real_escape_string($_POST["scoreA"]) : "" ;
            $scoreB=isset($_POST["scoreB"])? $conn-> real_escape_string($_POST["scoreB"]) : "" ;
            $nameB=isset($_POST["nameB"])? $conn-> real_escape_string($_POST["nameB"]) : "" ;

            //show select and scores menu        
            $sql = "SELECT * FROM `names`";
            $result= $conn->query($sql);

            //handle the results
            
            echo "<form method=\"post\" name=\"form\" onsubmit= \"return checkForm();\">";     
            echo "<select name=\"nameA\">";
            
            if (!$result){
                die("Query failed: ".$conn->error);
            }
            if ($result->num_rows >0){
                while($row=$result->fetch_assoc()){
                    echo "<option value=\"".$row["name"]."\">".$row["name"]."</option>\n";
                }
            }
            echo "</select>";
            echo "<input type=\"number\" name=\"scoreA\" value=\"".$scoreA."\" min=\"0\" max=\"10\" />V" ;
            echo "<input type=\"number\" name=\"scoreB\" value=\"".$scoreB."\" min=\"0\" max=\"10\" />" ;

            $sql = "SELECT * FROM `names`";
            $result= $conn->query($sql);
            echo "<select name=\"nameB\">";
            if (!$result){
                die("Query failed: ".$conn->error);
            }
            if ($result->num_rows >0){
                while($row=$result->fetch_assoc()){
                    echo "<option value=\"".$row["name"]."\">".$row["name"]."</option>\n";
                }
            }
            echo "</select>";
            echo "<button type=\"submit\">Submit</button></form>";
            if ($scoreA!=""&&$scoreB!=""){
            if ($scoreA>$scoreB){
                $winner=$nameA;
            }else{
                $winner=$nameB;
            }
            $sqlA = "UPDATE `scores` SET `scoreA` = '$scoreA',`scoreB` = '$scoreB',`winner` = '$winner' WHERE `scores`.`nameA` = '$nameA' AND `scores`.`nameB` = '$nameB'";
       
            $sqlB = "UPDATE `scores` SET `scoreA` = '$scoreB',`scoreB` = '$scoreA',`winner` = '$winner' WHERE `scores`.`nameA` = '$nameB' AND `scores`.`nameB` = '$nameA'";
            if($conn->query($sqlA)===TRUE && $conn->query($sqlB)===TRUE){
                echo "<p>Insert successful. The score has been recorded </p>";  
            }else{
                die("Error on insert ".$conn->error);
            }
            }
            

            ?>
        </div>
    </body>
</html>