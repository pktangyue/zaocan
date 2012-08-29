<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form method="post">
    <div class="control-group">
        <label class="control-label">设置密码</label>
        <div class="controls">
            <input type="password" name="password1" class="span6" placeholder="请输入...">
        </div>
    </div>
    <br/>
    <div class="control-group">
        <label class="control-label">重复密码</label>
        <div class="controls">
            <input type="password" name="password2" class="span6" placeholder="请输入...">
        </div>
    </div>
    <br/>
    <div class="form-actions">
        <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="注册" data-loading-text="载入中..." />
        <input type="hidden" name="submit" value="register"/>
    </div>
</form>
<script>
$(function(){
    var $inputs = $('input[type="text"],input[type="password"]');
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
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
