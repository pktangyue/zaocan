<?php include_once (APPPATH . 'views/common/header.php'); ?>
<?php if (isset($goods_list) && $goods_list): ?>
<style>
    .input-prepend .input-mini{width:40px;text-align:center;}
    .table td{line-height:28px;}
</style>
<form class="form-horizontal" action="/order" method="post">
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
            <?php foreach ($goods_list as $i => $goods): ?>
            <tr>
                <td><input type="hidden" name="cart[<?php echo $i; ?>][id]" value="<?php echo $goods->id; ?>"><?php echo $goods->name; ?></td>
                <td class="tc">
                    <div class="input-prepend input-append">
                        <span class="add-on"><a class="minus icon-minus" href="javascript:void(0);"></a></span><input type="text" class="input-mini" name="cart[<?php echo $i; ?>][number]" value="<?php echo $goods->number; ?>" /><span class="add-on"><a class="plus icon-plus" href="javascript:void(0);"></a></span>
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
    <div style="margin-bottom:60px;">
        <?php if (isset($address) && $address): ?>
        <input type="hidden" name="aid" value="<?php echo $address->id; ?>" />
        <p><a href="/address" class="pull-right">修改</a>收货地址：</p>
        <p><?php echo $address->one; ?>，<?php echo $address->two; ?>，<?php echo $address->three; ?></p>
        <p>收货人：</p>
        <p><?php echo $address->name; ?></p>
        <p>联系电话：</p>
        <p><?php echo $user_phone; ?></p>
        <?php else: ?>
        <a href="/address" class="btn span6">去设置一个收货地址</a>
        <?php endif; ?>
    </div>
    <div id="J_bottom" class="navbar navbar-fixed-bottom">
        <div class="navbar-inner">
            <div class="container">
                <input type="submit" class="btn pull-right order <?php echo isset($address) && $address ? '':'disabled'; ?>" value="确定" <?php echo isset($address) && $address ? '':'disabled'; ?>/>
            </div>
        </div>
    </div>
</form>
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
        if(Object.keys(cart).length <= 0){
            $('#J_none').show();
            $('form').hide();
        }
    }
    $('.minus,.plus').click(function(){
        var $tr = $(this).closest('tr');
        var $input = $tr.find('input[type="text"]');
        var num = parseInt($input.val());
        var id = $tr.find('input[type="hidden"]').val();
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
        var id = $tr.find('input[type="hidden"]').val();
        delete_goods(id);
        $tr.remove();
        update_total_price();
    });
});
</script>
<?php endif; ?>
<p id="J_none" class="<?php echo isset($goods_list) && $goods_list ? 'hide' : ''; ?>">你还没有选择任何产品，回<a href="/">首页</a>选择产品</p>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
