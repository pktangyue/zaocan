<?php include_once (APPPATH . 'views/common/header.php'); ?>
<style>
    .control-group{float:left;margin-left:10px;}
    .control-group:first-child{margin-left:0px;}
    .form-horizontal .control-label{width:100px;}
    .form-horizontal .controls{margin-left:120px;}
</style>
<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#list" data-toggle="pill">套餐列表</a></li>
        <li><a href="#add" data-toggle="pill">添加套餐</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="list">
            <div class="accordion" id="accordion">
                <?php $i = 0;?>
                <?php foreach ($sets_list as $set): ?>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo ++$i;?>">
                            <?php echo $set->name;?>
                        </a>
                    </div>
                    <div id="collapse<?php echo $i;?>" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <div class="btn-toolbar">
                                <?php foreach ($set->goods_list as $goods): ?>
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle <?php echo $goods->number?'btn-success':'';?>"
                                        data-toggle="dropdown"
                                        data-id="<?php echo $goods->id; ?>"
                                        data-num="<?php echo $goods->number;?>" >
                                        <?php echo $goods->name; ?>
                                        <?php if($goods->number):?>
                                        <span class="num"> x <?php echo $goods->number;?></span>
                                        <?php else: ?>
                                        <span class="num"></span>
                                        <?php endif;?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);">1</a></li>
                                        <li><a href="javascript:void(0);">2</a></li>
                                        <li><a href="javascript:void(0);">3</a></li>
                                        <li class="divider"></li>
                                        <li><a href="javascript:void(0);" class="remove">去除</a></li>
                                    </ul>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        <div class="tab-pane" id="add">
            <form class="form-horizontal" action="/admin/goodsset/add">
                <div class="control-group">
                    <label class="control-label">套餐名称：</label>
                    <div class="controls">
                        <input class="input-small" type="text" name="name" placeholder="套餐名称"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">套餐价格：</label>
                    <div class="controls">
                        <input class="input-small" type="number" name="price" placeholder="套餐价格"/>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="btn-toolbar">
                    <?php foreach ($goods_list as $item): ?>
                    <div class="btn-group">
                        <button class="btn dropdown-toggle" data-toggle="dropdown" data-id="<?php echo $item->id; ?>">
                            <?php echo $item->name; ?>
                            <span class="num"></span>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0);">1</a></li>
                            <li><a href="javascript:void(0);">2</a></li>
                            <li><a href="javascript:void(0);">3</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0);" class="remove">去除</a></li>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
                <p style="text-align:center;margin-top:20px;">
                <a id="J_ok" href="javascript:void(0);" class="btn btn-primary"><i class="icon-ok icon-white"></i> 确定</a>
                <a id="J_reset" href="javascript:void(0);" class="btn btn-inverse"><i class="icon-remove icon-white"></i> 重置</a>
                </p>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    $('.control-group').find('input').blur(function(){
        var $this= $(this);
        if (!$this.val()){
            $this.parents('.control-group').addClass('error');
        }
    }).focus(function(){
        $(this).parents('.control-group').removeClass('error');
    });
    $('.btn-group').on('click',function(e){
        if(e.target.tagName !== 'A'){
            return;
        }
        var $this = $(this);
        var $button = $this.find('button');
        if(e.target.className === 'remove'){
            $button.data('num','').removeClass('btn-success');
            $this.find('span.num').html('');
        }else{
            var num = $(e.target).html();
            $button.data('num',num).addClass('btn-success');
            $this.find('span.num').html(' x ' + num);
        }
    });
    var add = function(){
        var $add = $('#add');
        $('#J_ok').on('click',function(e){
            var list = [];
            var name = $add.find('input[name="name"]').blur().val();
            var price = $add.find('input[name="price"]').blur().val();
            if (!name || !price){
                return;
            }
            $add.find('button').each(function(){
                var $this = $(this);
                var id = $this.data('id');
                var num = $this.data('num');
                if ( ! num ){
                    return;
                }
                list.push({ id  : id, num : num });
            });
            var param = $.param({
                name  : name,
                price : price,
                list  : list
            });
            document.location.href = '/admin/goodsset/add?' + param;
        });
        $('#J_reset').on('click',function(e){
            $add.find('button').data('num','').removeClass('btn-success');
            $add.find('span.num').html('');
            $add.find('input[name="name"],input[name="price"]').val('');
        });
    }();
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
