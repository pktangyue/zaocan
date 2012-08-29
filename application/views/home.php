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
            <form action="/cart" method="post">
                <table width="100%">
                    <tr>
                        <td id="J_name"></td>
                        <td width="120px"><span id="J_count">0</span>份总计：￥<span id="J_sum">0</span></td>
                        <td width="75px">
                            <input id="J_order" type="submit" class="btn pull-right order" value="下订单"/>
                            <input id="J_ids" type="hidden" name="ids" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    var orders = [];
    var $J_bottom = $('#J_bottom');
    var $J_name = $('#J_name');
    var $J_count = $('#J_count');
    var $J_sum = $('#J_sum');
    var $J_ids = $('#J_ids');
    $('table.goods').on('click','.btn',function(){
        var $this = $(this);
        orders.push({
            id : $this.data('id'),
            name : $this.data('name'),
            price : $this.data('price')
        });
        update_bar();
    });
    function update_bar(){
        if( orders.length > 0){
            $J_bottom.removeClass('hide').prev().css('margin-bottom',$J_bottom.height() + 10);
        }
        var names = [],count = 0,price = 0,ids=[];
        $.each(orders,function(i,v){
            names.push(v.name);
            ids.push(v.id);
            count ++;
            price += v.price;
        });
        $J_name.html(names.join('/'));
        $J_count.html(count);
        $J_sum.html(price);
        $J_ids.val(ids.join(';'));
    };
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
