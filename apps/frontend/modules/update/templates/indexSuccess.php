                <div class="top" id="primary_box_corners">
                    <div class="top_left float-left" id="primary_box_corner"></div>
                    <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
                <div class="stack_form_box" id="primary_box">
                <?php if ($stage == 3): ?>
                <?php echo include_partial('stacking', array('stacking_form' => $form, 'film' => $film)) ?>
                <?php elseif ($stage == 1):?>
                <?php echo include_partial('search', array('search_form' => $form)) ?> 
                <?php elseif ($stage == 2):?>
                <?php echo include_partial('selection', array('returned_films' => $returned_films)) ?> 
                <?php endif;?> 
                </div>
                <div id="primary_box_corners" class="bottom">
                    <div id="primary_box_corner" class="bottom_left float-left"></div>
                    <div id="primary_box_corner" class="bottom_right float-right"></div>
                </div>