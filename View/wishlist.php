<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {$user->name}
                    </div>
                    <div class="profile-usertitle-job">
                        {$user->email}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="/account">
                                <i class="glyphicon glyphicon-user"></i>
                                Overview </a>
                        </li>
                        <li>
                            <a href="/account/tab=addresses">
                                <i class="glyphicon glyphicon-tags"></i>
                                Address Management </a>
                        </li>
                        <li>
                            <a href="/account/tab=orders">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                Orders </a>
                        </li>
                        <li class="active">
                            <a href="/account/tab=wishlist">
                                <i class="glyphicon glyphicon-gift"></i>
                                Wishlist </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <div class="panel">
                    <div class="panel-heading flat-lightblue">
                        <h3 class="panel-title">Wishlist</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class=" col-md-12 col-lg-12 ">
                                <table class="table table-user-information cartTable">
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td>Product</td>
                                        <td>Price</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    {foreach from=$products item=product}
                                    <tr>
                                        <td><img src="{$product->ImgUrl}"></td>
                                        <td><a href="/catalogue/product={$product->Id}">{$product->Name}</a></td>
                                        <td>{$product->Price}</td>
                                        <td>
                                            <form action="/catalogue/product={$product->Id}" method="post">
                                                <input type="hidden" name="item" value="{$product->Id}"/>
                                                <input type="hidden" name="name" value="{$product->Name}"/>
                                                <button type="submit" class="btn btn-default">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                                    <span class="text">Add to cart</span>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="/account/tab=wishlist" name="form" id="form"
                                                  class="form-horizontal"
                                                  enctype="multipart/form-data"
                                                  method="POST"><input type="hidden" name="productId"
                                                                       value="{$product->Id}"/>
                                                <button class="close" type="submit">&times;
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    {/foreach}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>