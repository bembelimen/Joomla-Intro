CONTENTS OF THIS FILE
---------------------

  * Introduction
  * Installation
  * Configuration


INTRODUCTION
------------

This small Plugin allows you to set an Introsite to your Joomla! 2.5. This Introsite will show when the User visit your Frontpage the first time.
The Plugin will set an Cookie, so the Introsite will not show again until the browser get closed.
The Introsite is not indicated on Sublinks. This is done for Searchengines, because they should not list the intro content for every link on the searchresults.


INSTALLATION
------------

Install as usual...
see http://docs.joomla.org/Installing_an_extension


CONFIGURATION
-------------

Goto Extensions => Plug-in Manager and activate the Plugin. Now you've got two ways to set your individual Introsite.


The first way:

Open the Plugin in the Plug-in Manager. On the right side you will see an textarea, where you can put in the HTML for your Introsite.
You don't have to work with head or body, because the Plugin will inject your Code to the component.php of your Template, so the html structure of your Template will be used.



The second way:

You can work with your own intro.php which have to be stored in your templatefolder. The Plugin check the path and include the intro.php, if there one.
In this intro.php you have to set the head by your own and can inject CSS, Scripts, or what ever you want to use in your intro.
Your own intro.php can look like the following example


<?php
/**
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <jdoc:include type="head" />
  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/your.css" type="text/css" />
</head>
<body>
<div id="intro"><jdoc:include type="component" /></div>
</body>
</html>


