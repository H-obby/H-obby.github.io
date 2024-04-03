<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="theme-color"content="#e7f0f2ff"/>
        <link
        rel="shortcut icon"
        href=<?=URL."public/practicum.svg"?>
        type="icon/png"
        sizes="32x32"
        />
        <title><?= "Practicum | ".$page_title; ?></title>
        <meta property="og:title" content="Practicum" />
        <meta name="viewport" content="width=412, initial-scale=1.0" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8" />
        <meta name="description" content="<?= $page_description; ?>"/>
        <!-- Script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- jQuery UI -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    </head>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        data-tag="font"
    />
    <link href='../components/alert.css' rel='stylesheet' />
    <link href='../styles/style.css' rel='stylesheet' />
    <link href='../components/logged-in-header.css' rel='stylesheet' />
    <link href='../components/footer.css' rel='stylesheet' />
    <link href='../components/header.css' rel='stylesheet' />
    <link href='../components/search-bar.css' rel='stylesheet' />
    <link href='../components/pagination.css' rel='stylesheet' />
    <link href='..//manifest.json' rel='manifest' />
    <link href='../c' rel='script' />
    
    <?php if(!empty($page_css)) : ?>
        <?php foreach($page_css as $fichier_css) : ?>
            <link href="<?= URL ?>styles/<?= $fichier_css ?>" rel='stylesheet' />
        <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if(!empty($componentCSS)) : ?>
        <?php foreach($componentCSS as $fichier_css) : ?>
            <link href="<?= URL ?>component/<?= $fichier_css ?>" rel='stylesheet' />
        <?php endforeach; ?>
    <?php endif; ?>

    <body>
        <?php 
            if($_SESSION["logged"]) {
                require_once("loggedHeader.php"); 
            } else {
                require_once("header.php");
            }
        
        ?>
        <?= $page_content; ?>
        <?php require_once("footer.php"); ?>
    </body>

    <?php
    require_once("controllers/Toolbox.php");
    try{
        Toolbox::displayAlerts();
    } catch (Exception $e) {
        throw new RuntimeException($e->getMessage());
    }
    ?>
</html>