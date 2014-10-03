                <div class="top" id="primary_box_corners">
                    <div class="top_left float-left" id="primary_box_corner"></div>
                    <div class="top_right float-right" id="primary_box_corner"></div>
                </div>
<?php if ($profile_user->getProfile()->getFriendTotal() > 0):?>
                <div class="friends_box" id="primary_box">
                    <h2 class="align-left"><?php echo $profile_user->getUsername();?> friends (<?php echo $profile_user->getProfile()->getFriendTotal();?>)</h2>
                    <div class="box_divider"></div>
                    <ul id="friends_list">
<?php foreach($friends as $friend):?>
                        <li class="float-left"><a href="/user/<?php echo $friend->getUsername();?>"><img src="<?php echo $friend->getProfile()->getUserAvatarSrc(60);?>" class="float-left avatar_friendpage" /></a></li>
<?php endforeach;?>
                    </ul>
                    <div class="clear-both"></div>
                </div>
<?php else:?>
                <div class="notice_message" id="primary_box">
                    <h2><?php echo $profile_user->getUsername();?> is yet to make friends at Filmstacks.</h2>
                    <h3><a href="/user/<?php echo $profile_user->getUsername();?>/add" title="Add to your friends">perhaps you'd like to be their friend?</a></h3>
                </div>
<?php endif; ?>
                <div id="primary_box_corners" class="bottom">
                    <div id="primary_box_corner" class="bottom_left float-left"></div>
                    <div id="primary_box_corner" class="bottom_right float-right"></div>
                </div>