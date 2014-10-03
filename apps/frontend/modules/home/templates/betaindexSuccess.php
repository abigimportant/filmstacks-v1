            <div class="top" id="general_box_corners">
                <div class="top_left float-left" id="general_box_corner"></div>
                <div class="top_right float-right" id="general_box_corner"></div>
            </div>
            <div id="general_box">
<?php if ($signup_form->hasErrors()): ?>
                <ul class="error_list">
<?php foreach ($signup_form->getErrorSchema() as $error): ?>
                    <li><?php echo $error; ?></li>
<?php endforeach; ?>
                </ul>
                <div class="box_divider"></div>
<?php endif; ?>
                
                <form action="<?php echo url_for('home/betaindex') ?>" id="signup_form" method="post">
                    <table id="widgets">
                        <tr>
                            <th><?php echo $signup_form['signup_code']->renderLabel();?></th>
                            <td>
                            <?php echo $signup_form['signup_code']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $signup_form['signup_uname']->renderLabel();?></th>
                            <td>
                            <?php echo $signup_form['signup_uname']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $signup_form['signup_email']->renderLabel();?></th>
                            <td>
                            <?php echo $signup_form['signup_email']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-right" colspan="2">
                            Already a member? <a href="<?php echo url_for('@sf_guard_signin') ?>">Login here!</a> <input type="submit" id="signup_button" value="Register" />
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="clear-both"></div>
            </div>
            <div id="general_box_corners" class="bottom">
                <div id="general_box_corner" class="bottom_left float-left"></div>
                <div id="general_box_corner" class="bottom_right float-right"></div>
            </div>
