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
    <script src="../JS/toastr.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/CSS/shop-homepage.css">
    <link rel="stylesheet" type="text/css" href="/CSS/Style.css">
    <link rel="stylesheet" type="text/css" href="/CSS/toastr.min.css">


    {if isset($title)}
    <title>Webshop - {htmlspecialchars($title)}</title>
    {else}
    <title>Webshop</title>
    {/if}


</head>

<body>
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
            <a class="navbar-toggle navbar-nav smallcart" href="/Order"><span
                    class="glyphicon glyphicon-shopping-cart cart"></span> {$cartSize} </a>

            <a class="navbar-brand" href="/"><img src="/Resources/Images/logo.png" alt="logo"></a></div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-left">
                {if ! isset($admin)}
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>

                <li class="dropdown">
                    <a id="dLabel" data-toggle="dropdown" data-target="#"
                       href="/page.html">
                        Products<span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu multi-level">
                        {foreach from=$categories item=row}
                        <li class="dropdown-submenu">
                            <a tabindex="-1">{$row->Category[0]}</a>
                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="/catalogue/cat={$row->Category[1]}">All</a></li>
                                <li role="separator" class="divider small"></li>
                                {foreach from=$row->SubCategories item=sub}
                                <li><a tabindex="-1" href="/catalogue/subcat={$sub[1]}">{$sub[0]}</a></li>
                                {/foreach}
                            </ul>
                        </li>
                        {/foreach}
                    </ul>

                </li>
                {else}
                <li><a href="/">Home</a></li>
                <li><a href="/Admin/p=cat">Products</a></li>
                <li><a href="/Admin/p=orders">Orders</a></li>
                <li><a href="/Admin/p=category">Categories</a></li>
                {/if}
            </ul>

            {if ! isset($admin)}

            <form class="navbar-form navbar-left" role="search" action="/Catalogue" method="get">
                {else}
                <form class="navbar-form navbar-left" role="search" action="/Admin/p=cat" method="get">
                    {/if}

                    <div class="form-group">
                        <input name="search" id="search" type="text" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default"><span
                            class="glyphicon glyphicon-search search"></span>
                    </button>
                </form>

                <ul class="nav navbar-nav navbar-right">
                    {if ! isset($admin)}

                    <li><a href="{$comparisonLink}">Comparison ({$compareCount})</a></li>

                    <li class="dropdown-cart">
                        <a href="/Order" class="hidden-xs"><span class="glyphicon glyphicon-shopping-cart cart"></span>
                            {$cartSize} </a>
                        <div class="dropdown-cart-content">
                            <table class="table table-bordered table-striped table-condensed cartTable">
                                <tr>
                                    <td></td>
                                    <td>Name</td>
                                    <td>Amount</td>
                                    <td>Price</td>
                                </tr>
                                {foreach from=$cart item=row}
                                <tr>
                                    <td><img src="{$row->Product->ImgUrl}" alt="{$row->Product->Name}"/></td>
                                    <td>{$row->Product->Name}</td>
                                    <td>{$row->Quantity}</td>
                                    <td>{$row->Product->Price}</td>
                                </tr>
                                {/foreach}
                                <tr>
                                    <td colspan="3"> Total:</td>
                                    <td>{$totalPrice}</td>
                                </tr>
                            </table>
                        </div>
                    </li>


                    {if isset($user)}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{$user->email}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/account">Mijn profiel</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/account/tab=wishlist">Wishlist</a></li>
                            <li><a href="/account/tab=orders">Bestellingen</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="/account/action=logout">Log uit</a></li>
                        </ul>
                    </li>
                    {else}
                    <li><a href="/account/action=login">Log in</a></li>
                    {/if}
                    {else}
                    <!-- ADMIN -->
                    <li><a href="/admin/p=logout">Admin log-out</a></li>
                    {/if}

                </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!--Breadcrumbs-->
{if isset($breadcrumbTrial)}
{assign var="counter" value=count($breadcrumbTrial)}
{assign var="i" value="0"}
<ol class="breadcrumb">
    {foreach from=$breadcrumbTrial item=breadcrumb}
    {assign var="i" value=$i+1}
    {if $i == $counter}
    <li class="active">{$breadcrumb[0]}</li>
    {else}
    <li><a href="{$breadcrumb[1]}">{$breadcrumb[0]}</a></li>
    {/if}
    {/foreach}
</ol>
{else}
<br>
{/if}
