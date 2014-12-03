<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-collapse">
        <ul class="nav navbar-nav" id="navbar"></ul>
    </div>
</nav>
<script type="text/javascript">
$.getJSON('/j/menu?_t=' + (new Date().getTime()), function(ret) {
    var menu_tree = ret['result']['menu'];
    var top_menus = [];

    $.each(menu_tree, function(idx, menu) {
        var weight = menu.weight;

        var el = null;
        var top_weight = 0;
        $.each($('.top_menu'), function(idx, menu) {
            var menu = $(menu);
            var w = menu.data('weight');

            //alert(w + ":" + top_weight + ":" + weight);
            if (weight > w && w > top_weight) {
                top_weight = w;
                el = menu;
            }
        });

        var html = '<li class="dropdown top_menu" id="menu_item_'+menu.id+'" data-weight="'+menu.weight+'"><a href="#" id="menu_link_'+menu.id+'" class="dropdown-toggle" data-toggle="dropdown">' + menu.name + ' <b id="menu_icon_'+menu.id+'" class="caret"></b></a><ul class="dropdown-menu" id="bar-' + menu.id + '"></ul></li>';
        if (el) {
            $(html).insertBefore(el);
        } else {
            $('#navbar').append($(html));
        }

        $.each(menu['items'], function(idx, item){
            $('#bar-' + menu.id).append('<li id="menu_item_'+item.id+'"><a href="' + item.href + '">' + item.name + '</a></li>');
        });

    });

});
</script>
