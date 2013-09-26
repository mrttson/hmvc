<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	
<br/>
<div class="container">

    <div class="grid-24">	
        <p>
            <a href="<?php echo site_url('user/add'); ?>" class="projectMemberAdd tooltip" title="Add Member">+</a>           
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
                            <th>User Name</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Quản Lí</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($listUser as $user){
                                ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['username']; ?></td>
                                    <td><?php echo $user['fullname']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['role_name']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="<?php echo site_url('user/edit/'.$user['id']); ?>"><img style="border: 1px solid #000;" src="<?php echo base_url(). 'public/images/pencil.png'; ?>" title="Edit User"/></a>
                                        <a href="<?php echo site_url('user/delete/'.$user['id']); ?>"><img style="border: 1px solid #000;" src="<?php echo base_url(). 'public/images/remove.png'; ?>" title="Delete User"/></a>
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