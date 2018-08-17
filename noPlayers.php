<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico" >
        <title>Tennis tournament</title>
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
        input[type=number] {
        width: 10%;
        padding: 8px 16px;
        margin: 2px 1px;
        box-sizing: border-box;
        }   
        </style>
        <script>
            function check(){
                var number=document.forms["numberForm"]["noPlayers"].value;
                if (number==null || number==""){
                    alert("Number of players is required");
                    return false;
                }else{
                    return true;
                }      
            }
        </script>
    </head>
    <body>
        <div>
            <form action="addPlayers.php" method="post" name="numberForm" onsubmit="return check();"> 
            <h1>Tennis Tournament</h1>
            <h3>Welcome to coach mode. Please select number of players for the tournament.</h3>
            Number of players (4-12): <input type="number" name="noPlayers" min="4" max="12"><button type="submit">Submit</button><br><br>
            </form>
            <p>Have you already set up the tournament? Go to home page to see more options</p>
            <button onclick="location.href='mainPage.php'">Home</button>
        </div>
    </body>
</html>


