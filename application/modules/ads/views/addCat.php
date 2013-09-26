<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	

<div class="container">


    <div class="grid-16">

        <form method="POST" action="<?php echo site_url('product/addCat'); ?>" class="form uniformForm" enctype="multipart/form-data">
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
                        <label>Parent:</label>
                        <div class="field">
                            <select name="parent_id" id="parent_id" style="width: 383px;">
                                <option value="0" selected="selected">&nbsp;</option>
                                <?php
                                foreach ($listParentCat as $parentCat) {
                                    echo '<option value="' . $parentCat['id'] . '">' . $parentCat['title'] . '</option>';
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
                        <label>Alias:</label>
                        <div class="field">
                            <input type="text" name="alias" id="alias" size="50" class="" />			
                        </div>
                    </div> <!-- .field-group -->
                    <input class="btn btn-small btn-blue" type="submit" value="Save"/>
                    <a href="<?php echo site_url('product/category'); ?>"><button type="button" id="btn_systemmenu_add_back" class="btn btn-small btn-teal">&nbsp;Back&nbsp;</button></a>
                </div> <!-- .widget-content -->

            </div> <!-- .widget -->
        </form>
    </div>
</div>