<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico">
        <title>Add players</title>
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
        input[type=text]{
        width: 10%;
        padding: 2px 4px;
        margin: 0px 1px;
        box-sizing: border-box;
        }
        </style>
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
                die ("Connection failed");
            }

            //set up number of players from $_POST
            $number=$_POST["noPlayers"];
            for($y=1;$y<=$number;$y++){
               if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    ${"name".$y}=filter_input(INPUT_POST,"name".$y);
                }
           }
           $pass=true;
            echo "<h1>Tennis Tournament</h1>";
            echo "<h3>Add Players</h3>";
            echo "<form method=\"post\">";
            echo "<input type=\"hidden\" name=\"noPlayers\" value=\"$number\">";  
            for ($i=1;$i<=$number;$i++){
                echo "<p>Player ".$i.": <input type=\"text\" name=\"name".$i."\" value=".${"name".$i}."></p>";
            }
            echo "\n<button type=\"submit\">Submit</button></form>";
            //check all  the names if any empty
            for ($i=1;$i<=$number;$i++){
                if (empty(${"name".$i})){
                    $pass=false;
                }
            }
            if ($pass){
            for ($i=1;$i<=$number;$i++){   
                $name=$conn-> real_escape_string($_POST["name".$i]);
                //a name is given-insert
                $sql = "INSERT INTO `names` (`name`) VALUES ('$name')";
                $resultA=$conn->query($sql);
                if(!$resultA){
                    die ("Query A failed".$conn->error);
                }
                for ($j=$i+1;$j<=$number;$j++){
                    $nextName=$conn-> real_escape_string($_POST["name".$j]);
                    $sql = "INSERT INTO `scores` (`nameA`, `scoreA`, `scoreB`, `nameB`,`winner`) VALUES ('$name', NULL, NULL, '$nextName',NULL)";
                    $resultB= $conn->query($sql);
                    if(!$resultB){
                        die ("Query B failed".$conn->error);
                    }
            }}
            echo "Insertion of the players complete";
            echo "<h4>Please select one of the options below:</h4>";
            echo "<button onclick=\"location.href='showTables.php'\">Show Tables</button>";
            echo "<button onclick=\"location.href='submitScore.php'\">Submit Score</button>";
            
           
            }else{
                echo "<span style='color: #ff0000;'>* You need to provide all the names</span>";         
            }  
            ?>
        </div>
    </body>
</html>
