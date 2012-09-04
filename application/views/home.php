<?php include_once (APPPATH . 'views/common/header.php'); ?>
<p>无需排队，熟悉的味道到你手。</p>
<p>此次早餐将于明日8：00送出。</p>
<?php foreach ($list as $goods): ?>
<table class="goods table table-bordered">
    <tbody>
        <tr>
            <td colspan="3">
                <strong class="name"><?php echo $goods->name; ?></strong>
                <?php if ($goods->is_set && isset($goods->details)): ?>
                <ul>
                    <?php foreach ($goods->details as $detail): ?>
                    <li><?php echo $detail->name; ?> X <?php echo $detail->number; ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td>
                <div class="price">￥<?php echo $goods->price; ?></div>
                <div><?php if ($goods->is_set): ?>套餐价格<?php else: ?>价格<?php endif; ?></div>
            </td>
            <td>
                <div class="num">200</div>
                <div>本周销量</div>
            </td>
            <td>
                <a  data-id="<?php echo $goods->id; ?>"
                    data-name="<?php echo $goods->name; ?>"
                    data-price="<?php echo $goods->price; ?>"
                    href="javascript:void(0);" class="btn" >购买</a>
            </td>
        </tr>
    </tbody>
</table>
<?php endforeach; ?>
<div id="J_bottom" class="navbar navbar-fixed-bottom hide">
    <div class="navbar-inner">
        <div class="container">
            <table width="100%">
                <tr>
                    <td id="J_name"></td>
                    <td width="120px"><span id="J_count">0</span>份总计：￥<span id="J_sum">0</span></td>
                    <td width="75px">
                        <a href="/cart" class="btn pull-right order">下订单</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
$(function(){
    var orders = {};
    var $J_bottom = $('#J_bottom');
    var $J_name = $('#J_name');
    var $J_count = $('#J_count');
    var $J_sum = $('#J_sum');

    <?php if (isset($cart_list) && $cart_list): ?>
    <?php foreach ($cart_list as $goods): ?>
    orders[<?php echo $goods->id; ?>] = {name : '<?php echo $goods->name; ?>', number : <?php echo $goods->number; ?>, price : <?php echo $goods->price; ?>};
    <?php endforeach; ?>
    update_bar();
    <?php endif; ?>

    $('table.goods').on('click','.btn',function(){
        var $this = $(this);
        var id = $this.data('id');
        if( !orders[id] ){
            orders[id] = {
                name : $this.data('name'),
                price : $this.data('price'),
                number : 1
            };
        }
        else{
            orders[id]['number'] ++;
        }
        update_bar();
    });
    function update_bar(){
        if( Object.keys(orders).length > 0){
            $J_bottom.removeClass('hide').prev().css('margin-bottom',$J_bottom.height() + 10);
        }
        var names = [],count = 0,price = 0,cart=[];
        $.each(orders,function(key,value){
            names.push(value.name + (value.number > 1 ? ' *' + value.number : '' ));
            count += value.number;
            price += value.price * value.number;
            cart.push(key + ':' + value.number);
        });
        $J_name.html(names.join('/'));
        $J_count.html(count);
        $J_sum.html(price);
        $.post('/cart/save',{ cart : cart.join(';') },function(result){
            result ?  alert(result) : '';
        });
    };
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
