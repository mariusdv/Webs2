<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Color on mobile devices. Example: mariusdv.nl -->
    <meta name="theme-color" content="#2196F3">

    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.10.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/shop-homepage.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">

    {if isset($title)}
    <title>Webshop: {htmlspecialchars($title)}</title>
    {else}
    <title>Webshop</title>
    {/if}


</head>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">PokeMart</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li class="dropdown">
                    <a id="dLabel" role="menu" data-toggle="dropdown" data-target="#"
                       href="/page.html">
                        Products<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        {foreach from=$categories item=row}
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">{$row->Category}</a>
                            <ul class="dropdown-menu">
                                {foreach from=$row->SubCategories item=sub}
                                <li><a tabindex="-1" href="#">{$sub}</a></li>
                                {/foreach}
                            </ul>
                        </li>
                        {/foreach}
                    </ul>

                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-shopping-cart cart"></span> {$cartSize} </a></li>
                {if isset($user)}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">{$user->email}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/account">Mijn profiel</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/account">Wishlist</a></li>
                        <li><a href="/account">Bestellingen</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/account/action=logout">Log uit</a></li>
                    </ul>
                </li>
                {else}
                <li><a href="/account/action=login">Log in</a></li>
                {/if}

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<body>
<!--
Menu
Breadcrumbs
-->

