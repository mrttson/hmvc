<ul id="mainNav">
    <?php
    foreach ($sideBar as $menu) {
        if ($menu['parent_id'] == '0' || empty($menu['parent_id'])) {
            ?>
            <li class="nav">
                <span style="background-image: url(<?php echo base_url() . 'public/images/' . $menu['icon_path']; ?>)"></span>
                <a href="<?php echo $menu['url']; ?>"><?php echo $menu['title']; ?></a>
                <?php 
                if($menu['countSub'] > 0){ ?>
                <ul class="subNav">
                    <?php
                    foreach ($sideBar as $submenu) {
                        if ($submenu['parent_id'] == $menu['id']) {
                            ?>
                    <li><a href="<?php echo site_url($submenu['url']); ?>"><?php echo $submenu['title']; ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <?php } ?>
            </li>
            <?php
        }
    }
    ?>
</ul>
