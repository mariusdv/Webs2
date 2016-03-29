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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{$row->FoldId}">{$row->Category[0]}</a>
                        </h4>
                    </div>
                    <div id="collapse{$row->FoldId}" class="panel-collapse collapse">
                        <div class="panel-body category">
                            <a href="/catalogue/cat={$row->Category[1]}">
                                <div class="subcategory all">
                                    All
                                </div>
                            </a>
                            <hr class="small">
                            {foreach from=$row->SubCategories item=subcat}
                            <a href="/catalogue/subcat={$subcat[1]}">
                                <div class="subcategory">
                                    {$subcat[0]}
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
                <div class="compare">
                    <form action="/catalogue/product={$product->Id}" method="post">
                        <input type="hidden" name="comparisonId" value="{$product->Id}"/>

                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon"></span>
                            <span class="text">Compare</span>
                        </button>
                    </form>
                    <br>
                </div>
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
                        <p><i class="fa fa-quote-left"></i> {$product->DescriptionLong} <i
                                class="fa fa-quote-right"></i></p>
                    </blockquote>
                    {if {$stock}}
                    <form action="/catalogue/product={$product->Id}" method="post">
                        <input type="hidden" name="item" value="{$product->Id}"/>
                        <input type="hidden" name="name" value="{$product->Name}"/>
                        <button type="submit" class="btn btn-default flat-lightblue addbutton">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <span class="text">Add to cart</span>
                        </button>
                    </form>
                    {/if}
                    {if !$product->IsPartOfWishlist()}
                    <div class="addToWishlist">
                        <form action="/catalogue/product={$product->Id}" method="post">
                            <input type="hidden" name="id" value="{$product->Id}"/>
                            {if !($stock)}
                            <span>This <strong>{$product->Name}</strong> is currently not in stock. Add it to your wishlist instead!</span>
                            {else}
                            <span>Don't want to buy this <strong>{$product->Name}</strong> yet? Add it to your wishlist!</span>
                            {/if}
                            <button type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-gift"></span>
                                <span class="text">Add to wishlist</span>
                            </button>
                        </form>
                        <br>
                    </div>
                    {else}

                        <div class="addToWishlist">
                            <h5 style="color: green;">Item is already part of your wishlist!</h5>
                        </div>

                    {/if}

                </div>
            </div>

        </div>
    </div>
</div>
{if $added === true}
<script>
    $(document).ready(function () {
        toastr.options = {
            "positionClass": "toast-bottom-right"
        }
        toastr.info("Item has been successfully added to the cart!", "Pokemart");
    });
</script>
{/if}
