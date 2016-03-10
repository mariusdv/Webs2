<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-sm-3 col-lg-3">
            <div class="header">Categories</div>
            <div class="panel-group" id="accordion">
                {foreach from=$categories item=row}
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{$row->Id}">{$row->Category}</a>
                        </h4>
                    </div>
                    <div id="collapse{$row->Id}" class="panel-collapse collapse">
                        <div class="panel-body category">
                            <a href="/catalogue/cat=#">
                                <div class="subcategory">
                                    All
                                </div>
                            </a>
                            <hr class="small">
                            {foreach from=$row->SubCategories item=subcat}
                            <a href="/catalogue/cat={$subcat}">
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

            <div class="thumbnail">
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
                    <p>{$product->DescriptionLong}</p>
                    {if {$stock}}
                    <form action="/Catalogue/product={$row->Id}" method="post">
                        <input type="hidden" name="item" value="{$row->Id}"/>
                        <button type="submit" class="btn btn-default addbutton">
                            <span type="submit" class="glyphicon glyphicon-shopping-cart cart"></span>
                            <span class="text" type="submit">Add to cart</span>
                        </button>
                    </form>
                    {/if}
                    <div class="addToWishlist">
                        <p>
                        <form action="/Catalogue/product={$row->Id}" method="post">
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
<!-- /.container -->