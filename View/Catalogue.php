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

        <div class="col-sm-9 col-lg-9">

            <div class="row">
                <div class="header col-sm-12 col-lg-12">{$title}</div>

                {if !isset($rows)}
                No items found.
                {else}
                {foreach from=$rows item=row}
                <div class="col-xs-12 col-sm-12 col-lg-4 col-md-6">
                    <div class="thumbnail">
                        <img src="{$row->ImgUrl}" alt="{$row->Name}">
                        <div class="caption">
                            <h4 class="pull-right">${$row->Price}</h4>
                            <h4><a href="/catalogue/product={$row->Id}">{$row->Name}</a>
                            </h4>
                            <p>{$row->DescriptionShort}</p>
                        </div>
                        <form action="/Catalogue/cat={$cat}" method="post">
                            <input type="hidden" name="item" value="{$row->Id}"/>
                            <button type="submit" class="btn btn-default addbutton">
                                <span type="submit" class="glyphicon glyphicon-shopping-cart cart"></span>
                                <span class="text" type="submit">Add to cart</span>
                            </button>
                        </form>
                    </div>
                </div>
                {/foreach}
                {/if}
            </div>

        </div>

    </div>

</div>