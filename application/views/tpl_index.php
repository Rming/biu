<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/typo.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('static/css/style.css')?>">
	<style type="text/css">
	.whole_background{
		background-image:url('<?=$background;?>');
	}
</style>
</head>
<body>
<div class="whole_background">
</div>
<div class="whole_index">
    <div class="whole_wrap">
		<?=$poetry;?>
    </div>
</div>
<div class="copyright">
	<!--<a href="<?=site_url('about');?>">关于</a>
	<a href="<?=site_url('user/signup');?>">注册</a>
	<a href="<?=site_url('user/login');?>">登陆</a>-->
</div>
</body>
</html>
