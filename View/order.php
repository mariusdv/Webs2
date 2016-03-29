<div class="container">
    <div class="col-sm-12">
        <h2>Order</h2>
        <form method="post" action="action=submit">
            <div class="col-sm-12">
                <table class="table table-bordered table-striped table-condensed cartTable bigCart">
                    <tr>
                        <td></td>
                        <td>Name</td>
                        <td>Amount</td>
                        <td>Price</td>
                    </tr>
                    {if isset($title)}
                    {foreach from=$cart item=row}
                    <tr>
                        <td><img src="{$row->Product->ImgUrl}" alt="{$row->Product->Name}"/></td>
                        <td>{$row->Product->Name}</td>
                        <td>
                            {$row->Quantity}
                        </td>
                        <td>{$row->Product->Price}</td>
                    </tr>
                    {/foreach}

                    {/if}
                    {if isset($totalPrice)}
                    <tr>
                        <td colspan="3"> Total:</td>
                        <td>{$totalPrice}</td>
                    </tr>
                    {/if}
                </table>
            </div>
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-heading">Delivery Address</div>
                    <div class="panel-body">
                        <select name="delivery" class="form-control">
                            {foreach from=$user->addresses item=add}
                            <option value="{$add['Id']}">{$add['Address']}, {$add['City']}, {$add['Province']},
                                {$add['Country']}
                            </option>
                            {/foreach}
                        </select>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment Address</div>
                    <div class="panel-body">
                        <select name="payment" class="form-control">
                            {foreach from=$user->getAddresses($user->email) item=add}
                            <option value="{$add['Id']}">{$add['Address']}, {$add['City']}, {$add['Province']},
                                {$add['Country']}
                            </option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary  toast-bottom-center" value="Order">

        </form>
    </div>
</div>
