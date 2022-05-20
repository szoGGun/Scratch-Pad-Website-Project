<html lang="pl">

<head>
    <title>Scratch pad</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="/public/style.css" rel="stylesheet">
</head>
<body class="body">
<div class="wrapper">
    <div class="header">
        <h1><i class="far fa-clipboard"></i>Scratch pad</h1>
    </div>

    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="/">Home page</a></li>
                <?php if (isset($_SESSION['loggedin'])): ?>
                <li><a href="/?action=create">New note</a></li>
                <li><a href="/?action=upload">File upload</a></li>
                <li><a href="/?action=gallery">Gallery</a></li>
                <?php endif;?>
                <li><a href="/?action=register">Register</a></li>
                <?php if (!isset($_SESSION['loggedin'])): ?>
                <li><a href="/?action=login">Login</a></li>
                <?php endif;?>
                <?php if (!isset($_SESSION['role'])): ?>

                <?php endif;?>
                <?php if (isset($_SESSION['loggedin'])): ?>
                <li><a href="/?action=contact">Contact Us</a></li>
                <li><a href="/?action=logout">Logout</a></li>
                <?php endif;?>
                <?php if (isset($_SESSION['role'])): ?>
                <liv><a href="/?action=messages"?>Messages</a> </liv>
                <li><a href="/?action=admin">Admin Panel</a></li>
                <?php endif;?>
            </ul>
        </div>

        <div class="page">
            <?php require_once("templates/pages/$page.php"); ?>
        </div>
    </div>

    <div class="footer">
        <p>PHP Project - Notepad</p>
    </div>
</div>
</body>
</html>