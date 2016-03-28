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

        <div class="col-sm-9 col-lg-9">

            <div class="row">

                {if !isset($rows)}
                No items found.
                {else}
                {foreach from=$rows item=row}
                <div class="col-xs-12 col-sm-12 col-lg-4 col-md-6" id="item{$row->Id}">
                    <div class="thumbnail">
                        <div class="imageWrapper">
                            <img src="{$row->ImgUrl}" alt="{$row->Name}">
                        </div>
                        <div class="info">
                            <div class="caption flat-caption">
                                <h4 class="pull-right">${$row->Price}</h4>
                                <h4><a href="/catalogue/product={$row->Id}">{$row->Name}</a>
                                </h4>
                                <p>{$row->DescriptionShort}</p>
                            </div>
                            <form class="addToCartForm" action="#item{$row->Id}" method="post">
                                <input type="hidden" name="item" value="{$row->Id}"/>
                                <input type="hidden" name="name" value="{$row->Name}"/>
                                <button type="submit" class="btn btn-default addbutton flat-button flat-lightblue">
                                    <span class="glyphicon glyphicon-shopping-cart cart"></span>
                                    <span class="text">Add to cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {/foreach}
                {/if}
            </div>
        </div>
    </div>
</div>
{if !empty($added)}
<script>
    $( document ).ready(function() {
        toastr.options = {
            "positionClass": "toast-bottom-right"
        }
        toastr.info("Item has been successfully added to the cart!", "Pokemart");
    });
</script>
{/if}