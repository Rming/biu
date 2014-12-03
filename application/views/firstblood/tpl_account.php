<style type="text/css">
    .role_add{cursor: pointer;}
    .remove_role{font-size: 18px;padding:2px 4px 0px 4px;}
    a.remove_role:hover{text-decoration: none;}
</style>
<div class="panel">
    <div class="panel-body">
        <a href="<?=site_url('firstblood/account/create')?>" class="btn btn-primary">添加员工</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>#</td>
                    <td>用户名</td>
                    <td>姓名</td>
                    <td>角色</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employee_list as $e): ?>
                <tr>
                    <td><?=$e->id;?></td>
                    <td><?=$e->name;?></td>
                    <td><?=$e->fullname;?></td>
                    <td>
                        <a class="btn btn-default btn-xs role_add" data-e-id="<?=$e->id;?>"  data-action="add">设置角色</a>
                        <?php
                            $employee_id = $e->id;
                            $employee_roles_arr = array_map(function($employee) use ($employee_id){
                                if($employee_id == $employee->employee_id){
                                    return $employee->role_id;
                                }
                            }, $employee_roles);
                            $employee_roles_arr = array_filter($employee_roles_arr);
                            sort($employee_roles_arr);
                        ?>
                        <?foreach ($employee_roles_arr as $role_id):?>
                        <?$role = $this->role_model->role($role_id)?>
                        <?if($role):?>
                            &emsp;
                            <label class="label label-default">
                                <?=$role['name']?>
                            </label>
                            <a href="<?=site_url('firstblood/role/remove_employee')."?role_id=".$role['id']."&employee_id=".$e->id;?>" class="remove_role" >
                                <span aria-hidden="true" >×</span>
                            </a>
                        <?endif;?>
                        <?endforeach;?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>


    </div>
</div>
<script type="text/javascript">
    var fill_roles = function(btn) {
        var eid = btn.data('e-id');
        $.get(
            '/j/jrole/role_list',
            function(data) {
                $.each(
                    data.result.roles,
                    function(idx, role) {
                        $('#employee_' + eid).append($('<option value="'+role.id+'">'+role.name+'</option>'));
                    }
                );
            }
        );
    }
    $('.role_add').click(function(e) {
    var self = $(this);
    var eid = self.data('e-id');

    if (self.data('action') == 'add') {
        $('<select id="employee_'+eid+'"></select>').insertBefore(self);
        fill_roles(self);
        self.data('action', 'confirm');
        self.text('确定');
    }else{
        var url = '/j/jrole/add_role_by_employee/' + eid + '?role_id=' + $('#employee_' + eid).val();
        $.get(
            url,
            function(data) {
                if (data.error_code == 0) {
                    location.reload();
                }
            }
        );
    }
})
</script>
