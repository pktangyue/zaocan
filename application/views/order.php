<?php include_once (APPPATH . 'views/common/header.php'); ?>
<style>
    .table td{cursor:pointer;}
</style>
<table class="table table-striped">
    <thead>
        <tr>
            <th>待签收</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($waiting_orders) && $waiting_orders): ?>
        <?php foreach ($waiting_orders as $orders): ?>
        <tr>
            <td data-id="<?php echo $orders->id; ?>">
                <div>下单时间：<?php echo $orders->create_time; ?></div>
                <div>
                    订单号：<?php echo sprintf('%03d', $orders->id); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ￥<?php echo $orders->total_price; ?>
                    <span class="pull-right" >预计8:30分送达 &gt; </span>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td>还没有待签收的订单</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<table class="table table-striped">
    <thead>
        <tr>
            <th>已签收</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($completed_orders) && $completed_orders): ?>
        <?php foreach ($completed_orders as $orders): ?>
        <tr>
            <td data-id="<?php echo $orders->id; ?>">
                <div>下单时间：<?php echo $orders->create_time; ?></div>
                <div>
                    订单号：<?php echo sprintf('%03d', $orders->id); ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    ￥<?php echo $orders->total_price; ?>
                    <span class="pull-right" >已送达 &gt; </span>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td>还没有已签收的订单</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<script>
$(function(){
    $('td').click(function(){
        var id = $(this).data('id');
        if(id){
            document.location.href = '/order/detail/'+id;
        }
    });
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
