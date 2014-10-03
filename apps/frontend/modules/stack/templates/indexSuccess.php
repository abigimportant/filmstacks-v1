                <div class="top" id="primary_box_corners">
                    <div class="top_left float-left" id="primary_box_corner"></div>
                    <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
                <div class="stack_top_box" id="primary_box">
                    <div class="left_col float-left">
                        <a href="<?php echo $stack->filmObject->getFilmPosterSrc()?>" class="image_link" rel="lightbox" title="Film poster for <?php echo $stack->filmObject->getFilmTitle(); ?>"> <img src="<?php echo $stack->filmObject->getFilmPosterSrc()?>" class="film_poster single_stack float-left" /></a>
                    </div>
                    <div class="right_col float-left">
                        <h2 class="reset">
                            <a href="<?php echo $stack->filmObject->getFilmPath();?>"><?php echo $stack->filmObject->getFilmTitle();?> (<?php echo $stack->filmObject->getFilmReleaseYear();?>)</a>
                        </h2>
<?php if($stack->filmObject->getFilmWikipediaSummary()):?>
                        <p id="film_summary" class="reset"><?php echo $stack->filmObject->getFilmWikipediaSummaryCutdown(350, true);?> <a href="<?php echo $stack->filmObject->getFilmPath(); ?>">(read more)</a></p>
<?php endif;?>
                        <div class="clear-left"></div>
                        <ul class="stack_details float-left reset">
                            <li class="times_stacked float-left">1st time stacked</li>
                            <li class="comments_made float-left"><a href="#comments" title="view and respond too comments"><?php echo $stack->getCommentCount();?> comments</a></li>
                            <li class="stacked_date float-left">stacked <?php echo $stack->getTimeSince();?> ago</li>
                        </ul>
                    </div>
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
                
                <div id="users_box" class="secondary_box">
                    <h2>Stack Participants</h2>
                    <div class="box_divider"></div>
                    <ul id="group_users" class="reset">
<?php if (count($stack->groupMembers) > 0):?>
<?php foreach ($stack->groupMembers as $group_member):?>
                        <li class="float-left"></li>
<?php endforeach;?>
<?php else:?>
                        <li class="float-left align-center"><a href="/user/<?php echo $stack->userObject->getUsername();?>" title="<?php echo $stack->userObject->getUsername();?>"><img src="<?php echo $stack->userObject->getProfile()->getUserAvatarSrc(60);?>" class="float-left avatar_stackpage" alt="<?php echo $stack->userObject->getUsername();?>" /></a></li>
<?php endif;?>
                    </ul>
                    <div class="clear-both"></div>
                </div>
                <div class="secondary_box_corners bottom">
                    <div class="secondary_box_corner bottom_left float-left"></div>
                    <div class="secondary_box_corner bottom_right float-right"></div>
                </div>

                <div class="gap"></div>
                
                <div class="secondary_box_corners top">
                    <div class="secondary_box_corner top_left float-left"></div>
                    <div class="secondary_box_corner top_right float-right"></div>
                </div>
                <div id="comment_form_box" class="secondary_box">
                    <form action="/stack/<?php echo $stack->getStackId();?>" id="comment_form" method="post">
                        <h2>Have something to say? (500 character limit)</h2>
                        <div class="box_divider"></div>
                        
                        <?php if ($comment_form->hasErrors()): ?>
                        <ul class="error_list">
                        <?php foreach ($comment_form->getErrorSchema() as $error): ?>
                          <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                        </ul>
                        <div class="box_divider"></div>
                        <?php endif; ?>
                        
                        <div class="left_col float-left">
                            <img src="<?php echo $sf_user->getProfile()->getUserAvatarSrc(60);?>" class="float-left avatar_stackpage" alt="<?php echo $sf_user->getUsername();?>" />
                        </div>
                        <div class="right_col float-left">
                            <?php echo $comment_form['comment_field']->renderLabel();?>
                            <?php echo $comment_form['comment_field']->render();?>
                            <br />
                            <input type="submit" class="float-right" id="comment_submit_button" name="comment_submit_button" value="Submit" />
                        </div>
                        <div class="clear-both"></div>
                    </form>
                </div>
                <div class="secondary_box_corners bottom">
                    <div class="secondary_box_corner bottom_left float-left"></div>
                    <div class="secondary_box_corner bottom_right float-right"></div>
                </div>
                
<?php if(count($stack->commentObjects) > 0):?>
<?php foreach ($stack->commentObjects as $comment):?>
<?php $comment->fetchUserObject(); ?>
                <div class="gap"></div>
                <ul>
                    <li class="comment_avatar float-left">
                        <a href="/user/<?php echo $comment->userObject->getUsername();?>" title="Go to the profile of <?php echo $comment->userObject->getUsername();?>" class="no-borders"><img src="<?php echo $comment->userObject->getProfile()->getUserAvatarSrc(40);?>" class="avatar_comment" alt="<?php echo $comment->userObject->getUsername();?>"></a>
                    </li>
                    <li class="comment_item float-left">
                        <div class="comment_box_corners top">
                            <div class="comment_box_corner top_left float-left"></div>
                            <div class="comment_box_corner top_right float-right"></div>
                        </div>
                        <div class="comment_box">
                            <div class="arrow float-left">
                            </div>
                            <div class="content float-left">
                                <p><?php echo $comment->getStackCommentComment();?></p>
                                <div class="box_divider"></div>
                                <p class="meta">Comment by <a href="/user/<?php echo $comment->userObject->getUsername();?>" title="Go to the profile of <?php echo $comment->userObject->getUsername();?>"><?php echo $comment->userObject->getUsername();?></a> <?php echo $comment->getTimeSince();?> ago.</p>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                        <div class="comment_box_corners bottom">
                            <div class="comment_box_corner bottom_left float-left"></div>
                            <div class="comment_box_corner bottom_right float-right"></div>
                        </div>
                    </li>
                </ul>
                <div class="clear-both"></div>
<?php endforeach; ?>
<?php endif; ?>