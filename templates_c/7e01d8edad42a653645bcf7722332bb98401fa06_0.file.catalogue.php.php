<?php
/* Smarty version 3.1.29, created on 2016-03-21 14:26:56
  from "/sites/pokemart.nl/www/View/catalogue.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56eff6a045aa27_33915639',
  'file_dependency' => 
  array (
    '7e01d8edad42a653645bcf7722332bb98401fa06' => 
    array (
      0 => '/sites/pokemart.nl/www/View/catalogue.php',
      1 => 1458559580,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56eff6a045aa27_33915639 ($_smarty_tpl) {
?>
<div class="container">

    <div class="row flat-header">
        <div class="col-sm-3 col-lg-3 ">
            <div class="header">Categories</div>
        </div>
        <div class="col-sm-9 col-lg-9">
            <div class="header"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
        </div>
    </div>
    <div class="row flat-lighterblue">
        <br>
        <div class="col-sm-3 col-lg-3">
            <div class="panel-group" id="accordion">
                <?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
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
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $_smarty_tpl->tpl_vars['row']->value->FoldId;?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value->Category;?>
</a>
                        </h4>
                    </div>
                    <div id="collapse<?php echo $_smarty_tpl->tpl_vars['row']->value->FoldId;?>
" class="panel-collapse collapse">
                        <div class="panel-body category">
                            <a href="/catalogue/cat=<?php echo $_smarty_tpl->tpl_vars['row']->value->Category;?>
">
                                <div class="subcategory">
                                    All
                                </div>
                            </a>
                            <hr class="small">
                            <?php
$_from = $_smarty_tpl->tpl_vars['row']->value->SubCategories;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_subcat_1_saved_item = isset($_smarty_tpl->tpl_vars['subcat']) ? $_smarty_tpl->tpl_vars['subcat'] : false;
$_smarty_tpl->tpl_vars['subcat'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['subcat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['subcat']->value) {
$_smarty_tpl->tpl_vars['subcat']->_loop = true;
$__foreach_subcat_1_saved_local_item = $_smarty_tpl->tpl_vars['subcat'];
?>
                            <a href="/catalogue/subcat=<?php echo $_smarty_tpl->tpl_vars['subcat']->value;?>
">
                                <div class="subcategory">
                                    <?php echo $_smarty_tpl->tpl_vars['subcat']->value;?>

                                </div>
                            </a>
                            <?php
$_smarty_tpl->tpl_vars['subcat'] = $__foreach_subcat_1_saved_local_item;
}
if ($__foreach_subcat_1_saved_item) {
$_smarty_tpl->tpl_vars['subcat'] = $__foreach_subcat_1_saved_item;
}
?>
                        </div>
                    </div>
                </div>
                <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_local_item;
}
if ($__foreach_row_0_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_0_saved_item;
}
?>

            </div>
        </div>

        <div class="col-sm-9 col-lg-9">

            <div class="row">

                <?php if (!isset($_smarty_tpl->tpl_vars['rows']->value)) {?>
                No items found.
                <?php } else { ?>
                <?php
$_from = $_smarty_tpl->tpl_vars['rows']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_row_2_saved_item = isset($_smarty_tpl->tpl_vars['row']) ? $_smarty_tpl->tpl_vars['row'] : false;
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$__foreach_row_2_saved_local_item = $_smarty_tpl->tpl_vars['row'];
?>
                <div class="col-xs-12 col-sm-12 col-lg-4 col-md-6">
                    <div class="thumbnail">
                        <div class="imageWrapper">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['row']->value->ImgUrl;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['row']->value->Name;?>
">
                        </div>
                        <div class="info">
                            <div class="caption flat-caption">
                                <h4 class="pull-right">$<?php echo $_smarty_tpl->tpl_vars['row']->value->Price;?>
</h4>
                                <h4><a href="/catalogue/product=<?php echo $_smarty_tpl->tpl_vars['row']->value->Id;?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value->Name;?>
</a>
                                </h4>
                                <p><?php echo $_smarty_tpl->tpl_vars['row']->value->DescriptionShort;?>
</p>
                            </div>
                            <form class="addToCartForm" action="/Catalogue/subcat=<?php echo $_smarty_tpl->tpl_vars['cat']->value;?>
" method="post">
                                <input type="hidden" name="item" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->Id;?>
"/>
                                <input type="hidden" name="name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->Name;?>
"/>
                                <button type="submit" class="btn btn-default addbutton flat-button flat-lightblue">
                                    <span type="submit" class="glyphicon glyphicon-shopping-cart cart"></span>
                                    <span class="text" type="submit">Add to cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_2_saved_local_item;
}
if ($__foreach_row_2_saved_item) {
$_smarty_tpl->tpl_vars['row'] = $__foreach_row_2_saved_item;
}
?>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($_smarty_tpl->tpl_vars['added']->value)) {
echo '<script'; ?>
>
    $( document ).ready(function() {
        toastr.options = {
            "positionClass": "toast-bottom-right"
        }
        toastr.info("Item has been successfully added to the cart!", "Pokemart");
    });
<?php echo '</script'; ?>
>
<?php }
}
}
