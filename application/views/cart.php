<?php include_once (APPPATH . 'views/common/header.php'); ?>
<style>
    .input-prepend .input-mini{width:40px;text-align:center;}
    .table td{line-height:28px;}
</style>
<?php if (isset($goods_list) && $goods_list): ?>
<form class="form-horizontal">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>名称</th>
                <th class="tc">数量</th>
                <th>小计</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($goods_list as $goods): ?>
            <tr data-id="<?php echo $goods->id; ?>">
                <td><?php echo $goods->name; ?></td>
                <td class="tc">
                    <div class="input-prepend input-append">
                        <span class="add-on"><a class="minus icon-minus" href="javascript:void(0);"></a></span><input type="text" class="input-mini" name="number" value="<?php echo $goods->number; ?>" /><span class="add-on"><a class="plus icon-plus" href="javascript:void(0);"></a></span>
                    </div>
                </td>
                <td>￥<span class="price"><?php echo $goods->number * $goods->price; ?></span></td>
                <td><a href="javascript:void(0);" class="delete">删除</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="tr">合计：￥<span id="J_total"><?php echo $total_price; ?></span></th>
            </tr>
        </tfoot>
    </table>
</form>
<?php if (isset($address) && $address): ?>
<?php else: ?>
<a href="" class="btn span6">去设置一个收货地址</a>
<?php endif; ?>
<script>
$(function(){
    var cart = {};
    var $J_total = $('#J_total');

    <?php foreach ($goods_list as $goods): ?>
    cart[<?php echo $goods->id; ?>] = {number : <?php echo $goods->number; ?>, price : <?php echo $goods->price; ?>};
    <?php endforeach; ?>

    function update_cart( id , number ){
        cart[id]['number'] = number;
    }
    function update_total_price(){
        var total_price = 0;
        $.each(cart, function(key,value){
            total_price += value.number * value.price;
        });
        $J_total.html(total_price);
    }
    function delete_goods( id ){
        delete cart[id];
    }
    $('.minus,.plus').click(function(){
        var $tr = $(this).closest('tr');
        var $input = $tr.find('input');
        var num = parseInt($input.val());
        var id = $tr.data('id');
        $(this).hasClass('plus') ? num ++ : num -- ;
        if(num < 0) {
            return;
        } else if( num === 0){
            $tr.find('.delete').click();
            return;
        }
        update_cart( id , num );
        $input.val( num );
        $tr.find('.price').html(cart[id].number * cart[id].price);
        update_total_price();
    });
    $('.delete').click(function(){
        if(!confirm('确定删除此商品？')){
            return false;
        }
        var $tr = $(this).closest('tr');
        var id = $tr.data('id');
        delete_goods(id);
        $tr.remove();
        update_total_price();
    });
});
</script>
<?php else: ?>
<p>你还没有选择任何产品，回<a href="/">首页</a>选择产品</p>
<?php endif; ?>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
