<?php
/* @var PDO $dbConn
 * @var bool $loggedIn
 * @var string $title
 */
$scriptName = basename($_SERVER['SCRIPT_NAME'], '.php');
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title><?php echo($title); ?></title>
    <link rel="stylesheet" type="text/css" href="styles/styles.css">
    <link rel="stylesheet" type="text/css" href="styles/navbar.css">
    <?php if($scriptName != 'DevLog' && $scriptName != 'Game') echo '<link rel="stylesheet" type="text/css" href="styles/footer.css">'; ?>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Urbanist:wght@100;200;300;400;500;600;700;800;900&family=Raleway:ital,wght@0,100..900;1,100..900&family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Kode+Mono:wght@400..700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap");
        /*
            Fonts: Urbanist, Raleway, IBM Plex Mono, Kode Mono, Roboto Mono, Space Mono
         */
    </style>

    <?php if (($scriptName == 'ChangePassword' || $scriptName == 'ManageContent') && !$loggedIn) exit('ERROR 401: Unauthorized'); ?>

    <?php if($scriptName == 'About') echo '<link rel="stylesheet" type="text/css" href="styles/About.css">'; ?>
    <?php if($scriptName == 'ChangePassword') echo '<link rel="stylesheet" type="text/css" href="styles/ChangePassword.css">'; ?>
    <?php if($scriptName == 'DevLog') echo '<link rel="stylesheet" type="text/css" href="styles/DevLog.css">'; ?>
    <?php if($scriptName == 'DevLogs') echo '<link rel="stylesheet" type="text/css" href="styles/DevLogs.css">'; ?>
    <?php if($scriptName == 'Home' || $scriptName == 'DevLogs') echo '<link rel="stylesheet" type="text/css" href="styles/DevLogTile.css">'; ?>
    <?php if($scriptName == 'Game') echo '<link rel="stylesheet" type="text/css" href="styles/Game.css">'; ?>
    <?php if($scriptName == 'Games') echo '<link rel="stylesheet" type="text/css" href="styles/Games.css">'; ?>
    <?php if($scriptName == 'Home' || $scriptName == 'Games') echo '<link rel="stylesheet" type="text/css" href="styles/GameTile.css">'; ?>
    <?php if($scriptName == 'Home') echo '<link rel="stylesheet" type="text/css" href="styles/Home.css">'; ?>
    <?php if($scriptName == 'Login') echo '<link rel="stylesheet" type="text/css" href="styles/Login.css">'; ?>
    <?php if($scriptName == 'ManageContent') echo '<link rel="stylesheet" type="text/css" href="styles/ManageContent.css">'; ?>

    <?php if($scriptName == 'ManageContent' && $loggedIn) echo '<script src="scripts/manageContent.js" defer></script>'; ?>
    <?php if($scriptName == 'Login') echo '<script src="scripts/login.js" defer></script>'; ?>

    <?php if ($scriptName == 'ManageContent' ||
              $scriptName == 'ChangePassword' ||
              $scriptName == 'Login')
              echo '<script src="https://unpkg.com/htmx.org@1.7.0"></script>' ?>

    <?php if($loggedIn) echo '<link rel="stylesheet" type="text/css" href="styles/dashboard.css">'; ?>
    <?php if($loggedIn) echo '<script src="scripts/dashboard.js" defer></script>'; ?>
</head>
