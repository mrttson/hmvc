<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	
<br/>
<div class="container">

    <div class="grid-24">	
        <p>
            <a href="<?php echo site_url('systemmenu/add'); ?>" class="projectMemberAdd tooltip" title="Add">+</a>           
        </p>
        <div class="widget widget-table">

            <div class="widget-header">
                <span class="icon-list"></span>
                <h3 class="icon chart"><?php echo $pageTitle; ?></h3>	
            </div>

            <div class="widget-content">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Parent Menu</th>
                            <th>Order</th>
                            <th>Icon</th>
                            <th>Status</th>
                            <th>Quản Lí</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($listMenu as $menu){
                                ?>
                                <tr>
                                    <td><?php echo $menu['id']; ?></td>
                                    <td><?php if ($menu['parent_id'] == '0') echo '<b><u>'.$menu['title'].'</u></b>'; else echo $menu['title']; ?></td>
                                    <td><?php echo $menu['url']; ?></td>
                                    <td><?php echo $menu['parent_title']; ?></td>
                                    <td><?php echo $menu['orderno']; ?></td>
                                    <td><?php echo $menu['icon_path']; ?></td>
                                    <td style="text-align: center;">
                                        <input type="checkbox" <?php if($menu['status'] == 1) echo 'checked'; ?>/>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="<?php echo site_url('systemmenu/edit/'.$menu['id']); ?>"><img style="border: 1px solid #000;" src="<?php echo base_url(). 'public/images/pencil.png'; ?>" title="Edit"/></a>
                                        <a href="<?php echo site_url('systemmenu/delete/'.$menu['id']); ?>"><img style="border: 1px solid #000;" src="<?php echo base_url(). 'public/images/remove.png'; ?>" title="Delete"/></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>

            </div> <!-- .widget-content -->

        </div> <!-- .widget -->
    </div>
</div>