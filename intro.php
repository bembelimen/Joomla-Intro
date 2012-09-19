<?php
// no direct access
defined( '_JEXEC' ) or die;

jimport('joomla.event.plugin');

class plgSystemIntro extends JPlugin {

	// constructor
	function plgSystemIntro(&$subject, $params) {
        parent::__construct($subject, $params);
    }


    // OnAfterDispatch event to render the introsite.
    function OnAfterDispatch()
	{
        $session = JFactory::getSession();

		//check for frontend
		if (!JFactory::getApplication()->isSite()) return ;

		// check for intro into the session
       	$intro = $session->get('intro');

       	if(empty($intro))
       	{
       		// get the parameter with the html
       		echo $this->params->get('intro');

       		// set intro to session
       		$session->set('intro', 1);

       		// stop rendering the site and show the html-output
       		exit;
       	}

       	// keep the session alive
       	if($this->params->get('session'))
       	{
       		echo JHTML::_('behavior.keepalive');
       	}


    }


}


?>