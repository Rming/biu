<?php
$section_action_filter = function($section_filter_arr, $action_filter_arr) use($resource_section,$resource_action){
    $resource_section_current = array_filter($resource_section , function($row) use ($section_filter_arr){
        return !in_array($row->id, $section_filter_arr);
    });
    $resource_action_current = array_filter($resource_action , function($row) use ($action_filter_arr){
        return !in_array($row->id, $action_filter_arr);
    });
    return array($resource_section_current , $resource_action_current);
}
?>
<div class="panel">
    <div class="panel-body">
        <h2><?=$role['name'];?></h2>
        <?php $attributes = array('role' => 'form', 'id' => 'myform'); ?>
        <?php echo form_open('', $attributes) ?>
            <table class="table">
                <thead>
                    <tr>
                        <td>类别</td>
                        <td>资源</td>
                        <td>筛选</td>
                        <td>操作</td>
                        <td>取消</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menu_resources as $resources_cate): ?>
                    <tr class="info">
                        <td><?=$resources_cate->name;?></td>
                        <td colspan="4"></td>
                    </tr>
                    <?php foreach ($resources_cate->resource as $resource): ?>
                        <?php
                            $resource_section_current = $resource_section;
                            $resource_action_current  = $resource_action;
                            $action_filter_arr  = array();
                            $section_filter_arr = array();
                            switch ($resource->id) {
                                case Resource_model::MY:

                                case Resource_model::SYS:
                                case Resource_model::SUPER:
                                    list($resource_section_current, $resource_action_current) = $section_action_filter(
                                        array(Resource_section_model::OWNED , Resource_section_model::COMPANY),
                                        array(Resource_action_model::READONLY )
                                    );
                                    break;
                                case Resource_model::CUSTOMER_DIGGER:
                                    list($resource_section_current, $resource_action_current) = $section_action_filter(
                                        array(Resource_section_model::SHARED),
                                        array(Resource_action_model::READONLY )
                                    );
                                    break;
                                default:
                                    break;
                            }

                            $special_action_extra = array_filter($special_action , function($row) use ($resource){
                                return $row->for == $resource->id;
                            });
                            $resource_action_current  = array_merge($resource_action_current , $special_action_extra);
                        ?>
                        <tr id="item-<?=$resource->id;?>">
                            <td></td>
                            <td><?=$resource->name;?></td>
                            <td>
                                <?php
                                    $match_permission = array_filter($role_permissions,function($permission) use ($resource){
                                        if($permission->resource_id == $resource->id) {
                                            return true;
                                        }
                                    });
                                ?>
                                <?php foreach ($resource_section_current as $section):?>
                                    <label class="radio-inline">
                                        <input type="radio" name="permissions[resource-<?=$resource->id?>][section]"  value="<?=$section->id?>"
                                        <?if(!empty($match_permission)&&(current($match_permission)->section_id == $section->id) ):?>
                                        checked
                                        <?endif;?>
                                        >
                                        <?=$section->name;?>
                                        &nbsp;
                                    </label>
                                <?endforeach;?>
                            </td>
                            <td>
                                <?php usort($resource_action_current, function($row_a, $row_b) {
                                    return $row_a->id >  $row_b->id;
                                });
                                ?>
                                <?php foreach ($resource_action_current as $action):?>
                                    <label class="radio-inline">
                                        <input type="radio" name="permissions[resource-<?=$resource->id?>][action]"  value="<?=$action->id?>"
                                        <?if(!empty($match_permission)&&(current($match_permission)->action_id == $action->id) ):?>
                                        checked
                                        <?endif;?>
                                        >
                                        <?=$action->name;?>
                                        &nbsp;
                                    </label>
                                <?endforeach;?>
                            </td>
                            <td>
                                <?if($resource->id==Resource_model::MY):?>
                                <?else:?>
                                <a class="btn btn-xs btn-default"  onclick="$('#item-<?=$resource->id?> input:checked').attr('checked',false)">取消</a>
                                <?endif;?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <input type="submit" value="保存" class="btn btn-primary" />
        </form>


    </div>
</div>
