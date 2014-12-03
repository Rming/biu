<div id="container">
    <a href="<?=site_url('firstblood/role/create')?>" class="btn btn-primary">创建新角色</a>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>角色</th>
                <th>设置</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($role_array as $r):?>
                <tr>
                    <td><a href="<?=site_url('firstblood/role/show/'.$r['id'])?>"><?=$r['id'];?></a></td>
                    <td><a href="<?=site_url('firstblood/role/show/'.$r['id'])?>"><?=$r['name'];?></a></td>
                    <td>
                        <a class="btn btn-default" href="<?=site_url('firstblood/role/edit/'.$r['id']);?>">设置权限</a>
                    </td>
                    <td>
                        <a  class="btn btn-xs btn-danger" href="<?=site_url('firstblood/role/remove/'.$r['id']);?>">删除</a>
                        &nbsp;
                        <a  class="btn btn-xs btn-success" href="<?=site_url('firstblood/role/modify/'.$r['id']);?>">编辑</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
