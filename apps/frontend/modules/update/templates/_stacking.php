                <form action="<?php echo url_for('update/index') ?>" id="stacking_form" name="stacking_form" method="post">
                <ul>
                    <li id="stacking_film_poster" class="float-left"><a href="<?php echo $film->getFilmPosterSrc()?>" class="image_link" rel="lightbox" title="Film poster for <?php echo $film->getFilmTitle(); ?>"> <img src="<?php echo $film->getFilmPosterSrc()?>" class="stack_form film_poster" /></a></li>
                    <li id="stacking_information" class="float-left">
                        <h2><a href="<?php echo $film->getFilmPath();?>"><?php echo $film->getFilmTitle();?> (<?php echo $film->getFilmReleaseYear();?>)</a></h2>
                        <p><?php echo $film->getFilmWikipediaSummaryCutdown(300, true);?> <a href="<?php echo $film->getFilmPath(); ?>">(read more)</a></p>
                        <table id="widgets">
                            <tr>
                                <th class="align-left"><?php echo $stacking_form['film_words']->renderLabel();?></th>
                                <td class="align-left">
                                <?php echo $stacking_form['film_words']->render();?>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-left"><?php echo $stacking_form['film_recommend']->renderLabel();?></th>
                                <td class="align-left">
                                <?php echo $stacking_form['film_recommend']->render();?>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-left" colspan="2">
                                <input type="submit" class="stacking" id="stacking_submit_button" name="submit_button" value="Stack it!" />
                                <input type="hidden" id="stacking_form_film" name="stacking_form_film_id" value="<?php echo $film->getFilmId();?>">
                                </td>
                            </tr>
                        </table> 
                    </li>
                </ul>
                </form>
                <div class="clear-both"></div>