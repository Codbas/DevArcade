<?php $scriptName = basename($_SERVER['SCRIPT_NAME'], '.php');
$loggedIn = true;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?php echo($title); ?></title>
    <link rel="stylesheet" href="../public/styles/navbar.css">

    <?php if($scriptName == 'About') echo '<link rel="stylesheet" href="../public/styles/About.css">'; ?>
    <?php if($scriptName == 'ChangePassword') echo '<link rel="stylesheet" href="../public/styles/ChangePassword.css">'; ?>
    <?php if($scriptName == 'DevLog') echo '<link rel="stylesheet" href="../public/styles/DevLog.css">'; ?>
    <?php if($scriptName == 'DevLogs') echo '<link rel="stylesheet" href="../public/styles/DevLogs.css">'; ?>
    <?php if($scriptName == 'Home' || $scriptName == 'DevLogs') echo '<link rel="stylesheet" href="../public/styles/DevLogTile.css">'; ?>
    <?php if($scriptName == 'Game') echo '<link rel="stylesheet" href="../public/styles/Game.css">'; ?>
    <?php if($scriptName == 'Games') echo '<link rel="stylesheet" href="../public/styles/Games.css">'; ?>
    <?php if($scriptName == 'Home' || $scriptName == 'Games') echo '<link rel="stylesheet" href="../public/styles/GameTile.css">'; ?>
    <?php if($scriptName == 'Home') echo '<link rel="stylesheet" href="../public/styles/Home.css">'; ?>
    <?php if($scriptName == 'Login') echo '<link rel="stylesheet" href="../public/styles/Login.css">'; ?>
    <?php if($scriptName == 'ManageContent') echo '<link rel="stylesheet" href="../public/styles/ManageContent.css">'; ?>

    <?php if($scriptName == 'Login') echo '<script src="../public/scripts/login.js" defer></script>'; ?>
    <?php if($loggedIn) echo '<link rel="stylesheet" href="../public/styles/dashboard.css">'; ?>
    <?php if($loggedIn) echo '<script src="../public/scripts/dashboard.js" defer></script>'; ?>

</head>