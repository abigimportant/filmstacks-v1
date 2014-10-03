                <div class="top" id="primary_box_corners">
                    <div class="top_left float-left" id="primary_box_corner"></div>
                    <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
                <div class="alpha_notice" id="primary_box">
                <h2>Important notice!</h2>
                <p>Welcome! We are currently in the very early stages of our site development. If you come across any bugs or have any feedback for us we'd love to hear from you! To get in touch you can message either <a href="http://twitter.com/LewisForbes" title="Lewis on Twitter">Lewis</a> or <a href="http://twitter.com/npellant" title="Nick on Twitter">Nick</a> on Twitter or shoot us a <a href="mailto:staff@filmstacks.tv" title="Email the team">direct email</a>. To find out what's coming in the future for Filmstacks take a look at our <a href="/coming_soon">coming soon list</a>.
                </div>
                <div id="primary_box_corners" class="bottom">
                    <div id="primary_box_corner" class="bottom_left float-left"></div>
                    <div id="primary_box_corner" class="bottom_right float-right"></div>
                </div>
                
                <div class="gap"></div>

<?php if($stacks):?>
                <ul id="stack_feed" class="reset">
<?php foreach($stacks as $stack):?>
                    <li>
                        <div class="secondary_box_corners top">
                            <div class="secondary_box_corner top_left float-left"></div>
                            <div class="secondary_box_corner top_right float-right"></div>
                        </div>
                        <div class="feed_item secondary_box">
                            <div class="left_col float-left">
                                <a href="<?php echo $stack->filmObject->getFilmPosterSrc()?>" class="image_link" rel="lightbox" title="Film poster for <?php echo $stack->filmObject->getFilmTitle(); ?>"><img alt="Film poster for <?php echo $stack->filmObject->getFilmTitle(); ?>" class="film_poster" src="<?php echo $stack->filmObject->getFilmPosterSrc()?>" /></a>
                            </div>
                        
                            <div class="middle_col float-left">
                                <h3 class="float-left reset"><a href="<?php echo $stack->filmObject->getFilmPath(); ?>" title="<?php echo $stack->filmObject->getFilmTitle(); ?> (<?php echo $stack->filmObject->getFilmReleaseYear(); ?>)"><?php echo $stack->filmObject->getFilmTitle(); ?> (<?php echo $stack->filmObject->getFilmReleaseYear(); ?>)</a></h3>
<?php if ($stack->wordObject->getWordWord()):?>
                                <div class="small_tag_corner left float-left"></div>
                                <div class="small_tag_word float-left"><?php echo $stack->wordObject->getWordWord();?></div>
                                <div class="small_tag_corner right float-left"></div>
<?php endif; ?>        
<?php if($stack->filmObject->getFilmWikipediaSummary() && $stack->filmObject->getFilmWikipediaSummary() != "'"):?>
                                <p class="reset float-left"><?php echo $stack->filmObject->getFilmWikipediaSummaryCutdown(150, true);?> <a href="<?php echo $stack->filmObject->getFilmPath(); ?>" title="Read more on '<?php echo $stack->filmObject->getFilmTitle(); ?> (<?php echo $stack->filmObject->getFilmReleaseYear(); ?>)'">(read more)</a></p>
<?php endif;?>        
                                <div class="clear-left"></div>
                                <div class="stack_details float-left">
                                    <span class="times_stacked reset float-left">Stacked <?php echo $stack->userObject->getProfile()->getStackCountFilm($stack->filmObject->getFilmId(), true);?></span>
                                    <span class="comments_made reset float-left"><a href="/stack/<?php echo $stack->getStackId();?>#comments" rel="facebox" class="" title="view and respond to comments"><?php echo $stack->getCommentCount();?> comments</a></span>
                                    <span class="stacked_date reset float-left">stacked <?php echo $stack->getTimeSince();?> ago</span>
                                </div>
                            </div>
                        
                            <div class="right_col float-right">
                                <a href="/user/<?php echo $stack->userObject->getUsername();?>" title="Go to <?php echo $stack->userObject->getUsername();?>'s page" class="float-right"><img src="<?php echo $stack->userObject->getProfile()->getUserAvatarSrc(40);?>" class="avatar_feed"/></a>
<?php if($stack->getGroupId()): ?>
<?php foreach($stack->groupMembers as $group_member):?>
                                <a href="/user/<?php echo $group_member->getUsername();?>" title="Go to <?php echo $group_member->getUsername();?>'s page" class="float-right"><img src="<?php echo $stack->userObject->getProfile()->getUserAvatarSrc(40);?>" class="avatar_feed" /></a>
<?php endforeach;?>
<?php endif;?>
                                <div class="clear-right"></div>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                        <div class="secondary_box_corners bottom">
                            <div class="secondary_box_corner bottom_left float-left"></div>
                            <div class="secondary_box_corner bottom_right float-right"></div>
                        </div>
                    </li>
<?endforeach;?>
            </ul>
<?php else:?>
                <div class="top" id="primary_box_corners">
                    <div class="top_left float-left" id="primary_box_corner"></div>
                    <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
                <div class="notice_message" id="primary_box">
                    <h2>Your feed is empty!</h2>
                    <h3>Your home feed has no stacks to display at present. You can change this by..</h3>
                    <div class="box_divider"></div>
                    <ul id="notices">
                        <li><a href="<?php echo url_for('@stack_form')?>" title="Get stacking!">..stacking your first film to Filmstacks</a>.</li>
                        <li>..adding some friends who have added stacks.</li>
                    </ul>
                </div>
                <div id="primary_box_corners" class="bottom">
                    <div id="primary_box_corner" class="bottom_left float-left"></div>
                    <div id="primary_box_corner" class="bottom_right float-right"></div>
                </div>
<?php endif;?>

<?php if ($stacks_pager->haveToPaginate()):?>
                <div id="pagination_container" class="float-right">
                    <?php if ($current_page != $stacks_pager->getLastPage()): ?><div class="pagination_button float-right"><a href="/home/page/<?php echo $stacks_pager->getNextPage() ?>">Older</a></div><?php endif;?>
                    <?php if ($current_page != $stacks_pager->getFirstPage()): ?><div class="pagination_button float-right"><a href="/home/page/<?php echo $stacks_pager->getPreviousPage() ?>">Newer</a></div><?php endif;?>
                </div>
                <div class="clear-both"></div>
<?php endif; ?>