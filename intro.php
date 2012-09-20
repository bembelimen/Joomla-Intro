<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.event.plugin');

class plgSystemIntro extends JPlugin
{

    // OnAfterDispatch event to render the introsite.
    public function OnAfterDispatch()
    {
        // Exlude bots from execution if option is set in the settings
        if($this->params->get('nobots'))
        {
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $botslist = array_map('trim', explode(',', $this->params->get('botslist')));

            foreach($botslist as $bot)
            {
                if(preg_match('@'.$bot.'@i', $agent))
                {
                    return;
                }
            }
        }

        $app = JFactory::getApplication();
        $doc = JFactory::getDocument();

        //check for frontend
        if(!$app->isSite())
            return;

        // check for intro into the session
        $intro = $app->getUserState('plugin.system.intro');

        // a small google hack
        // normal visitors start at the frontpage, so they will see the intro content
        // google bots (or other search engines) visit sub links => don't show  them the intro content
        // this is important, or google will list the intro content for every link at the homepage
        $active = $app->getMenu()->getActive();

        if(empty($intro) && !empty($active->home))
        {
            // load the component.php for a valid html structure
            $file = 'component.php';

            // allow to use an own "intro.php" just for the intro text...
            if(JFile::exists(JPATH_THEMES.'/'.$app->getTemplate().'/intro.php'))
            {
                $file = 'intro.php';
            }

            $params = array('template' => $app->getTemplate(), 'file' => $file, 'directory' => JPATH_THEMES);

            $doc->parse($params);

            // inject the plugin content
            $doc->setBuffer($this->params->get('intro'), array('type' => 'component', 'name' => null));

            JResponse::setHeader('Content-Type', $doc->getMimeEncoding().($doc->getCharset() ? '; charset='.$doc->getCharset() : ''));

            $caching = ($app->getCfg('caching') >= 2) ? true : false;

            // output the whole template
            echo $doc->render($caching, $params);

            // set intro to session
            $app->setUserState('plugin.system.intro', 1);

            // stop rendering the site and show the html-output
            $app->close();
        }

        // keep the session alive
        if($this->params->get('session'))
        {
            echo JHTML::_('behavior.keepalive');
        }
    }

}
