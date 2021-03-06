<?php
    session_start();
    include('database.php');
    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = "home";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>HackerGame</title>
        <link href="source/main.css" rel="stylesheet" type="text/css">
        <link href="source/game.css" rel="stylesheet" type="text/css">
        <link href="source/font-joeslab.css" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="source/favicon.ico" />

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h1 id="title">HackerGame</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <?php include('menubar.php'); ?>
        </nav>
        <div id="content_box">
			<div id="content">
				<?php include("pages.php"); ?>
			</div>
		</div>
    </body>
</html>