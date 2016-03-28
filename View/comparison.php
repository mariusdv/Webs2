<div class="container">

    <br>
    <div class="col-sm-12 col-lg-12">
        <table class="table table-hover table-bordered comparison cartTable">
            <thead class="flat-lightblue">
            <tr>
                <th class="small"></th>
                {$count = 0}
                {foreach from=$items item=$product}
                {$count = $count + 1}
                <th><img src="{$product->ImgUrl}" alt="{$product->Name}"/></th>
                {/foreach}
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="flat-lightblue small"><strong>Name</strong></td>
                {foreach from=$items item=$product}
                <td><a href="/catalogue/product={$product->Id}">{$product->Name}</a></td>
                {/foreach}
            </tr>
            <tr>
                <td class="flat-lightblue small"><strong>Description</strong></td>
                {foreach from=$items item=$product}
                <td>{$product->DescriptionShort}</td>
                {/foreach}
            </tr>
            <tr>
                <td class="flat-lightblue small"><strong>Price</strong></td>
                {foreach from=$items item=$product}
                <td>${$product->Price}</td>
                {/foreach}
            </tr>
            <tr>
                <td class="flat-lightblue small"><strong>In Stock</strong></td>
                {foreach from=$items item=$product}
                {if $product->IsInStock()}
                <td class="flat-green">Yes</td>
                {else}
                <td class="flat-red">No</td>
                {/if}
                {/foreach}
            </tr>
            <tr>
                <td class="flat-lightblue small"></td>
                {foreach from=$items item=$product}
                {if $product->IsInStock()}
                <td>
                    <form class="addToCartForm" action="{$link}" method="post">
                        <input type="hidden" name="item" value="{$product->Id}"/>
                        <input type="hidden" name="name" value="{$product->Name}"/>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <span class="text">Add to cart</span>
                        </button>
                    </form>
                </td>
                {else}
                <td>
                    <form action="{$link}" method="post">
                        <input type="hidden" name="itemToAdd" value="{$product->Id}"/>
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-gift"></span>
                            <span class="text">Add to wishlist</span>
                        </button>
                    </form>
                </td>
                {/if}
                {/foreach}
            </tr>
            <tr>
                <td class="flat-lightblue small"></td>
                {$count1 = 0}
                {foreach from=$items item=$product}
                <td>
                    <form action="{$link}" method="POST">
                        <input type="hidden" name="index" value="{$product->Id}"/>
                        <button class="close" type="submit">&times;
                        </button>
                    </form>
                </td>
                {$count1 = $count1 + 1}
                {/foreach}
            </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
{if $added === true}
<script>
    $(document).ready(function () {
        toastr.options = {
            "positionClass": "toast-bottom-right"
        }
        toastr.info("Item has been successfully added to the cart!", "Pokemart");
    });
</script>
{/if}
