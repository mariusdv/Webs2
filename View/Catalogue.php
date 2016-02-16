<div class="container" xmlns="http://www.w3.org/1999/html">

    <div class="row">

        <div class="col-sm-3 col-lg-3">
            <p class="lead"><strong>Categories</strong></p>
            <div class="list-group">
                <a href="#" class="list-group-item">Pokeballs</a>
                <a href="#" class="list-group-item">Move Machines</a>
                <a href="#" class="list-group-item">Held Items</a>
            </div>
        </div>

        <div class="col-sm-9 col-lg-9">

            <div class="row">
                <div class="header">{$title}</div>

                {foreach from=$rows item=row}
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img src="{$row->ImgUrl}" alt="{$row->Name}">
                        <div class="caption">
                            <h4 class="pull-right">${$row->Price}</h4>
                            <h4><a href="#">{$row->Name}</a>
                            </h4>
                            <p>{$row->DescriptionShort}</p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">48 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </p>
                        </div>
                        <form action="/Catalogue" method="post">
                            <input type="hidden" name="item" value="{$row->Id}"/>
                            <button type="submit" class="btn btn-default addbutton">
                                    <span type="submit" class="glyphicon glyphicon-shopping-cart cart"></span>
                                    <span class="text" type="submit" >Add to cart</span>
                            </button>
                        </form>
                    </div>
                </div>
                {/foreach}
            </div>

        </div>

    </div>

</div>