<div class="container">

    <div class="row flat-header">

        <div class="col-sm-9 col-lg-9">
            <div class="header">Order Overview
            </div>

        </div>
    </div>
    <div class="row">
        <br>
        <div class="col-sm-12 col-lg-12">
            <div class="profile-content">
                <div class="panel">
                    <div class="panel-heading flat-lightblue">
                        <h3 class="panel-title">Order Information</h3>
                    </div>
                    <div class="row">
                        {if !Empty($orders)}
                        <br>
                        {foreach from=$orders item=order}
                        <div class=" col-md-12 col-lg-12 ">
                            <div class="panel-group">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title address">
                                            <a data-toggle="collapse"
                                               href="#collapse{$order['id']}" style="color: white;"><i
                                                    class="glyphicon glyphicon-ok"></i> Order
                                                {$order['id']} - {$order['user']} </a>
                                            <a class="btn btn-danger white" href="/admin/p=orders/remove={$order['id']}">Delete</a>
                                        </h4>
                                    </div>
                                    <div id="collapse{$order['id']}" class="panel-collapse collapse">
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
                                                    <td>
                                                        <a href="/admin/p=cat/product={$product['id']}">{$product['name']}</a>
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

