            <div class="top" id="general_box_corners">
                <div class="top_left float-left" id="general_box_corner"></div>
                <div class="top_right float-right" id="general_box_corner"></div>
            </div>
            <div id="general_box">
<?php if ($form->hasGlobalErrors()): ?>
                <ul class="error_list">
<?php foreach ($form->getGlobalErrors() as $error): ?>
                    <li><?php echo $error; ?></li>
<?php endforeach; ?>
                </ul>
                <div class="box_divider"></div>
<?php endif; ?>
                <form action="<?php echo url_for('@sf_guard_signin') ?>" id="signin_form" method="post">
                    <table id="widgets">
                        <tr>
                            <th><?php echo $form['username']->renderLabel();?></th>
                            <td>
                            <?php echo $form['username']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $form['password']->renderLabel();?></th>
                            <td>
                            <?php echo $form['password']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <th><?php echo $form['remember']->renderLabel();?></th>
                            <td>
                            <?php echo $form['remember']->render();?>
                            </td>
                        </tr>
                        <tr>
                            <td class="align-right" colspan="2">
                            Not a member? <a href="<?php echo url_for('@homepage') ?>">Register.</a> <input type="submit" id="signup_button" name="signup_form[submit]" value="Login" />
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
