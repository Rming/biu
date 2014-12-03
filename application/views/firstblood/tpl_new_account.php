<div id="content">
    <?php $attributes = array('role' => 'form', 'id' => 'myform'); ?>
    <?php echo form_open('', $attributes) ?>
        <?php $form_validated = validation_errors()?>
        <?php  if(!empty($_POST)&&empty($form_validated) ):?>
            <div class="alert alert-success">操作成功!</div>
        <?php endif;?>

        <?php if (!empty($form_validated)): ?>
            <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
            </div>
        <?php endif?>

        <div class="form-group">
            <label class="control-label">用户名：</label>
            <div>
                <input type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control" placeholder="用户名">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">密码：</label>
            <div>
                <input type="text" name="password"  value="<?php echo set_value('password'); ?>"class="form-control" placeholder="密码">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">姓名：</label>
            <div>
                <input type="text" name="fullname"  value="<?php echo set_value('fullname'); ?>"class="form-control" placeholder="姓名">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">电话：</label>
            <div>
                <input type="phone" name="phone"  value="<?php echo set_value('phone'); ?>"class="form-control" placeholder="电话">
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="创建"/>

    </form>

</div>
