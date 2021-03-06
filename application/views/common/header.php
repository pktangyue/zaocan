<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="/css/bootstrap.min.css" />
        <style>body{padding-top:55px;}</style>
        <link rel="stylesheet" href="/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="/css/zaocan.css" />
        <script src="/js/jquery-1.7.1.min.js"></script>
        <script src="/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <?php echo isset($left_header_btn) ? $left_header_btn : ''; ?>
                    <?php echo isset($right_header_btn) ? $right_header_btn : ''; ?>
                    <a class="brand"><?php echo $title; ?></a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row-fluid">
                <?php if (isset($error) && $error): ?>
                <div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><span><?php echo $error; ?></span></div>
                <?php endif; ?>
