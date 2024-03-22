<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= "Practicum | ".$page_title; ?></title>
        <meta property="og:title" content="Practicum" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta charset="utf-8" />
        <meta name="description" content="<?= $page_description; ?>"/>
    </head>

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        data-tag="font"
    />
    <link href='../styles/style.css' rel='stylesheet' />
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
                require_once("header.html");
            }
        
        ?>
        <?= $page_content; ?>
        <?php require_once("footer.html"); ?>
    </body>
</html>