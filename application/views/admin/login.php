<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form action="/admin/login" method="post">
    <?php if (isset($error)) { ?>
    <div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><span><?php echo $error; ?></span></div>
    <?php } ?>
    <div class="control-group">
        <label class="control-label">用户名</label>
        <div class="controls">
            <input type="text" name="name" class="span6" placeholder="请输入用户名...">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">密码</label>
        <div class="controls">
            <input type="password" name="password" class="span6" placeholder="请输入密码...">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <label class="checkbox">
                <input type="checkbox" name="is_auto_login" value="1">
                下次自动登录
            </label>
        </div>
    </div>
    <br/>
    <input type="submit" id="J_login" class="btn btn-primary btn-large" value="提交" data-loading-text="登录中..." />
    <input type="hidden" name="submit" value="login" />
</form>
<script>
$(function(){
    var $name = $('input[name="name"]');
    var $password = $('input[name="password"]');
    $name.add($password).blur(function(){
        var $this= $(this);
        if (!$this.val()){
            $this.parents('.control-group').addClass('error');
        }
    }).focus(function(){
        $(this).parents('.control-group').removeClass('error');
    });
    $('#J_login').click(function(e){
        var has_empty = false;
        if (!$name.val()){
            $name.parents('.control-group').addClass('error');
            has_empty = true;
        }
        if (!$password.val()){
            $password.parents('.control-group').addClass('error');
            has_empty = true;
        }
        if(has_empty){
            return false;
        }
    });
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
