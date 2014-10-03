<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
      #### Require all PEAR packages that are in use by Filmstacks ####
      // Image Packages
      require_once 'Image/Transform.php';
      // Text Packages
      require_once 'Text/Wiki.php';
      require_once 'Text/Wiki/Mediawiki.php';
      require_once "Text/Password.php";
      // HTML Packages
      require_once 'HTML/TagCloud.php';
      // HTTP Packages
      require_once 'HTTP/Request2.php';
      // Net Packages
      require_once 'Net/URL2.php';
      // Individual specific packages
      require_once 'Date.php';
      require_once "Mail.php"; 
      // Service Packages
      require_once 'Services/TinyURL.php';
      require_once 'Services/Twitter.php';
  }
}
