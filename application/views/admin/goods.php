<?php include_once (APPPATH . 'views/common/header.php'); ?>
<style>
    .disappear{display:none;}
</style>
<?php if (($error)): ?>
<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><span><?php echo $error; ?></span></div>
<?php endif; ?>
<div class="tabbable">
    <ul class="nav nav-pills">
        <li class="active"><a href="#list" data-toggle="pill">产品列表</a></li>
        <li><a href="#add" data-toggle="pill">添加产品</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="list">
            <form action="/admin/goods" class="form-search">
                <input type="text" name="query" class="input-medium search-query">
                <input type="submit" class="btn" value="搜索"/>
            </form>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>名称</th>
                        <th>价格</th>
                        <th width="135px">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($list as $item): ?>
                    <tr>
                        <td>
                            <?php echo ++$i; ?>
                            <input type="hidden" name="id" class="hide" value="<?php echo $item->id; ?>" />
                        </td>
                        <td>
                            <span><?php echo $item->name; ?></span>
                            <input type="text" name="name" class="hide input-mini" />
                        </td>
                        <td>
                            <span><?php echo $item->price; ?></span>
                            <input type="number" name="price" class="hide input-mini" />
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="edit btn">
                                <i class="icon-edit"></i>
                                编辑
                            </a>
                            <a href="javascript:void(0);" class="delete btn btn-danger <?php if ($item->is_delete) {
        echo 'disappear';
    } ?>">
                                <i class="icon-trash icon-white"></i>
                                删除
                            </a>
                            <a href="javascript:void(0);" class="recover btn btn-success <?php if (!$item->is_delete) {
        echo 'disappear';
    } ?>">
                                <i class="icon-repeat icon-white"></i>
                                恢复
                            </a>
                            <a href="javascript:void(0);" class="save btn btn-primary hide">
                                <i class="icon-ok icon-white"></i>
                                保存
                            </a>
                            <a href="javascript:void(0);" class="cancel btn hide">
                                <i class="icon-remove"></i>
                                取消
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane" id="add">
            <form action="/admin/goods/add" method="post">
                <div class="control-group">
                    <label class="control-label">名称</label>
                    <div class="controls">
                        <input type="text" name="name" class="span6" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">价格</label>
                    <div class="controls">
                        <input type="text" name="price" class="span6" />
                    </div>
                </div>
                <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="提交"/>
            </form>
        </div>
    </div>
</div>
<script>
$(function(){
    var list_operate = function(){
        var $table = $('#list').find('table');
        $table.on('click','.edit',function(){
            var $this= $(this);
            var $tr = $this.parent().parent();
            show_edit($tr);
        });
        $table.on('click','.recover',function(){
            var $this = $(this);
            var $tr = $this.parent().parent();
            $.get('/admin/goods/recover/'+get_id($tr),function(result){
                if(result){
                    alert(result);
                }else{
                    $this.addClass('disappear').prev().removeClass('disappear');
                }
            });
        });
        $table.on('click','.delete',function(){
            var $this = $(this);
            var $tr = $this.parent().parent();
            $.get('/admin/goods/delete/'+get_id($tr),function(result){
                if(result){
                    alert(result);
                }else{
                    $this.addClass('disappear').next().removeClass('disappear');
                }
            });
        });
        $table.on('click','.save',function(){
            var $this= $(this);
            var $tr = $this.parent().parent();
            var data = {
                id    : get_id($tr),
                name  : get_name($tr),
                price : get_price($tr)
            };
            $.get('/admin/goods/edit',data,function(result){
                if(result){
                    alert(result);
                }else{
                    $tr.find('span').html(function(){
                        var $input = $(this).next();
                        if($input.attr('type') === 'number'){
                            var value = parseFloat($input.val());
                            return value.toFixed(2);
                        }
                        else{
                            return $input.val();
                        }
                    });
                    hide_edit($tr);
                }
            });
        });
        $table.on('click','.cancel',function(){
            hide_edit($(this).parent().parent());
        });
        function show_edit ( $tr ) {
            $tr.find('span').hide().each(function(){
                var $input = $(this).next();
                if($input.attr('type') === 'number'){
                    var value = parseFloat(this.innerHTML);
                    $input.val(value.toFixed(2));
                }else{
                    $input.val(this.innerHTML);
                }
            });
            $tr.find('.edit,.delete,.recover').addClass('hide');
            $tr.find('input').show();
            $tr.find('.save,.cancel').removeClass('hide');
        }
        function hide_edit ( $tr ) {
            $tr.find('input').hide();
            $tr.find('.save,.cancel').addClass('hide');
            $tr.find('span').show();
            $tr.find('.edit,.delete,.recover').removeClass('hide');
        }
        function get_id ( $tr ) {
            return $tr.find('input[name="id"]').val();
        }
        function get_name ( $tr ) {
            return $tr.find('input[name="name"]').val();
        }
        function get_price ( $tr ) {
            return $tr.find('input[name="price"]').val();
        }
    }();
    var add_operate = function(){
        var $name = $('#add').find('input[name="name"]');
        var $price = $('#add').find('input[name="price"]');
        $('#J_submit').click(function(e){
            var has_empty = false;
            if (!$name.val()){
                $name.parents('.control-group').addClass('error');
                has_empty = true;
            }
            if (!$price.val()){
                $price.parents('.control-group').addClass('error');
                has_empty = true;
            }
            if(has_empty){
                return false;
            }
        });
    }();
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
