<?php
/* Smarty version 3.1.29, created on 2016-02-04 00:34:12
  from "C:\xampp\htdocs\View\header.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b28e74a28989_94056375',
  'file_dependency' => 
  array (
    '016991fde7ba0011fd04a1dc56efe40e6c5eb258' => 
    array (
      0 => 'C:\\xampp\\htdocs\\View\\header.php',
      1 => 1454541824,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b28e74a28989_94056375 ($_smarty_tpl) {
?>
<!DOCTYPE html >
<html lang = "en" >
<head >
    <meta charset = "UTF-8" >

    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-latest.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"><?php echo '</script'; ?>
>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">

    <?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?>
        <title>Webshop: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value);?>
</title>
    <?php } else { ?>
        <title>Webshop</title>
    <?php }?>


</head >
<body >

<!--
Menu
Breadcrumbs
-->

<?php }
}
