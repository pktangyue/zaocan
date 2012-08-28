<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form action="/user/password" method="post">
    <div class="control-group">
        <label class="control-label">密码：</label>
        <div class="controls">
            <input type="password" name="password" class="span6" placeholder="请输入密码...">
        </div>
    </div>
    <br/>
    <div class="form-actions">
        <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="登录" />
        <input type="hidden" name="submit" value="login"/>
    </div>
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
