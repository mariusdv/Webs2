<div class="container">

    <div class="header">{$title}</div>
    <form name="cart" action="/Order" method="post">
        <table class="table table-bordered table-striped table-condensed cartTable bigCart">
            <tr>
                <td></td>
                <td>Name</td>
                <td>Amount</td>
                <td>Price</td>
                <td></td>
            </tr>
            {if isset($title)}
            {foreach from=$cart item=row}
            <tr>
                <td><img src="{$row->Product->ImgUrl}" alt="{$row->Product->Name}"/></td>
                <td>{$row->Product->Name}</td>
                <td>
                    <button class="btn btn-default"><span class="glyphicon glyphicon-refresh"/></button>
                    <input name="{$row->Product->Id}" class="smallInput" type="number" min="0" value="{$row->Quantity}"></td>
                <td>{$row->Product->Price}</td>
                <td>
                    <button onclick="removeItem({$row->Product->Id})" class="btn btn-default">Remove</button>
                </td>
            </tr>
            {/foreach}

            {/if}
            {if isset($totalPrice)}
            <tr>
                <td colspan="4"> Total:</td>
                <td>{$totalPrice}</td>
            </tr>
            {/if}
        </table>
    </form>

        <a href="/Order/action=order" class="btn btn-primary">Order</a>

</div>

<script>

    function removeItem($var)
    {
        document.getElementsByName($var)[0].value = 0;
    }
</script>

