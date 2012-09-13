<?php include_once (APPPATH . 'views/common/header.php'); ?>
<style>
    .well{position:relative;cursor:pointer;}
    .well .icon-ok{position:absolute;right:5px;bottom:5px;display:none;}
    .alert-success .icon-ok{display:inline-block;}
</style>
<a id="J_new" href="javascript:void(0);" class="btn span12" style="margin-left:0;">添加收货地址</a>
<div class="clearfix"></div>
<br/>
<form class="<?php echo isset($address_list) && $address_list ? 'hide' : ''; ?>" method="post">
    <div class="control-group">
        <label class="control-label"><h4>姓名：</h4></label>
        <div class="controls">
            <input type="text" name="name" class="span12" placeholder="请输入姓名..." value="<?php echo isset($name) ? $name : ''; ?>" />
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"><h4>地址：</h4></label>
        <div class="controls">
            航天部大院，<input type="hidden" name="one" value="航天部大院"/>
            <select name="two" class="input-small">
                <option value="1号楼" <?php if (isset($two) && $two == '1号楼') echo 'selected'; ?>>1号楼</option>
                <option value="2号楼" <?php if (isset($two) && $two == '2号楼') echo 'selected'; ?>>2号楼</option>
                <option value="3号楼" <?php if (isset($two) && $two == '3号楼') echo 'selected'; ?>>3号楼</option>
                <option value="4号楼" <?php if (isset($two) && $two == '4号楼') echo 'selected'; ?>>4号楼</option>
                <option value="5号楼" <?php if (isset($two) && $two == '5号楼') echo 'selected'; ?>>5号楼</option>
            </select>
            <input type="text" name="three" class="span12" placeholder="请输入具体科室..." value="<?php echo isset($threee) ? $three : ''; ?>" />
        </div>
    </div>
    <div class="form-actions">
        <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="确定" data-loading-text="载入中..." />
        <input type="button" id="J_cancel" class="btn btn-large" value="取消"/>
        <input type="hidden" name="submit" value="add"/>
    </div>
</form>
<?php foreach ($address_list as $address): ?>
<div class="well <?php echo $address->is_current ? 'alert-success' : ''; ?>" data-id="<?php echo $address->id; ?>">
    <span class="icon-ok"></span>
    <div><?php echo $address->one; ?>，<?php echo $address->two; ?>，<?php echo $address->three; ?></div>
    <div><?php echo $address->name; ?></div>
</div>
<?php endforeach; ?>
<script>
$(function(){
    var $inputs = $('input[type="text"]');
    $inputs.blur(function(){
        var $this= $(this);
        if (!$this.val()){
            $this.parents('.control-group').addClass('error');
        }
    }).focus(function(){
        $(this).parents('.control-group').removeClass('error');
    });
    $('#J_submit').click(function(e){
        var has_empty = false;
        $inputs.each(function(){
            var $this = $(this);
            if(!$this.val()){
                $this.parents('.control-group').addClass('error');
                has_empty = true;
            }
        });
        return !has_empty ? $(this).button('loading') : false ;
    });
    $('#J_cancel').click(function(){
        $('form').hide();
    })
    $('#J_new').click(function(){
        $('form').show();
    });
    $('.well').click(function(){
        var $this = $(this);
        if($this.hasClass('alert-success')){
            return;
        }
        var id = $this.data('id');
        $.get('/address/update/'+id,function(result){
            if(result){
                alert(result);
            }else{
                $this.siblings().removeClass('alert-success');
                $this.addClass('alert-success');
            }
        });
    });
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
