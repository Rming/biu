    <div class="navbar navbar-fixed-top">
        <div class="container-fluid top-bar">
            <div class="pull-right">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown notifications hidden-xs"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Notifications</span>
                        <p class="counter">4</p></a>
                    <ul class="dropdown-menu">
                            <li><a href="#"><div class="notifications label label-info">New</div> New user added: Jane Smith </a></li>
                            <li><a href="#"><div class="notifications label label-info">New</div> Sales targets available </a></li>
                            <li><a href="#"><div class="notifications label label-info">New</div> New performance metric added </a></li>
                            <li><a href="#"><div class="notifications label label-info">New</div> New growth data available </a></li>
                        </ul></li>
                    <li class="dropdown messages hidden-xs"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Messages</span>
                        <p class="counter">3</p></a>
                    <ul class="dropdown-menu messages">
                            <li><a href="#"><img alt="Avatar male2" height="34" src="/static/images/avatar-male2.png" width="34" /> Could we meet today? I wanted... </a></li>
                            <li><a href="#"><img alt="Avatar female" height="34" src="/static/images/avatar-female.png" width="34" /> Important data needs your analysis... </a></li>
                            <li><a href="#"><img alt="Avatar male2" height="34" src="/static/images/avatar-male2.png" width="34" /> Buy Se7en today, it's a great theme... </a></li>
                        </ul></li>
                    <li class="dropdown settings hidden-xs"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>Settings</span></a>
                    <ul class="dropdown-menu">
                            <li><a class="settings-link blue" href="javascript:chooseStyle('none', 30)"><span></span> Blue </a></li>
                            <li><a class="settings-link green" href="javascript:chooseStyle('green-theme', 30)"><span></span> Green </a></li>
                            <li><a class="settings-link orange" href="javascript:chooseStyle('orange-theme', 30)"><span></span> Orange </a></li>
                            <li><a class="settings-link magenta" href="javascript:chooseStyle('magenta-theme', 30)"><span></span> Magenta </a></li>
                            <li><a class="settings-link gray" href="javascript:chooseStyle('gray-theme', 30)"><span></span> Gray </a></li>
                        </ul></li>
                    <li class="dropdown user hidden-xs"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><img alt="Avatar male" height="34" src="/static/images/avatar-male.jpg" width="34" /> John
                            Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                            <li><a href="#"><i class="icon-user"></i> My Account </a></li>
                            <li><a href="#"><i class="icon-gear"></i> Account Settings </a></li>
                            <li><a href="index.html"><i class="icon-signout"></i> Logout </a></li>
                        </ul></li>
                </ul>
            </div>
            <button class="navbar-toggle">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="logo" href="index.html">se7en</a>
            <form class="navbar-form form-inline col-lg-2 hidden-xs">
                <input class="form-control" placeholder="Search" type="text" />
            </form>
        </div>
        <div class="container-fluid main-nav clearfix">
            <div class="nav-collapse">
                <ul class="nav">
                    <li class="dashboard"><a class="current" href="index.html"><span></span>Dashboard </a></li>
                    <li class="dropdown ui"><a data-toggle="dropdown" href="#"><span></span> UI <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                            <li><a href="buttons.html">Buttons</a></li>
                            <li><a href="icons.html">Icons</a></li>
                            <li><a href="components.html">Components</a></li>
                            <li><a href="widgets.html">Widgets</a></li>
                            <li><a href="typo.html">Typography</a></li>
                            <li><a href="grid.html">Grid Layout</a></li>
                        </ul></li>
                    <li class="forms"><a href="forms.html"><span></span> Forms </a></li>
                    <li class="tables"><a href="tables.html"><span></span> Tables </a></li>
                    <li class="charts"><a href="charts.html"><span></span> Charts </a></li>
                    <li class="gallery"><a href="gallery.html"><span></span> Gallery </a></li>
                </ul>
            </div>
        </div>
    </div>

<?if(false):?>
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

<?endif;?>
