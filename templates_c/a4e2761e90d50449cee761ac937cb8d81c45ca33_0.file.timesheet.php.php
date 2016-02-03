<?php
/* Smarty version 3.1.29, created on 2016-02-03 22:13:49
  from "D:\Xampp\htdocs\View\timesheet.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56b26d8d4f15e2_24509419',
  'file_dependency' => 
  array (
    'a4e2761e90d50449cee761ac937cb8d81c45ca33' => 
    array (
      0 => 'D:\\Xampp\\htdocs\\View\\timesheet.php',
      1 => 1454531871,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56b26d8d4f15e2_24509419 ($_smarty_tpl) {
?>

<div class="container">
    <table class="table table-hover">
        <caption>Urenverantwoording</caption>
        <thead>
        <tr>
            <th>Datum</th>
            <th>Naam</th>
            <th>Taak</th>
            <th>Uren</th>
        </tr>
        </thead>
        <tbody>
        <?php
$_from = $_smarty_tpl->tpl_vars['rows']->value;
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
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Date;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Name;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Task;?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value->Time;?>
</td>
        </tr>
        <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>
        </tbody>
    </table>

    <p>
        Totaal Marius: <?php echo $_smarty_tpl->tpl_vars['Marius']->value;?>

    </p>
    <p>
        Totaal Patrick: <?php echo $_smarty_tpl->tpl_vars['Patrick']->value;?>

    </p>
</div>

<?php }
}
