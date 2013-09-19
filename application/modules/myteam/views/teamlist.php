<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	

<div class="container">
    <div class="grid-16">
        <div class="widget">
            <div class="widget-header">
                <span class="icon-image"></span>
                <h3><?php echo $pageTitle; ?></h3>
            </div>
            <div class="widget-content">
                <table class="table table-bordered table-striped" id ="myteam_tbl">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Avatar</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listMemberInfo as $memberInfo) {
                            ?>
                            <tr mid="<?php echo $memberInfo['id']; ?>">
                                <td rel="mid"><?php echo $memberInfo['id']; ?></td>
                                <td rel="avatar" style="text-align: center;">
                                    <img class="avatar" src="<?php echo $memberInfo['avatar']; ?>" alt="your image" width="50px" height="50px"/>
                                </td>
                                <td rel="name"><?php echo $memberInfo['name']; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div><!-- .grid -->
    <div class="grid-8">

        <div id="gallery_upload" class="box">
            <h3>Thông tin chi tiết</h3>

            <p id="product_desc"></p>

            <form class="form uniformForm" enctype="multipart/form-data">

                <div class="field-group">
                    <label for="file_name">Avatar</label>
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
                    <label for="file_name">Name</label>
                    <div class="field">
                        <input type="text" id="name" size="50"/>
                    </div> <!-- .field -->
                </div> <!-- .field-group -->

                <div class="field-group">
                    <label for="file_name">Album</label>
                    <div class="field" id="album" style="border: 1px solid #000; width: 100%; height: 200px; overflow: scroll; padding: 10px 0px; text-align: center;">
                        <?php
//                        foreach ($listImg as $img) {
                            ?>
                        <!--<img src="<?php echo $img; ?>" style="height: 100px;"/>-->
                            <?php
//                        }
                        ?>
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
</div> <!-- .container -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/myteam.js"></script>