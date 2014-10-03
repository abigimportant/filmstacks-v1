                <h2 class="align-left">Tell us what you've been watching</h2>
                <div class="box_divider"></div>
                <form action="<?php echo url_for('update/index') ?>" id="search_form" name="search_form" method="post">
                    <?php echo $search_form['film_title']->render(); ?>
                    <input type="submit" class="float-left reset" id="search_submit_button" name="submit_button" value="Search for Film" />
                </form>
                <div class="clear-both"></div>
                <div class="box_divider"></div>
                <h3>Import things to remember;</h3>
                <ol id="remember_points">
                    <li>- We are not Google! Please enter the film title as close to how it is - putting in 'Superman' for instance will not bring up all Superman movies but rather only films titled 'Superman'.</li>
                    <li>- If your film does not appear to be coming up try different versions of the film title when searching (i.e. the film 'Tekkonkinkreet' is in our database as 'Tekkon Kinkreet').</li>
                    <li class="important">- We will be improving the power of our stacking function greatly over the coming weeks - please bear with us in our stage of alpha testing!</li>
                </ul>