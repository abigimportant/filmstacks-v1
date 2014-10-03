      <div class="top" id="primary_box_corners">
        <div class="top_left float-left" id="primary_box_corner"></div>
        <div class="top_right float-right" id="primary_box_corner"></div>
      </div>
      <div class="film_top_box" id="primary_box">
        <h2 class="reset float-left">
          <a href="<?php echo $film->getFilmPath();?>"><?php echo $film->getFilmTitle();?> (<?php echo $film->getFilmReleaseYear();?>)</a>
        </h2>
        <ul class="float-right reset" id="film_stack_counters">
          <li class="align-center float-right"><span class="number"><?php echo $film->getTotalStackCount();?></span><br />Global Stacks</li>
          <li class="align-center float-right"><span class="number"><?php echo $sf_user->getProfile()->getStackCountFilm($film->getFilmId());?></span><br />Personal Stacks</li>
        </ul>
        <div class="clear-both"></div>
        <div class="box_divider"></div>
       <a href="<?php echo $film->getFilmPosterSrc()?>" class="image_link" rel="lightbox" title="Film poster for <?php echo $film->getFilmTitle(); ?>"> <img src="<?php echo $film->getFilmPosterSrc()?>" width="119px" height="177px" class="film_poster float-left" /></a>
<?php if ($film->getFilmWikipediaSummary() && $film->getFilmWikipediaSummary() != "'"):?>
        <p id="film_summary" class="reset"><?php echo $film->getFilmWikipediaSummaryCutdown(750, true);?> <a href="http://en.wikipedia.org/wiki/<?php echo $film->getFilmWikipediaTitle()?>">(find out more at Wikipedia)</a></p>
<?php else: ?>
        <p id="film_summary" class="reset">We have no film summary for <?php echo $film->getFilmTitle();?> - you can however <a href="http://en.wikipedia.org/wiki/<?php echo $film->getFilmWikipediaTitle()?>">find out more about it at Wikipedia.</a></p>
<?php endif; ?>
        <div class="clear-both"></div>
      </div>
      <div id="primary_box_corners" class="bottom">
        <div id="primary_box_corner" class="bottom_left float-left"></div>
        <div id="primary_box_corner" class="bottom_right float-right"></div>
      </div>
      <div class="gap"></div>
      <div class="secondary_box_corners top">
        <div class="secondary_box_corner top_left float-left"></div>
        <div class="secondary_box_corner top_right float-right"></div>
      </div>
      <div id="affiliates_box" class="secondary_box">
        <ul id="film_affiliates" class="reset">
          <li id="amazon_affiliate" class="affiliate"><a href="http://www.amazon.co.uk/s/ref=nb_ss_w_h_?url=search-alias%3Ddvd&field-keywords=<?php echo str_replace(' ', '+', $film->getFilmTitle());?>+<?php echo $film->getFilmReleaseYear();?>&x=0&y=0&tag=filmstackstv-21&camp=1634"><img src="/images/film/amazon_logo.jpg"></a></li>
        </ul>
        <div class="clear-both"></div>
      </div>
      <div class="secondary_box_corners bottom">
        <div class="secondary_box_corner bottom_left float-left"></div>
        <div class="secondary_box_corner bottom_right float-right"></div>
      </div>
<?php if ($film->getRecommendationTotals() && $stacks):?>
      <div class="gap"></div>
      <div class="secondary_box_corners top">
        <div class="secondary_box_corner top_left float-left"></div>
        <div class="secondary_box_corner top_right float-right"></div>
      </div>
			<div id="recommendation_totals" class="secondary_box">
			  <div id="positive_percentage" class="align-center float-left">
			    <h2><?php echo $film->positive_percentage; ?>%</h2>
			    <h3>Recommend watching!</h3>
			  </div>
			  <div id="negative_percentage" class="align-center float-left">
			    <h2><?php echo $film->negative_percentage; ?>%</h2>
			    <h3>Don't recommend this</h3>
			  </div>
			  <div class="clear-both"></div>
      </div>
			<div class="secondary_box_corners bottom">
        <div class="secondary_box_corner bottom_left float-left"></div>
        <div class="secondary_box_corner bottom_right float-right"></div>
      </div>
<?php endif; ?>
<?php if ($stacks):?>
      <div class="gap"></div>
      <div class="secondary_box_corners top">
        <div class="secondary_box_corner top_left float-left"></div>
        <div class="secondary_box_corner top_right float-right"></div>
      </div>
			<div id="word_cloud" class="secondary_box">
			  <?php echo $film->getWordCloud();?>
      </div>
			<div class="secondary_box_corners bottom">
        <div class="secondary_box_corner bottom_left float-left"></div>
        <div class="secondary_box_corner bottom_right float-right"></div>
      </div>
<?php endif; ?>
<?php if ($stacks):?>
      <div class="gap"></div>
      <ul id="recent_watches_feed" class="reset">
        <?php foreach($stacks as $stack):?>
        <li>
          <div class="secondary_box_corners top">
            <div class="secondary_box_corner top_left float-left"></div>
            <div class="secondary_box_corner top_right float-right"></div>
          </div>
          <div class="secondary_box">
            <a href="/user/<?php echo $stack->userObject->getUsername();?>"><img src="<?php echo $stack->userObject->getProfile()->getUserAvatarSrc('30');?>" class="float-left avatar_filmpage" /></a>
            <div class="feed_text_and_links" class="float-left">
              <h3 class="reset float-left"><a href="/user/<?php echo $stack->userObject->getUsername();?>"><?php echo $stack->userObject->getUsername();?></a></h3>
<?php if($stack->wordObject):?>
              <div class="small_tag_corner left float-left"></div>
              <div class="small_tag_word float-left"><?php echo $stack->wordObject->getWordWord();?></div>
              <div class="small_tag_corner right float-left"></div>
<?php endif;?>
              <div class="small_stack_details"><span class="times_stacked reset float-left">Stacked <?php echo $stack->userObject->getProfile()->getStackCountFilm($film->getFilmId(), true);?></span></div>
            </div>
            <div class="stacked_date reset align-right float-right">stacked <?php echo $stack->getTimeSince();?> ago</div>
            <div class="clear-both"></div>
          </div>
          <div class="secondary_box_corners bottom">
            <div class="secondary_box_corner bottom_left float-left"></div>
            <div class="secondary_box_corner bottom_right float-right"></div>
          </div>
        </li>
        <?endforeach;?>
      </ul>
<?php endif;?>