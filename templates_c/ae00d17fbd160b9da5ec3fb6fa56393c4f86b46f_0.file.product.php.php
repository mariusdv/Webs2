<?php
/* Smarty version 3.1.29, created on 2016-03-22 15:02:32
  from "/sites/pokemart.nl/www/View/product.php" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_56f150781eef72_61535674',
  'file_dependency' => 
  array (
    'ae00d17fbd160b9da5ec3fb6fa56393c4f86b46f' => 
    array (
      0 => '/sites/pokemart.nl/www/View/product.php',
      1 => 1458558406,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_56f150781eef72_61535674 ($_smarty_tpl) {
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

        <div class="col-md-9">

            <div class="thumbnail clean">
                <img class="img-responsive" src="<?php echo $_smarty_tpl->tpl_vars['product']->value->ImgUrl;?>
" alt="">
                <div class="caption-full">
                    <h4 class="pull-right">$<?php echo $_smarty_tpl->tpl_vars['product']->value->Price;?>
</h4>
                    <h4><a><?php echo $_smarty_tpl->tpl_vars['product']->value->Name;?>
</a>
                        <?php if (!($_smarty_tpl->tpl_vars['stock']->value)) {?>
                        <span class="label label-danger">Not In Stock!</span>
                        <?php } else { ?>
                        <span class="label label-success">In Stock!</span>
                        <?php }?>
                    </h4>
                    <blockquote>
                        <p><i class="fa fa-quote-left"></i> <?php echo $_smarty_tpl->tpl_vars['product']->value->DescriptionLong;?>
 <i class="fa fa-quote-right"></i></p>
                    </blockquote>
                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['stock']->value;
$_tmp1=ob_get_clean();
if ($_tmp1) {?>
                    <form action="/catalogue/product=<?php echo $_smarty_tpl->tpl_vars['product']->value->Id;?>
" method="post">
                        <input type="hidden" name="item" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->Id;?>
"/>
                        <input type="hidden" name="name" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->Name;?>
"/>
                        <button type="submit" class="btn btn-default addbutton">
                            <span type="submit" class="glyphicon glyphicon-shopping-cart cart"></span>
                            <span class="text" type="submit">Add to cart</span>
                        </button>
                    </form>
                    <?php }?>
                    <div class="addToWishlist">
                        <p>
                        <form action="/catalogue/product=<?php echo $_smarty_tpl->tpl_vars['product']->value->Id;?>
" method="post">
                            <input type="hidden" name="item" value="<?php echo $_smarty_tpl->tpl_vars['row']->value->Id;?>
"/>
                            <?php if (!($_smarty_tpl->tpl_vars['stock']->value)) {?>
                            <span>This <strong><?php echo $_smarty_tpl->tpl_vars['product']->value->Name;?>
</strong> is currently not in stock. Add it to your wishlist instead!</span>
                            <?php } else { ?>
                            <span>Don't want to buy this <strong><?php echo $_smarty_tpl->tpl_vars['product']->value->Name;?>
</strong> yet? Add it to your wishlist!</span>
                            <?php }?>
                            <button type="submit" class="btn btn-warning">
                                <span type="submit" class="glyphicon glyphicon-list-alt"></span>
                                <span class="text" type="submit">Add to wishlist</span>
                            </button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php if ($_smarty_tpl->tpl_vars['added']->value === true) {
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
