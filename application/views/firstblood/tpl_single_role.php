<div id="content">


    <h3><?=$role['name'];?></h3>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>姓名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employee_array as $e): ?>
                <tr>
                    <td><?=$e->id;?></td>
                    <td><?=$e->fullname;?></td>
                    <td>

                    <?php
                        $arr = array(
                            'role_id'=>$role['id'],
                            'employee_id'=>$e->id,
                        );
                        $query_string = http_build_query($arr);
                    ?>
                    <a href="<?=site_url('firstblood/role/remove_employee').'?'.$query_string?>">移除</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr/>

    <div class="panel panel-default">
        <div class="panel-heading">
            增加新员工
        </div>
        <div class="panel-body">
            <?php $attributes = array('role' => 'form', 'id' => 'myform'); ?>
            <?php echo form_open(base_url($_SERVER["REQUEST_URI"]), $attributes) ?>
                <div class="form-group">
                    <select class="form-control" name="employee_id">
                        <?php foreach ($all_employees as $e):?>
                            <option value="<?=$e->id;?>"><?=$e->fullname;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <input type="submit" value="增加" class="btn btn-primary"/>
            </form>
        </div>
    </div>
</div>
