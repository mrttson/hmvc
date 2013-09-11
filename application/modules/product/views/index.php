<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	
<br/>
<div class="container">

    <div class="grid-16">	
<!--        <p>
            <a href="<?php echo site_url('product/add'); ?>" class="projectMemberAdd tooltip" title="Add">+</a>           
        </p>-->
        <div class="widget widget-table">

            <div class="widget-header">
                <span class="icon-list"></span>
                <h3 class="icon chart"><?php echo $pageTitle; ?></h3>
            </div>

            <div class="widget-content">

                <table class="table table-bordered table-striped" id ="product_tbl">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <!--<th>Quản Lí</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listProduct as $product) {
                            ?>
                            <tr pid="<?php echo $product['id']; ?>">
                                <td><?php echo $product['id']; ?></td>
                                <td style="text-align: center;">
                                    <?php
                                    $srcImg = "";
                                    if (!empty($product['icon_path']) && file_exists(PUBLIC_PATH . 'images/' . $product['icon_path'])) {
                                        $srcImg = base_url() . 'public/images/' . $product['icon_path'];
                                    } else {
                                        $srcImg = base_url() . 'public/images/default_img_thumb.gif';
                                    }
                                    ?>
                                    <img src="<?php echo $srcImg; ?>" alt="your image" width="50px" height="50px"/>
                                </td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['title']; ?></td>
    <!--                                <td style="text-align: center;">
                                    <a href="<?php echo site_url('product/edit/' . $product['id']); ?>"><img class="tooltip" title="Edit" style="border: 1px solid #000;" src="<?php echo base_url() . 'public/images/pencil.png'; ?>"/></a>
                                    <a href="<?php echo site_url('product/delete/' . $product['id']); ?>"><img class="tooltip" title="Delete" style="border: 1px solid #000;" src="<?php echo base_url() . 'public/images/remove.png'; ?>"/></a>
                                </td>-->
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div> <!-- .widget-content -->

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
                    <label for="file_name">ID</label>
                    <div class="field">
                        <input type="text" name="file_name" id="product_id" disabled="disabled" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">Name</label>
                    <div class="field">
                        <input type="text" name="file_name" id="product_name" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_category">Category:</label>
                    <div class="field">
                        <select id="product_cat" name="product_cat">
                            <optgroup label="Image Category">
                                <?php
                                foreach ($listParentCat as $parentCat) {
                                    $option = '<option value="' . $parentCat['id'] . '">' . $parentCat['title'] . '</option>';
                                    echo $option;
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">Status</label>
                    <div class="field">
                        <input type="text" name="file_name" id="product_status" size="50" />
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group" id="ajaxLoader" style="display: none; text-align: center;">
                    <div class="field">
                        <img src="<?php echo base_url() . 'public/images/loader.gif'; ?>" alt="your image" style="max-width: 100%; height: 100%; text-align: center"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="actions" style="text-align: center;">
                    <button type="button" class="btn btn-primary">Create New</button>
                </div> <!-- .actions -->


            </form>
        </div> <!-- .box -->

    </div> <!-- .grid -->
</div>
<script src="<?php echo base_url() . 'public/js/product.js'; ?>"></script>