<div id="contentHeader">
    <h1><?php echo $moduleTitle; ?></h1>
</div> <!-- #contentHeader -->	

<div class="container">


    <div class="grid-16">
        <?php if (count($catInfo) > 0) { ?>
            <form method="POST" action="<?php echo site_url('product/editCat/' . $catInfo['id']); ?>" class="form uniformForm" enctype="multipart/form-data">					

                <div class="widget">

                    <div class="widget-header">
                        <span class="icon-article"></span>
                        <h3><?php echo $pageTitle; ?></h3>
                    </div> <!-- .widget-header -->

                    <div class="widget-content">

                        <div class="field-group">
                            <label>Title:</label>
                            <div class="field">
                                <input type="text" name="title" id="title" size="50" class="" value="<?php echo $catInfo['title']; ?>"/>			
                            </div>
                        </div> <!-- .field-group -->

                        <div class="field-group">		
                            <label>Parent Cat:</label>

                            <div class="field">
                                <select name="parent_id" id="parent_id" style="width: 383px;">
                                    <option value="0" selected="selected">&nbsp;</option>
                                    <?php
                                    foreach ($listParentCat as $parentCat) {
                                        $option = '<option value="' . $parentCat['id'] . '"';
                                        if ($catInfo['parent_id'] == $parentCat['id']) {
                                            $option .= ' selected="selected"';
                                        }
                                        $option .= '>' . $parentCat['title'] . '</option>';
                                        echo $option;
                                    }
                                    ?>
                                </select>
                            </div>		
                        </div> <!-- .field-group -->

                        <div class="field-group">
                            <label>Order:</label>
                            <div class="field">
                                <input type="text" name="orderno" id="orderno" size="50" class="" value="<?php echo $catInfo['orderno']; ?>"/>			
                            </div>
                        </div> <!-- .field-group -->

                        <div class="field-group">
                            <label for="cfpassword">Alias:</label>

                            <div class="field">
                                <input type="text" name="alias" id="alias" size="50" value="<?php echo $catInfo['alias']; ?>"/>
                            </div>		
                        </div> <!-- .field-group -->
                        <input class="btn btn-small btn-blue" type="submit" value="Save"/>
                        <a href="<?php echo site_url('product/category'); ?>"><button type="button" id="btn_systemmenu_add_back" class="btn btn-small btn-teal">&nbsp;Back&nbsp;</button></a>
                    </div> <!-- .widget-content -->

                </div> <!-- .widget -->
            </form>
        <?php } ?>
    </div>
</div>