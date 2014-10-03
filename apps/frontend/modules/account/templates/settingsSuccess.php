                <div class="top" id="primary_box_corners">
                  <div class="top_left float-left" id="primary_box_corner"></div>
                  <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
                <div class="settings_form_box" id="primary_box">
                  <h2 class="align-left">Profile</h2>
                  <div class="box_divider"></div>
                  <?php if ($settings_form->hasErrors()): ?>
                  <ul class="error_list">
                  <?php foreach ($settings_form->getErrorSchema() as $error): ?>
                      <li><?php echo $error; ?></li>
                  <?php endforeach; ?>
                  </ul>
                  <div class="box_divider"></div>
                  <?php endif; ?>
                  <form action="<?php echo url_for('account/settings') ?>" id="settings_form" method="post">
                      <table id="widgets">
                           <tr>
                               <th class="align-left"><?php echo $settings_form['settings_fname']->renderLabel();?></th>
                               <td class="align-left">
                               <?php echo $settings_form['settings_fname']->render();?>
                               </td>
                           </tr>
                           <tr>
                               <th class="align-left"><?php echo $settings_form['settings_lname']->renderLabel(); ?></th>
                               <td class="align-left">
                               <?php echo $settings_form['settings_lname']->render();?>
                               </td>
                           </tr>
                           <tr>
                               <th class="align-left"><?php echo $settings_form['settings_about']->renderLabel(); ?></th>
                               <td class="align-left">
                               <?php echo $settings_form['settings_about']->render();?>
                               </td>
                           </tr>
                           <tr>
                               <td class="align-right" colspan="2">
                                   <input type="submit" id="settings_submit_button" name="settings_submit_button" value="Save" />
                               </td>
                           </tr>
                      </table>
                </form>
                <div class="clear-both"></div>
                
                <h2 class="align-left">Email/Password</h2>
                <h4>To modify your email/password you must enter your current password.</h4>
                <div class="box_divider"></div>
                <?php if ($settings_form_protected->hasErrors() || count($custom_errors['protected_errors']) != 0): ?>
                <ul class="error_list">
                <?php if ($settings_form_protected->hasErrors()): ?>
                <?php foreach ($settings_form_protected->getErrorSchema() as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if (count($custom_errors['protected_errors']) != 0): ?>
                <?php foreach ($custom_errors['protected_errors'] as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
                <?php endif; ?>
                </ul>
                <div class="box_divider"></div>
                <?php endif; ?>
                <form action="<?php echo url_for('account/settings') ?>" id="settings_form_protected" method="post">
                  <table id="widgets">
                       <tr>
                           <th class="align-left"><?php echo $settings_form_protected['settings_curpass']->renderLabel();?></th>
                           <td class="align-left">
                           <?php echo $settings_form_protected['settings_curpass']->render();?>
                           </td>
                       </tr>
                       <tr>
                           <th class="align-left"><?php echo $settings_form_protected['settings_email']->renderLabel();?></th>
                           <td class="align-left">
                           <?php echo $settings_form_protected['settings_email']->render();?>
                           </td>
                       </tr>
                       <tr>
                           <th class="align-left"><?php echo $settings_form_protected['settings_newpass']->renderLabel();?></th>
                           <td class="align-left">
                           <?php echo $settings_form_protected['settings_newpass']->render();?>
                           </td>
                       </tr>
                       <tr>
                           <td class="align-right" colspan="2">
                               <input type="submit" id="settings_submit_button" name="settings_protected_submit_button" value="Save" />
                           </td>
                       </tr>
                  </table>
                </form>
                <div class="clear-both"></div>
                
                
                <h2 class="align-left">Profile Photo</h2>
                <h4>You may upload a photo for usage on the site here - We will attempt to use a <a href="http://gravatar.com/" title="Gravatar">Gravatar</a> associated with your email otherwise.</h4>
                <div class="box_divider"></div>
                <?php if ($settings_form_photo->hasErrors() || count($custom_errors['photo_errors']) != 0): ?>
                <ul class="error_list">
                <?php if ($settings_form_photo->hasErrors()): ?>
                <?php foreach ($settings_form_photo->getErrorSchema() as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php if (count($custom_errors['photo_errors']) != 0): ?>
                <?php foreach ($custom_errors['photo_errors'] as $error): ?>
                  <li><?php echo $error; ?></li>
                <?php endforeach; ?>
                <?php endif; ?>
                </ul>
                <div class="box_divider"></div>
                <?php endif; ?>
                <form action="<?php echo url_for('account/settings') ?>" id="settings_form_photo" method="post" enctype="multipart/form-data">
                  <table id="widgets">
                       <tr>
                           <th class="align-left"><?php echo $settings_form_photo['settings_photo']->renderLabel();?></th>
                           <td class="align-left">
                           <?php echo $settings_form_photo['settings_photo']->render();?>
                           </td>
                       </tr>
                       <tr>
                           <td class="align-right" colspan="2">
                               <input type="submit" id="settings_submit_button" name="settings_photo_submit_button" value="Upload" />
                           </td>
                       </tr>
                  </table>
                </form>
                <div class="clear-both"></div>
                
                </div>
                <div id="primary_box_corners" class="bottom">
                  <div id="primary_box_corner" class="bottom_left float-left"></div>
                  <div id="primary_box_corner" class="bottom_right float-right"></div>
                </div>