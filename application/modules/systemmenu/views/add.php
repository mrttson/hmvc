<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	

<div class="container">


    <div class="grid-16">

        <form method="POST" action="<?php echo site_url('systemmenu/add'); ?>" class="form uniformForm">					

            <div class="widget">

                <div class="widget-header">
                    <span class="icon-article"></span>
                    <h3><?php echo $pageTitle; ?></h3>
                </div> <!-- .widget-header -->

                <div class="widget-content">

                    <div class="field-group">
                        <label>Title:</label>
                        <div class="field">
                            <input type="text" name="title" id="title" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->

                    <div class="field-group">
                        <label>URL:</label>
                        <div class="field">
                            <input type="text" name="url" id="url" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->

                    <div class="field-group">		
                        <label>Parent Menu:</label>

                        <div class="field">
                            <select name="parent_id" id="parent_id" style="width: 383px;">
                                <option value="0" selected="selected">&nbsp;</option>
                                <?php
                                foreach ($listParentMenu as $parentMenu) {
                                    echo '<option value="' . $parentMenu['id'] . '">' . $parentMenu['title'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>		
                    </div> <!-- .field-group -->
                    
                    <div class="field-group">
                        <label>Order:</label>
                        <div class="field">
                            <input type="text" name="orderno" id="orderno" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->
                    
                    <div class="field-group">
                        <label>Icon:</label>
                        <div class="field">
                            <!--<input type="file" name="icon_path" id="icon_path" size="50" />-->
                            <input type='file' name="icon_path" id="icon_path" size="50" />
                            <img id="img_prev" src="<?php echo base_url() . 'public/images/default_img_thumb.gif'; ?>" alt="your image" width="50px" height="50px" style="position: relative; top: 10px;"/>
                        </div>
                    </div> <!-- .field-group -->

                    <div class="field-group">		
                        <label for="cfpassword">Status:</label>

                        <div class="field">
                            <input type="text" name="status" id="status" size="50" />
                        </div>		
                    </div> <!-- .field-group -->
                    <input class="btn btn-small btn-blue" type="submit" value="Save"/>
                    <a href="<?php echo site_url('systemmenu'); ?>"><button type="button" id="btn_systemmenu_add_back" class="btn btn-small btn-teal">&nbsp;Back&nbsp;</button></a>
                </div> <!-- .widget-content -->

            </div> <!-- .widget -->
        </form>
    </div>
</div>