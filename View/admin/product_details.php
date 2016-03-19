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
            PRODUCT DETAILS

        </div>

    </div>

</div>
<!-- /.container -->