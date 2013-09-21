<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	
<br/>
<div class="container">

    <div class="grid-16">	
<!--        <p>
            <a href="<?php echo site_url('systemmenu/add'); ?>" class="projectMemberAdd tooltip" title="Add">+</a>           
        </p>-->
        <div class="widget widget-table">

            <div class="widget-header">
                <span class="icon-list"></span>
                <h3 class="icon chart"><?php echo $pageTitle; ?></h3>
            </div>

            <div class="widget-content">

                <table class="table table-bordered table-striped" id="systemmenu_tbl">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Parent Menu</th>
                            <th>URL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($listMenu && count($listMenu) > 0) {
                            foreach ($listMenu as $menu) {
                                ?>
                                <tr sId="<?php echo $menu['id']; ?>">
                                    <td><?php echo $menu['id']; ?></td>
                                    <?php
                                    if ($menu['parent_id'] == '0') {
                                        $title = '<h4>' . $menu['title'] . '</h4>';
                                    } else {
                                        $title = $menu['title'];
                                    }
                                    ?>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $menu['parent_title']; ?></td>
                                    <td><?php echo $menu['url']; ?></td>

                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div> <!-- .widget-content -->
        </div> <!-- .widget -->
        <div class="pagination" style="text-align: center;">
            <?php echo $links; ?>
        </div> <!-- .widget -->	
    </div>
    <div class="grid-8">

        <div id="gallery_upload" class="box">
            <h3>Thông tin chi tiết</h3>

            <p id="product_desc"></p>

            <form class="form uniformForm" enctype="multipart/form-data">

                <div class="field-group">
                    <label for="file_name">Hình Ảnh</label>
                    <div style="text-align: center;">
                        <div class="field" style="width: 100%; height: 100px;">
                            <img id="img_prev" src="<?php echo base_url() . 'public/images/default_img_thumb.gif'; ?>" alt="your image" style="max-width: 100%; height: 100%; text-align: center"/>
                        </div> <!-- .field -->
                        <div class="field">
                            <input type="file" name="file_upload" id="icon_path" />
                        </div> <!-- .field -->
                    </div>
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">ID:</label>
                    <div class="field">
                        <input type="text" name="systemmenu_id" id="systemmenu_id" disabled="disabled" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">Title:</label>
                    <div class="field">
                        <input type="text" name="systemmenu_title" id="systemmenu_title" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">URL:</label>
                    <div class="field">
                        <input type="text" name="systemmenu_path" id="systemmenu_url" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">Order:</label>
                    <div class="field">
                        <input type="text" name="systemmenu_order" id="systemmenu_order" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_category">Parent:</label>
                    <div class="field">
                        <select id="parent_id" name="parent_id">
                            <option value="0"></option>
                            <?php
                            foreach ($listParentMenu as $parentMenu) {
                                echo '<option value="' . $parentMenu['id'] . '">' . $parentMenu['title'] . '</option>';
                            }
                            ?>
                        </select>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">Status</label>
                    <div class="field">
                        <input type="text" name="systemmenu_status" id="systemmenu_status" size="50" />
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group" id="errMsg" style="display: none; text-align: center;">
                    <div class="field" >
                        <p></p>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div id="errMsg" style="text-align: center; font-weight: bold;">
                    <p>&nbsp;</p>
                </div> <!-- .notify -->

                <div class="field-group" id="ajaxLoader" style="display: none; text-align: center;">
                    <div class="field">
                        <img src="<?php echo base_url() . 'public/images/loader.gif'; ?>" alt="your image" style="max-width: 100%; height: 100%; text-align: center"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="actions" style="text-align: center;">
                    <a href="<?php echo site_url('systemmenu/add'); ?>"><button type="button" class="btn btn-primary" id="create_btn">Create</button></a>
                    <a href="javascript:;"><button type="button" class="btn btn-primary" id="delete_btn">Delete</button>
                </div> <!-- .actions -->


            </form>
        </div> <!-- .box -->

    </div> <!-- .grid -->
</div>
<script src="<?php echo base_url() . 'public/js/systemmenu.js'; ?>"></script>