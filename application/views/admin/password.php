<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form action="/admin/password" method="post">
    <?php if (isset($error)): ?>
    <div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><span><?php echo $error; ?></span></div>
    <?php endif; ?>
    <?php if (isset($success)): ?>
    <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><span><?php echo $success; ?></span></div>
    <?php endif; ?>
    <div class="control-group">
        <label class="control-label">旧密码</label>
        <div class="controls">
            <input type="password" name="password" class="span6" placeholder="请输入...">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">设置密码</label>
        <div class="controls">
            <input type="password" name="password1" class="span6" placeholder="请输入...">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">重复密码</label>
        <div class="controls">
            <input type="password" name="password2" class="span6" placeholder="请输入...">
        </div>
    </div>
    <br/>
    <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="提交" />
    <input type="hidden" name="postkey" value="<?php echo $postkey; ?>" />
</form>
<script>
$(function(){
    var $inputs = $('input[type="password"]');
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
        return !has_empty;
    });
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
