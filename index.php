<?php
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
        <link href="source/main.css" rel="stylesheet">
        <link href="styles/font-joeslab.css" rel="stylesheet">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">-->

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