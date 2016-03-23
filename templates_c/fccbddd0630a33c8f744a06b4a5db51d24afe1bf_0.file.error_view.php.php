<?php
/* Smarty version 3.1.29, created on 2016-03-21 14:26:56
  from "/sites/pokemart.nl/www/View/error_view.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56eff6a0c13cd1_33522511',
  'file_dependency' => 
  array (
    'fccbddd0630a33c8f744a06b4a5db51d24afe1bf' => 
    array (
      0 => '/sites/pokemart.nl/www/View/error_view.php',
      1 => 1458552696,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56eff6a0c13cd1_33522511 ($_smarty_tpl) {
?>
<div class="container">
<h1>
    ERROR VIEW!
</h1>
<p>
    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['message']->value);?>

</p>
</div><?php }
}
