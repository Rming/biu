<div>
    <?php $form_validated = validation_errors()?>
    <?php if(!empty($_POST)&&empty($form_validated) ):?>
        <div class="alert alert-success">操作成功!</div>
    <?php header("refresh:1;url=".site_url('firstblood/role'));?>
    <?php endif;?>

    <?php if (!empty($form_validated)): ?>
        <div class="alert alert-danger">
        <?php echo validation_errors(); ?>
        </div>
    <?php endif?>
    <?=form_open() ?>
    <div class="form-group">
        <label class="control-label">角色名称：</label>
        <?php $attr = 'class="form-control" placeholder="角色名称"';?>
        <?=form_input('role_name', @set_value('role_name',$role->name), $attr);?>
    </div>
    <?=form_submit('submit', '保存','class="btn btn-primary pull-right"');?>
    <?=form_close();?>
</div>
