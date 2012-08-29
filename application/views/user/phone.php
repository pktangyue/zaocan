<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form method="post">
    <div class="control-group">
        <label class="control-label">手机号：</label>
        <div class="controls">
            <input type="text" name="phone" class="span6" placeholder="请输入手机号..." value="<?php echo isset($phone) ? $phone : ''; ?>" />
        </div>
    </div>
    <div class="form-actions">
        <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="确定" data-loading-text="载入中..." />
    </div>
</form>
<script>
$(function(){
    var $inputs = $('input[type="text"]');
    var phone = /^1\d{10}$/;
    $inputs.blur(function(){
        var $this= $(this);
        if (!$this.val() || !phone.test($this.val())){
            $this.parents('.control-group').addClass('error');
        }
    }).focus(function(){
        $(this).parents('.control-group').removeClass('error');
    });
    $('#J_submit').click(function(e){
        var has_empty = false;
        $inputs.each(function(){
            var $this = $(this);
            if(!$this.val() || !phone.test($this.val())){
                $this.parents('.control-group').addClass('error');
                has_empty = true;
            }
        });
        return !has_empty ? $(this).button('loading') : false ;
    });
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
