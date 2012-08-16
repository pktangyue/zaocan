<?php include_once (APPPATH . 'views/common/header.php'); ?>
<form action="/admin/login" method="post">
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
    <br/>
    <input type="submit" class="btn btn-primary btn-large" value="提交" />
    <input type='hidden' value='login' name='submit'/>
    <?php echo $error; ?>
</form>
<?php include_once (APPPATH . 'views/common/footer.php'); ?>
