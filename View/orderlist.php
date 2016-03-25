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
                                        <div class="panel-heading flat-blue">
                                            <h4 class="panel-title address">
                                                <a data-toggle="collapse"
                                                   href="#collapse{$order['index']}" style="color: white;"><i
                                                        class="glyphicon glyphicon-plus"></i> Order {$order['index']}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse{$order['index']}" class="panel-collapse collapse">
                                            <ul class="list-group">
                                                <table class="table table-user-information orderinfo">
                                                    <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td><strong>Product</strong></td>
                                                        <td><strong>Quantity</strong></td>
                                                        <td><strong>Price</strong></td>

                                                    </tr>
                                                    {foreach from=$order item=product}
                                                    <tr>
                                                        <td></td>
                                                        <td>{$product[0]['name']}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    {/foreach}
                                                    </tbody>
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