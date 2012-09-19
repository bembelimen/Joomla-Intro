<?php
// no direct access
defined( '_JEXEC' ) or die;

jimport('joomla.event.plugin');

class plgSystemIntro extends JPlugin {

	// constructor
	function plgSystemIntro(&$subject, $params) {

		// ruft unseren base constructer auf.
        parent::__construct($subject, $params);
    }


    // OnAfterDispatch event wird direkt von joomla aufgerufen
    // und wird noch vor dem rendern der seite ausgeführt, dort setzen wir die intro seite.
    function OnAfterDispatch()
	{
        $session = JFactory::getSession();

		//fragt ab, ob wir uns im frontend befinden, ansonsten würde die intro seite auch im backend geschaltet.
		if (!JFactory::getApplication()->isSite()) return ;

		// ganz simpel, es wird gefragt, ob in der session der wert "intro"
		// enthalten ist, wenn nicht, wird die intro seite geschaltet.
       	$intro = $session->get('intro');

       	if(empty($intro))
       	{
       		// die plugin parameter (also das html für die intro seite)werden abgerufen und ausgegeben.
       		echo $this->params->get('intro');

       		// es wird in die session der wert intro gesetzt,
			// damit die vorschalt seite kein zweites mal ausgegeben wird.
       		$session->set('intro', 1);

       		// alles weitere wird abgebrochen, damit die joomla seite nicht gerendert wird und nur das html ausgegeben wird.
       		exit;
       	}

       	// wenn der parameter auf 1 steht wird die session am leben gehalten, solange das browser fenster geöffnet ist.
       	if($this->params->get('session'))
       	{
       		echo JHTML::_('behavior.keepalive');
       	}


    }


}


?>