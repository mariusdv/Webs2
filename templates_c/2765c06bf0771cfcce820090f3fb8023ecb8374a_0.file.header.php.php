<?php
/* Smarty version 3.1.29, created on 2016-02-03 22:13:45
  from "D:\Xampp\htdocs\View\header.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b26d898d1204_87498089',
  'file_dependency' => 
  array (
    '2765c06bf0771cfcce820090f3fb8023ecb8374a' => 
    array (
      0 => 'D:\\Xampp\\htdocs\\View\\header.php',
      1 => 1454532191,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b26d898d1204_87498089 ($_smarty_tpl) {
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
