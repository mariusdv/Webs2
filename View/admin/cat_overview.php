<div class="container">

    <div class="row flat-header">

        <div class="col-sm-9 col-lg-9">
            <div class="header">Category Overview
            </div>

        </div>
    </div>
    <div class="row flat-lighterblue">
        <br>
        <div class="col-sm-12 col-lg-12">
            <div class="panel-group" id="accordion">
                {foreach from=$categories item=row}
                <div class="panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{$row->FoldId}">{$row->Category[0]}</a>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#{$row->Id}">Rename</span>
                            </button>
                            <form class="form-inline sameline" action="/admin/p=category" method="POST">
                                <input type="hidden" name="action" value="deleteCat">
                                <input type="hidden" name="id" value="{$row->Id}">
                                <input type="submit" class="btn btn-danger btn-xs" value="Delete">

                            </form>
                        </h4>
                    </div>
                    <div id="collapse{$row->FoldId}" class="panel-collapse collapse">
                        <div class="panel-body category">
                            <hr class="small">
                            {foreach from=$row->SubCategories item=subcat}
                            <div>
                            <form class="form-inline sameline" action="/admin/p=category" method="POST">
                                <input type="hidden" name="action" value="renameSubCat">
                                <input type="hidden" name="id" value="{$subcat[2]}">
                                <input name="name" type="text" class="form-control" value="{$subcat[0]}">
                                <input type="submit" class="btn btn-default" value="Save">

                            </form>
                            <form class="form-inline sameline" action="/admin/p=category" method="POST">
                                <input type="hidden" name="action" value="deleteSubCat">
                                <input type="hidden" name="id" value="{$subcat[2]}">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </div>
                        {/foreach}
                        <form class="form-inline" action="/admin/p=category" method="POST">
                            <input type="hidden" name="action" value="newSubCat">
                            <input type="hidden" name="parent" value="{$row->Id}">
                            <input  name="name" type="text" class="form-control">
                            <input class="btn btn-default" type="submit" value="Save New">
                        </form>
                    </div>
                </div>
            </div>
            {/foreach}
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <form class="form-inline" action="/admin/p=category" method="POST">
                            <input type="hidden" name="action" value="newCat">
                            <input name="name" type="text" class="form-control">
                            <input class="btn btn-default " type="submit" value="Save New">
                        </form>
                    </h4>
                </div>
            </div>
        </div>
    </div>

</div>
</div>


{foreach from=$categories item=row}
<div id="{$row->Id}" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Rename</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline sameline" action="/admin/p=category" method="POST">
                    <input type="hidden" name="action" value="renameCat">
                    <input type="hidden" name="id" value="{$row->Id}">
                    <input type="input" name="name" value="{$row->Category[0]}">
                    <input type="submit" class="btn btn-danger" value="Save">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
{/foreach}