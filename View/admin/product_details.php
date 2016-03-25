<div class="container">

    <div class="row flat-header">
        <div class="">
            {if isset($product)}
            <div class="header">&nbsp;{$product->Name}
            <span class="titanic-1911"><a class="btn btn-danger" href="/admin/p=newp/remove={$product->Id}">Remove product</a>&nbsp;</span></div>
            {else}
            <div class="header">&nbsp;New Product</div>
            {/if}
        </div>
        <div class="col-sm-9 col-lg-9">
            <div class="header">{$title}</div>
        </div>
    </div>
    <div class="row flat-lighterblue">
        <br>


        <div class="col-md-9 col-md-offset-1">
            <form enctype="multipart/form-data" action="/admin/p=newp" method="POST">
                <input name="Id" type="hidden" value="{$product->Id}"/>
                {if isset($product)}
                <div class="thumbnail clean">
                    <img class="img-responsive" src="{$product->ImgUrl}" alt="">
                </div>
                <br><br>
                {/if}
                <fieldset class="form-group">
                    <label class="control-label">Select Image(JPG/PNG)</label>
                    <input class="form-control" name="image" type="file"/>
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input name="Name" class="descriptionShort form-control" type="text" value="{$product->Name}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Price</label>
                    <input name="Price" class="descriptionShort form-control" type="text" value="{$product->Price}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Short Description</label>
                    <input name="DescriptionShort" type="text" class="descriptionShort form-control" value="{$product->DescriptionShort}">
                </fieldset>
                <fieldset class="form-group">
                    <label for="exampleInputEmail1">Long Description</label>
                    <textarea name="DescriptionLong" class="descriptionArea">{$product->DescriptionLong}</textarea>
                </fieldset>
                <fieldset class="form-group">
                    <fieldset class="form-group">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control" name="SubcategoryId">
                            {foreach from=$categories item=row}
                                <option value="" disabled>{$row->Category[0]}</option>
                                {foreach from=$row->SubCategories item=subcat}
                                {if $subcat[2] == {$product->SubcategoryId}}
                                    <option selected value="{$subcat[2]}">&nbsp;&nbsp;&nbsp;&nbsp;{$subcat[0]}</option>
                                {else}
                                    <option value="{$subcat[2]}">&nbsp;&nbsp;&nbsp;&nbsp;{$subcat[0]}</option>
                            {/if}
                                {/foreach}
                            {/foreach}

                        </select>

                    </fieldset>
                </fieldset>
                <input type="submit" value="Save Product" />
            </form>
    <br><br>
        </div>

    </div>
</div>