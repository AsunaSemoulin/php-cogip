<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action']=='login') {
        ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
        <?php
        }
    }
    ?>
    <link href="https://salukimakingcode.github.io/pack/pack.css" rel="stylesheet" />
    <script src="https://salukimakingcode.github.io/pack/pack.js"></script>
    <link href="./assets/css/style.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo $description; ?>>" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?php echo $title; ?></title>
</head>
<body>
<header>

</header>
