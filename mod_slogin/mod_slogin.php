<?php
/**
 * Social Login
 *
 * @version 	1.0
 * @author		SmokerMan, Arkadiy, Joomline
 * @copyright	© 2012. All rights reserved.
 * @license 	GNU/GPL v.3 or later.
 */

// No direct access.
defined('_JEXEC') or die('(@)|(@)');
//подключаем helper стандартного модуля авторизации, для ридеректа
require_once JPATH_BASE.'/modules/mod_login/helper.php';

$user = JFactory::getUser();
$doc = JFactory::getDocument();
$input = new JInput;

$type	= modLoginHelper::getType();
$return	= modLoginHelper::getReturnURL($params, $type);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$layout = $params->get('layout', 'default');
$layout = (strpos($layout, '_:') === false) ? $layout : substr($layout, 2);

$doc->addScript(JURI::root().'modules/mod_slogin/media/slogin.js');
$doc->addStyleSheet(JURI::root().'modules/mod_slogin/tmpl/'.$layout.'/slogin.css');

$dispatcher	= JDispatcher::getInstance();

JPluginHelper::importPlugin('slogin_auth');

$links = array();

$dispatcher->trigger('onLinkCreate', array(&$links));

require JModuleHelper::getLayoutPath('mod_slogin', $params->get('layout', 'default'));

