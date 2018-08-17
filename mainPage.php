<!DOCTYPE html>

<html>
    <head>
        <link rel="shortcut icon" href="tennis_ball.ico">
        <title>Tennis Tournament </title>
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
        button{
        background-color: #a8a8a8;
        border: none;
        border-radius: 2px;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        margin: 2px 1px;
        cursor: pointer;
        }
        </style>
    </head>
    <body>
        <div>
                <h1>Tennis Tournament</h1>
                <h3>Please select one of the options below:</h3>
                <button onclick="location.href='showTables.php'">Show Tables</button>
                <button onclick="location.href='submitScore.php'">Submit Score</button>
                <button onclick="location.href='login.php'">Log out</button>
        </div>
    </body>
</html>

