<?php
// no direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;

class plgSystemIntro extends CMSPlugin
{
    // constructor
    public function __construct($subject, $params)
    {
        parent::__construct($subject, $params);
    }

    // OnAfterDispatch event to render the introsite.
    public function onAfterDispatch()
    {
        $session = Factory::getSession();

        // check for frontend
        if (!Factory::getApplication()->isClient('site')) {
            return;
        }

        // check for intro in the session
        $intro = $session->get('intro');

        if (empty($intro)) {
            // get the parameter with the html
            echo $this->params->get('intro');

            // set intro to session
            $session->set('intro', 1);

            // stop rendering the site and show the html-output
            exit;
        }

        // keep the session alive
        if ($this->params->get('session')) {
            echo \Joomla\CMS\HTML\HTMLHelper::_('behavior.keepalive');
        }
    }
}
?>