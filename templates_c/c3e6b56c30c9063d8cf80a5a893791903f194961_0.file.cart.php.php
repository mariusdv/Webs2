<?php
/* Smarty version 3.1.29, created on 2016-03-22 08:10:21
  from "/sites/pokemart.nl/www/View/cart.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56f0efdda1a2b6_22730083',
  'file_dependency' => 
  array (
    'c3e6b56c30c9063d8cf80a5a893791903f194961' => 
    array (
      0 => '/sites/pokemart.nl/www/View/cart.php',
      1 => 1458553182,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56f0efdda1a2b6_22730083 ($_smarty_tpl) {
?>
<div class="container">

    <div class="header"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
    <form name="cart" action="/Order" method="post">
        <table class="table table-bordered table-striped table-condensed cartTable bigCart">
            <tr>
                <td></td>
                <td>Name</td>
                <td>Amount</td>
                <td>Price</td>
                <td></td>
            </tr>
            <?php if (isset($_smarty_tpl->tpl_vars['title']->value)) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['cart']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_0_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_0_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
            <tr>
                <td><img src="<?php echo $_smarty_tpl->tpl_vars['row']->value->Product->ImgUrl;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value->Product->Name;?>
"/></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Product->Name;?>
</td>
                <td>
                    <button class="btn btn-default"><span class="glyphicon glyphicon-refresh"/></button>
                    <input name="<?php echo $_smarty_tpl->tpl_vars['row']->value->Product->Id;?>
" class="smallInput" type="number" min="0" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->Quantity;?>
"></td>
                <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Product->Price;?>
</td>
                <td>
                    <button onclick="removeItem(<?php echo $_smarty_tpl->tpl_vars['row']->value->Product->Id;?>
)" class="btn btn-default">Remove</button>
                </td>
            </tr>
            <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>

            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['totalPrice']->value)) {?>
            <tr>
                <td colspan="4"> Total:</td>
                <td><?php echo $_smarty_tpl->tpl_vars['totalPrice']->value;?>
</td>
            </tr>
            <?php }?>
        </table>
    </form>
    <td>
        <a href="/Order/action=order" class="btn btn-primary">Bestel</a>
    </td>

</div>

<?php echo '<script'; ?>
>

    function removeItem($var)
    {
        document.getElementsByName($var)[0].value = 0;
    }
<?php echo '</script'; ?>
>

<?php }
}
