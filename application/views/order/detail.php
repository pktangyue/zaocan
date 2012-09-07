<?php include_once (APPPATH . 'views/common/header.php'); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>名称</th>
            <th class="tc">数量</th>
            <th>小计</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders_detail as $i => $goods): ?>
        <tr>
            <td><?php echo $goods->name; ?></td>
            <td class="tc"><?php echo $goods->number; ?></td>
            <td>￥<span class="price"><?php echo $goods->number * $goods->price; ?></span></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="tr">合计：￥<?php echo $total_price; ?></th>
        </tr>
    </tfoot>
</table>
<div style="margin-bottom:60px;">
    <?php if (isset($address) && $address): ?>
    <p>收货地址：</p>
    <p><?php echo $address->one; ?>，<?php echo $address->two; ?>，<?php echo $address->three; ?></p>
    <p>收货人：</p>
    <p><?php echo $address->name; ?></p>
    <p>联系电话：</p>
    <p><?php echo $user_phone; ?></p>
    <?php else: ?>
    <p>无收货地址</p>
    <?php endif; ?>
</div>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
