                <div class="top" id="primary_box_corners">
                    <div class="top_left float-left" id="primary_box_corner"></div>
                    <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
                <div class="profile_top" id="primary_box">
                    <ul id="profile_buttons" class="float-left reset">
<?php if($profile_user->getProfile()->getUserId() != $sf_user->getProfile()->getUserId()):?>
<?php if(!$profile_user->getProfile()->relationshipObject || $profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 0 || ($profile_user->getProfile()->relationshipObject->getFirstUserId() == $sf_user->getProfile()->getUserId() && $profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 2 || $profile_user->getProfile()->relationshipObject->getSecondUserId() == $sf_user->getProfile()->getUserId() && $profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 1)):?>
                        <li id="add_user_button" class="float-left">
                            <a href="/user/<?php echo $profile_user->getUsername();?>/add" title="Add <?php echo $profile_user->getUsername();?> to your friends">Add to friends</a>
                        </li>
<?php endif; ?>
<?php if($profile_user->getProfile()->relationshipObject && (($profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 3) || ($profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 1 && $profile_user->getProfile()->relationshipObject->getFirstUserId() == $sf_user->getProfile()->getUserId()) || ($profile_user->getProfile()->relationshipObject->getRelationshipStatus() == 2 && $profile_user->getProfile()->relationshipObject->getSecondUserId() == $sf_user->getProfile()->getUserId()))):?>
                        <li id="remove_user_button" class="float-left">
                            <a href="/user/<?php echo $profile_user->getUsername();?>/remove" title="Add <?php echo $profile_user->getUsername();?> to your friends">Remove friend</a>
                        </li>
<?php endif; ?>
<?php endif;?>
                    </ul>
                    <div id="user_information" class="float-right">
                        <ul id="user_details" class="float-left reset">
                            <li class="align-right">
                                <span class="username"><?php echo $profile_user->getUsername();?></span> / <span class="stack_count"><?php echo $profile_user->getProfile()->getStackCount();?> stacks</span>
<?php if ($profile_user->getProfile()->getUserFirstName() != ''):?>
                                / <?php echo $profile_user->getProfile()->getUserFirstName()?> <?php echo $profile_user->getProfile()->getUserLastName()?>
<?php endif;?>
                </li>
<?php if($profile_user->getProfile()->getUserAbout()):?>
                            <li id="about_me" class="align-right"><?php echo $profile_user->getProfile()->getUserAbout()?></li>
<?php endif;?>
                        </ul>
                        <a href="<?php echo $profile_user->getProfile()->getUserAvatarSrc(400);?>" rel="lightbox" title="<?php echo $profile_user->getUsername();?>'s picture"><img src="<?php echo $profile_user->getProfile()->getUserAvatarSrc(40);?>" alt="<?php echo $profile_user->getUsername();?>'s picture" class="float-right avatar_profile" /></a>
                        <div class="clear-both"></div>
                    </div>
                    
                    <div class="clear-both"></div>
                    
<?php if ($stacks["most_recent_stack"]):?>
                    <div class="box_divider"></div>
                    
                    <div id="most_recent_stack">
                        <div class="left_col float-left">
                            <a href="<?php echo $stacks["most_recent_stack"]->filmObject->getFilmPosterSrc()?>" rel="lightbox" class="image_link" title="Film poster for <?php echo $stacks["most_recent_stack"]->filmObject->getFilmTitle(); ?>"><img alt="Film poster for <?php echo $stacks["most_recent_stack"]->filmObject->getFilmTitle(); ?>" class="film_poster most_recent" src="<?php echo $stacks["most_recent_stack"]->filmObject->getFilmPosterSrc()?>" class="film_poster float-left" /></a>
                        </div>
                        <div class="right_col float-left">
                            <h2 id="recent_stack_title" class="float-left reset"><a href="<?php echo $stacks["most_recent_stack"]->filmObject->getFilmPath(); ?>" title="<?php echo $stacks["most_recent_stack"]->filmObject->getFilmTitle(); ?> (<?php echo $stacks["most_recent_stack"]->filmObject->getFilmReleaseYear(); ?>)"><?php echo $stacks["most_recent_stack"]->filmObject->getFilmTitle(); ?> (<?php echo $stacks["most_recent_stack"]->filmObject->getFilmReleaseYear(); ?>)</a></h2>
                            <div class="tag_corner left float-left"></div>
                            <div class="tag_word float-left"><?php echo $stacks["most_recent_stack"]->wordObject->getWordWord();?></div>
                            <div class="tag_corner right float-left"></div>
<?php if($stacks["most_recent_stack"]->filmObject->getFilmWikipediaSummary() && $stacks["most_recent_stack"]->filmObject->getFilmWikipediaSummary() != "'"):?>
                                <p class="float-left reset"><?php echo $stacks["most_recent_stack"]->filmObject->getFilmWikipediaSummaryCutdown(400, true);?> <a href="<?php echo $stacks["most_recent_stack"]->filmObject->getFilmPath(); ?>" title="Read more on '<?php echo $stacks["most_recent_stack"]->filmObject->getFilmTitle(); ?> (<?php echo $stacks["most_recent_stack"]->filmObject->getFilmReleaseYear(); ?>)'">(read more)</a></p>
