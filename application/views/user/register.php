<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form method="post">
    <div class="control-group">
        <label class="control-label"><h4>姓名：</h4></label>
        <div class="controls">
            <input type="text" name="name" class="span6" placeholder="请输入姓名..." value="<?php echo isset($name) ? $name : ''; ?>" />
        </div>
    </div>
    <br/>
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
            <input type="text" name="three" class="span6" placeholder="请输入具体科室..." value="<?php echo isset($threee) ? $three : ''; ?>" />
        </div>
    </div>
    <br/>
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
        <input type="submit" id="J_submit" class="btn btn-primary btn-large" value="确定" />
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
        return !has_empty;
    });
});
</script>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
