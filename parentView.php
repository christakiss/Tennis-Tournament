<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico" >
        <title>Parent View</title>
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
        table{
        width:10%      
        }
        td {
        border: 1px solid black;
        height: 20px;
        padding: 5px;
        text-align: left;
        background-color: #a8a8a8;
        color: white;
        }
        </style>
    </head>
    <body>
        <div>
            <h1>Tennis Tournament</h1>
            <h3>League tables</h3>
            <?php
                //connect to the database
                $servername="devweb2016.cis.strath.ac.uk";
                $username="dkb14203";
                $password= "SeisuMoh2aik";
                $database="dkb14203"; 
                $conn=new mysqli($servername,$username,$password,$database);

                if ($conn->connect_error){
                    die ("Connection failed: ".$conn->connect_error); //FIXME remove me after debugging-security risk
                }
                
                
                $sql = "SELECT * FROM `scores`";
                $result= $conn->query($sql);
                if (!$result){
                die("Query failed: ".$conn->error);
                }
                if ($result->num_rows >0){
                    echo "<h4>Games played</h4>";
                    echo "<table>";
                    while($row=$result->fetch_assoc()){
                       if($row["scoreA"]!=null&&$row["scoreB"]!=null){    
                        echo "<tr><td>".$row["nameA"]."</td><td>".$row["scoreA"]."</td><td>-</td><td>".$row["scoreB"]."</td><td>".$row["nameB"]."</td></tr>";  
                       }
                    }echo "</table>";
                    
                    $result= $conn->query($sql);
                    echo "<h4>Games to play</h4>";
                    echo "<table>";
                    while($row=$result->fetch_assoc()){
                    if($row["scoreA"]==null&&$row["scoreB"]==null){
                        echo "<tr><td>".$row["nameA"]."</td><td>V</td><td>".$row["nameB"]."</td></tr>";
                    }       
                    }echo "</table>";
                }
                $result= $conn->query($sql);
                    $sql = "SELECT * FROM `names`";
                    $resultB = $conn->query($sql);
                    if (!$resultB){
                    die("Query failed: ".$conn->error);
                    }
                    if ($resultB->num_rows >0){
                        echo "<h4>Number of wins</h4>";
                        while($row=$resultB->fetch_assoc()){
                            ${$row["name"]}=0;   
                        }
                    }
                    if ($result->num_rows > 0) {
                    while($rowB=$result->fetch_assoc()){
                        if($rowB["winner"]!=null){
                            ${$rowB["winner"]}+=1;            
                        }
                    }  
                    } 
                        echo "<table>";
                        $resultB = $conn->query($sql);
                        $j=1;
                        while($rowB=$resultB->fetch_assoc()){
                            echo "<tr><td>".$rowB["name"]."</td><td>".${$rowB["name"]}."</td></tr>";
                            $j++;
                        }
                        echo "</table>"; 
            ?>
            <button onclick="location.href='login.php'">Back</button>
        </div>
    </body>
</html>