<?php endif;?>
                            <div class="clear-left"></div>
                            <ul class="stack_details float-left reset">
                                <li class="times_stacked float-left">Stacked <?php echo $profile_user->getProfile()->getStackCountFilm($stacks["most_recent_stack"]->filmObject->getFilmId(), true);?></li>
                                <li class="comments_made float-left"><a href="/stack/<?php echo $stacks["most_recent_stack"]->getStackId();?>#comments" title="view and respond too comments"><?php echo $stacks["most_recent_stack"]->getCommentCount();?> comments</a></li>
                                <li class="stacked_date float-left">stacked <?php echo $stacks["most_recent_stack"]->getTimeSince();?> ago</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="clear-both"></div>
                <?php endif; ?>
                </div>
                <div id="primary_box_corners" class="bottom">
                    <div id="primary_box_corner" class="bottom_left float-left"></div>
                    <div id="primary_box_corner" class="bottom_right float-right"></div>
                </div>  
                
                <div class="gap"></div>

<?php if (count($stacks["feed_stacks"]) > 0): ?>
                <ul id="stack_feed" class="reset">
<?php foreach ($stacks["feed_stacks"] as $stack):?>
                    <li>
                        <div class="secondary_box_corners top">
                            <div class="secondary_box_corner top_left float-left"></div>
                            <div class="secondary_box_corner top_right float-right"></div>
                        </div>
                        <div class="feed_item secondary_box">
                            <div class="left_col float-left">
                                <a href="<?php echo $stack->filmObject->getFilmPosterSrc()?>" class="image_link" rel="lightbox" title="Film poster for <?php echo $stack->filmObject->getFilmTitle(); ?>"><img alt="Film poster for <?php echo $stack->filmObject->getFilmTitle(); ?>" class="film_poster" src="<?php echo $stack->filmObject->getFilmPosterSrc()?>" width="55px" height="84px" /></a>
                            </div>
                            <div class="middle_col float-left">
                                <h3 class="float-left reset"><a href="<?php echo $stack->filmObject->getFilmPath(); ?>" title="<?php echo $stack->filmObject->getFilmTitle(); ?> (<?php echo $stack->filmObject->getFilmReleaseYear(); ?>)"><?php echo $stack->filmObject->getFilmTitle(); ?> (<?php echo $stack->filmObject->getFilmReleaseYear(); ?>)</a></h3>
                                <div class="small_tag_corner left float-left"></div>
                                <div class="small_tag_word float-left"><?php echo $stack->wordObject->getWordWord();?></div>
                                <div class="small_tag_corner right float-left"></div>
<?php if ($stack->filmObject->getFilmWikipediaSummary() && $stack->filmObject->getFilmWikipediaSummary() != "'"):?>
                                <p class="reset float-left"><?php echo $stack->filmObject->getFilmWikipediaSummaryCutdown(150);?> <a href="<?php echo $stack->filmObject->getFilmPath(); ?>" title="Read more on '<?php echo $stack->filmObject->getFilmTitle(); ?> (<?php echo $stack->filmObject->getFilmReleaseYear(); ?>)'">(read more)</a></p>
<?php endif;?>
                                <div class="clear-left"></div>
                                <div class="stack_details float-left">
                                    <span class="times_stacked reset float-left">Stacked <?php echo $profile_user->getProfile()->getStackCountFilm($stack->filmObject->getFilmId(), true);?></span>
                                    <span class="comments_made reset float-left"><a href="/stack/<?php echo $stack->getStackId();?>#comments" class="" title="view and respond too comments"><?php echo $stack->getCommentCount();?> comments</a></span>
                                    <span class="stacked_date reset float-left">stacked <?php echo $stack->getTimeSince();?> ago</span>
                                </div>
                            </div>
                            <div class="right_col float-right">
<?php if($stack->getGroupId()): ?>
<?php foreach($stack->groupMembers as $group_member):?>
                                <a href="/user/<?php echo $group_member->getUsername();?>" title="Go to <?php echo $group_member->getUsername();?>'s page" class="float-right"><img src="<?php echo $group_member->getProfile()->getUserAvatarSrc(40);?>" class="avatar_feed"/></a>
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
<?php endforeach;?>
                </ul>
<?php endif;?>

<?php if ($stacks_pager->haveToPaginate()):?>
                <div id="pagination_container" class="float-right">
                    <?php if ($current_page != $stacks_pager->getLastPage()): ?><div class="pagination_button float-right"><a href="/user/<?php echo $profile_user->getUsername();?>/page/<?php echo $stacks_pager->getNextPage() ?>">Older</a></div><?php endif;?>
                    <?php if ($current_page != $stacks_pager->getFirstPage()): ?><div class="pagination_button float-right"><a href="/user/<?php echo $profile_user->getUsername();?>/page/<?php echo $stacks_pager->getPreviousPage() ?>">Newer</a></div><?php endif;?>
                </div>
                <div class="clear-both"></div>
                <?php endif; ?>