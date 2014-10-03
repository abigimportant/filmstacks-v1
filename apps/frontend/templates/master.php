<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<?php include_stylesheets() ?>
	    <link href="/images/global/favicon.ico" rel="shortcut icon" />
	    <link href="/images/global/iphoneicon.png" rel="apple-touch-icon" />
    </head>
    <body>
        <div id="container">
            <div id="header">
<?php if($sf_user->isAuthenticated()): ?>
                <a class="float-left" href="<?php echo url_for('@user_home') ?>" id="filmstacks_logo_a" rel="home" title="Home">
<?php else: ?>
                <a class="float-left" href="<?php echo url_for('@homepage') ?>" id="filmstacks_logo_a" rel="index" title="Index">
<?php endif; ?>
                    <div class="float-left" id="filmstacks_logo"></div>
                    <h1 class="float-left reset" id="filmstacks_word" >Filmstacks.</h1>
                </a>
                
                <ul class="float-right reset" id="primary_navigation">
                    <li class="float-right"><a href="<?php echo url_for('@sf_guard_signout') ?>" title="Leaving so soon?">Logout</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="<?php echo url_for('@content_about') ?>" title="About the site and the team">About</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="<?php echo url_for('@account_settings') ?>" title="Modify account details &amp; settings">Settings</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="/user/<?php echo $sf_user->getUsername() ?>" title="Go to your profile">Profile</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="<?php echo url_for('@public_feed') ?>" title="View the public feed and see what everyone's watching">Public Feed</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="<?php echo url_for('@stack_form')?>" title="Stack a film">Stack a Film</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="<?php echo url_for('@user_home') ?>" title="Go to your home feed of stacks">Home</a></li>
                </ul>
<?php if ($sf_context->getModuleName() == 'user'):?>

                <div class="clear-both"></div>
                <ul class="float-right reset" id="secondary_navigation">
                    <li class="float-right"><a href="/user/<?php echo $sf_params->get('username');?>/friends">Friends</a></li>
                    <li class="float-right splitter">/</li>
                    <li class="float-right"><a href="/user/<?php echo $sf_params->get('username');?>">Profile Feed</a></li>
                </ul>
<?php endif;?>
            </div>
            
            <div class="clear-both"></div>
            
            <div id="content">
<?php echo $sf_content ?>
            </div>
            
            <div class="gap"></div>
            
            <div id="general_box_corners" class="top">
              <div id="general_box_corner" class="top_left float-left"></div>
              <div id="general_box_corner" class="top_right float-right"></div>
            </div>
            <div class="advertisment" id="general_box">
                <img src="https://www.google.com/adsense/static/en_US/images/leaderboard.gif">
            </div>
            <div id="general_box_corners" class="bottom">
              <div id="general_box_corner" class="bottom_left float-left"></div>
              <div id="general_box_corner" class="bottom_right float-right"></div>
            </div>
            
            <div class="gap"></div>
            
            <div id="general_box_corners" class="top">
              <div id="general_box_corner" class="top_left float-left"></div>
              <div id="general_box_corner" class="top_right float-right"></div>
            </div>
            <div class="footer align-center" id="general_box">
                <p><a href="/" title="Filmstacks">Filmstacks</a> copyright 2009 - all rights are reserved.</p>
                <p>A big thanks goes out to <a href="http://wikipedia.org/" title="Wikipedia - The hub of information.">Wikipedia</a> for all our film content.</p>
            </div>
            <div id="general_box_corners" class="bottom">
              <div id="general_box_corner" class="bottom_left float-left"></div>
              <div id="general_box_corner" class="bottom_right float-right"></div>
            </div>
        </div>
    </body>
<?php include_javascripts() ?>
</html>