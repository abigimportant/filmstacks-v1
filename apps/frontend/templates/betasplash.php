<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="/css/home/betasplash.css" />    
        <link rel='shortcut icon' href='/images/favicon.ico' />
    </head>
    <body>
        <div id="container">
            <div id="logo_container">
                <div id="logo"><h1>Filmstacks</h1></div>
<?php if ($sf_context->getModuleName() == 'home'):?>
                <p>Filmstacks is currently in a stage of very early invite-only alpha - if you have an alpha access code you can enter it below to join in.</p>
<?php elseif ($sf_context->getModuleName() == 'sfGuardAuth'):?>
                <p>Filmstacks is currently in a stage of very early invite-only alpha - if you have an account please login below.</p>
<?php endif;?>
            </div>

            <div class="gap"></div>
            <?php echo $sf_content; ?>

            <div id="twitter">
                <ul class="float-left" id="nick_twitter">
                    <li class="float-left" id="nick_picture"><h2>Nick Pellant</h2></li>
                    <li class="float-left" id="nick_text"><a href="http://twitter.com/npellant" title="Follow on Twitter for updates and more!">@npellant</a><br />
                    CEO, Developer, <br /> Designer, <br /> TV Obsessive.<br />
                    </li>
                </ul>
                <ul class="float-left" id="lewis_twitter">
                    <li class="float-right" id="lewis_picture"><h2>Lewis Forbes</h2></li>
                    <li class="float-right align-right" id="lewis_text"><a href="http://twitter.com/LewisForbes" title="Follow on Twitter for updates and more!">@LewisForbes</a><br />
                    Community Manager, <br /> Poptart Fiend, <br /> General Complainer.<br />
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>