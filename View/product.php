<div class="container">

    <div class="row flat-header">
        <div class="col-sm-3 col-lg-3 ">
            <div class="header">Categories</div>
        </div>
        <div class="col-sm-9 col-lg-9">
            <div class="header">{$title}</div>
        </div>
    </div>
    <div class="row flat-lighterblue">
        <br>
        <div class="col-sm-3 col-lg-3">
            <div class="panel-group" id="accordion">
                {foreach from=$categories item=row}
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{$row->FoldId}">{$row->Category}</a>
                        </h4>
                    </div>
                    <div id="collapse{$row->FoldId}" class="panel-collapse collapse">
                        <div class="panel-body category">
                            <a href="/catalogue/cat={$row->Category}">
                                <div class="subcategory">
                                    All
                                </div>
                            </a>
                            <hr class="small">
                            {foreach from=$row->SubCategories item=subcat}
                            <a href="/catalogue/subcat={$subcat}">
                                <div class="subcategory">
                                    {$subcat}
                                </div>
                            </a>
                            {/foreach}
                        </div>
                    </div>
                </div>
                {/foreach}

            </div>
        </div>

        <div class="col-md-9">

            <div class="thumbnail clean">
                <img class="img-responsive" src="{$product->ImgUrl}" alt="">
                <div class="caption-full">
                    <h4 class="pull-right">${$product->Price}</h4>
                    <h4><a>{$product->Name}</a>
                        {if !($stock)}
                        <span class="label label-danger">Not In Stock!</span>
                        {else}
                        <span class="label label-success">In Stock!</span>
                        {/if}
                    </h4>
                    <blockquote>
                        <p><i class="fa fa-quote-left"></i> {$product->DescriptionLong} <i class="fa fa-quote-right"></i></p>
                    </blockquote>
                    {if {$stock}}
                    <form action="/catalogue/product={$product->Id}" method="post">
                        <input type="hidden" name="item" value="{$row->Id}"/>
                        <button type="submit" class="btn btn-default addbutton">
                            <span type="submit" class="glyphicon glyphicon-shopping-cart cart"></span>
                            <span class="text" type="submit">Add to cart</span>
                        </button>
                    </form>
                    {/if}
                    <div class="addToWishlist">
                        <p>
                        <form action="/catalogue/product={$product->Id}" method="post">
                            <input type="hidden" name="item" value="{$row->Id}"/>
                            {if !($stock)}
                            <span>This <strong>{$product->Name}</strong> is currently not in stock. Add it to your wishlist instead!</span>
                            {else}
                            <span>Don't want to buy this <strong>{$product->Name}</strong> yet? Add it to your wishlist!</span>
                            {/if}
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
<script>
    $(document).ready(function () {
        toastr.options = {
            "positionClass": "toast-bottom-right"
        }
        toastr.info("Item has been successfully added to the cart!", "Pokemart");
    });
</script>

