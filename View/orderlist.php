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
                        <li class="active">
                            <a href="/account/tab=orders">
                                <i class="glyphicon glyphicon-shopping-cart"></i>
                                Orders </a>
                        </li>
                        <li>
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
                        <h3 class="panel-title">Order Information</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            {if !Empty($orders)}
                            {foreach from=$orders item=order}
                            <div class=" col-md-12 col-lg-12 ">
                                <div class="panel-group">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h4 class="panel-title address">
                                                <a data-toggle="collapse"
                                                   href="#collapse{$order['index']}" style="color: white;"><i
                                                        class="glyphicon glyphicon-ok"></i> Order
                                                    {$order['index']}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse{$order['index']}" class="panel-collapse collapse">
                                            <ul class="list-group">
                                                <table class="table table-user-information cartTable orderinfo">
                                                    <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>Product</strong></td>
                                                        <td><strong>Quantity</strong></td>
                                                        <td><strong>Price</strong></td>
                                                        <td><strong>Total</strong></td>
                                                    </tr>
                                                    {foreach from=$order[0] item=product}
                                                    <tr>
                                                        <td><img src="{$product['ImgUrl']}" alt="{$product['name']}">
                                                        </td>
                                                        <td><a href="/catalogue/product={$product['id']}">{$product['name']}</a>
                                                        </td>
                                                        <td>{$product['count']}</td>
                                                        <td>${$product['price']}</td>
                                                        <td>${$product['total']}</td>
                                                    </tr>
                                                    {/foreach}
                                                    </tbody>
                                                    <td><strong>Total Price:</strong></td>
                                                    <td><strong>${$order['totalPrice']}</strong></td>

                                                </table>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {/foreach}
                            {else}
                            <div class=" col-md-12 col-lg-12 ">
                                <h4>No orders found</h4>
                            </div>
                            {/if}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>