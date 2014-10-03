<?php if($returned_films):?>
                <h2 class="align-left">Film search results - which film was it?</h2>
                <div class="box_divider"></div>
                <ul class="<?php if (count($returned_films) == 1) { echo 'one_result'; }?>" id="search_results">
<?php foreach($returned_films as $film):?>
                <form action="<?php echo url_for('update/index') ?>" id="selection_form" name="selection_form" method="post">
                    <li class="float-left result">
                        <ul>
                            <li class="float-left search_poster"><a href="<?php echo $film->getFilmPosterSrc()?>" rel="lightbox" class="image_link" title="Film poster for <?php echo $film->getFilmTitle(); ?>"><img alt="Film poster for <?php echo $film->getFilmTitle(); ?>" class="film_poster" src="<?php echo $film->getFilmPosterSrc()?>" /></a></li>
                            <li class="float-left information">
                                <h3><a href="<?php echo $film->getFilmPath(); ?>"><?php echo $film->getFilmTitle();?> (<?php echo $film->getFilmReleaseYear();?>)</a></h3>
<?php if ($film->getFilmWikipediaSummary() != '' && $film->getFilmWikipediaSummary() != "'"):?>
<?php if (count($returned_films) == 1): ?>
                                <p><?php echo $film->getFilmWikipediaSummaryCutdown(450, true);?>  <a href="<?php echo $film->getFilmPath(); ?>" title="Read more on '<?php echo $film->getFilmTitle(); ?> (<?php echo $film->getFilmReleaseYear(); ?>)'">(read more)</a></p>
<?php else:?>
                                <p><?php echo $film->getFilmWikipediaSummaryCutdown(170);?>  <a href="<?php echo $film->getFilmPath(); ?>" title="Read more on '<?php echo $film->getFilmTitle(); ?> (<?php echo $film->getFilmReleaseYear(); ?>)'">(read more)</a></p>
<?php endif; ?>
<?php endif; ?>
                                <input type="submit" class="selection" id="submit_button" name="submit_button" value="This is the one!" />
                                <input type="hidden" id="selection_form_film" name="selection_form[film_id]" value="<?php echo $film->getFilmId();?>">
                            </li>
                        </ul>
                    </li>
                </form>
<?php endforeach;?>
                </ul>
                <div class="clear-both"></div>
                <div class="box_divider"></div>
                <p>Not what you're after? <a href="/update">Jump back to the search form</a>.</p>
<?php else:?>
                <h2 class="align-left">We did not find anything matching that criteria.</h2>
                <div class="box_divider"></div>
                <p>This could be due to a misspelling or grammatical mistake - would you like to <a href="/update">search again</a>?</p>
                <div class="clear-both"></div>
<?php endif; ?>
