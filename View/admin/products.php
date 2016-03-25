<div class="container">

    <div class="row flat-header">
        <div class="col-sm-3 col-lg-3 ">
            <div class="header">Categories</div>
        </div>
        <div class="col-sm-9 col-lg-9">
            <div class="header">{$title}
                <span class="titanic-1911"><a class="btn btn-default" href="/admin/p=newp">New product</a>&nbsp;</span></div>

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
                            <a href="/admin/p=cat/cat={$row->Category[1]}">
                                <div class="subcategory all">
                                    All
                                </div>
                            </a>
                            <hr class="small">
                            {foreach from=$row->SubCategories item=subcat}
                            <a href="/admin/p=cat/subcat={$subcat[1]}">
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
                                <h4><a href="/admin/p=cat/product={$row->Id}">{$row->Name}</a>
                                </h4>
                                <p>{$row->DescriptionShort}</p>
                            </div>
                            <a href="/admin/p=cat/product={$row->Id}" class="btn btn-default addbutton flat-button flat-lightblue">Edit</a>
                        </div>
                    </div>
                </div>
                {/foreach}
                {/if}
            </div>
        </div>
    </div>
</div>

