

<!DOCTYPE html >
<html lang = "en" >
<head >
    <meta charset = "UTF-8" >

    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">

    <?php if (isset($title)): ?>
        <title>Webshop: {htmlspecialchars($title)}</title>
    <?php else: ?>
        <title>Webshop</title>
    <?php endif ?>


</head >
<body >

<!--
Menu
Breadcrumbs
-->

