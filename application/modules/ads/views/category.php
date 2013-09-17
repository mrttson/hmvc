<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	
<br/>
<div class="container">

    <div class="grid-24">	
        <p>
            <a href="<?php echo site_url('product/addCat'); ?>" class="projectMemberAdd tooltip" title="Add">+</a>           
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
                            <th>Parent</th>
                            <th>Order</th>
                            <th>Alias</th>
                            <th>Quản Lí</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($listCat as $cat){
                                ?>
                                <tr>
                                    <td><?php echo $cat['id']; ?></td>
                                    <td><?php if ($cat['parent_id'] == '0') echo '<h4>'.$cat['title'].'</h4>'; else echo $cat['title']; ?></td>
                                    <td><?php echo $cat['parent_title']; ?></td>
                                    <td><?php echo $cat['orderno']; ?></td>
                                    <td><?php echo $cat['alias']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?php echo site_url('product/editCat/'.$cat['id']); ?>"><img class="tooltip" title="Edit" style="border: 1px solid #000;" src="<?php echo base_url(). 'public/images/pencil.png'; ?>"/></a>
                                        <a href="<?php echo site_url('product/deleteCat/'.$cat['id']); ?>"><img class="tooltip" title="Delete" style="border: 1px solid #000;" src="<?php echo base_url(). 'public/images/remove.png'; ?>"/></a>
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