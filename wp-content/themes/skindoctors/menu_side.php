<?
    $menu_arr = wp_get_menu_array(54);
    $l = 0;
?>
<div class="panel-group" id="accordion">
    <? foreach($menu_arr as $k => $menu):?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title uppercase center">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<? echo $l; ?>">
                    <? echo $menu['title']; ?></a>
                </h4>
            </div>
            <div id="collapse<? echo $l; ?>" class="panel-collapse collapse <? if($l == 0): ?>in<? endif; ?>">
                <div class="panel-body no-padding">
                    <ul>
                        <? foreach($menu['children'] as $kk => $child_menu): ?>
                            <li>
                                <a href="<? echo $child_menu['url']; ?>">
                                    <? echo $child_menu['title']; ?>
                                </a>
                            </li>
                        <? endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <? $l++; ?>
    <? endforeach; ?>
</div>