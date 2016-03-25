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

        <div class="col-md-9">
            <form enctype="multipart/form-data" action="/admin/p=newp" method="POST">
                <div class="thumbnail clean">
                    <img class="img-responsive" src="{$product->ImgUrl}" alt="">
                    <label class="control-label">Select Image(JPG/PNG)</label>
                    <input name="userfile" type="file"/>
                </div>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input class="descriptionShort form-control" type="text" value="{$product->Name}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input class="descriptionShort form-control" type="text" value="{$product->Price}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Short Description</label>
                    <input type="text" class="descriptionShort form-control" value="{$product->DescriptionShort}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Long Description</label>
                    <textarea class="descriptionArea">{$product->DescriptionLong}</textarea>
                </fieldset>
                <input type="submit" value="Save Product" />
            </form>
    <br><br>
        </div>

    </div>
</div>