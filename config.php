<?php
/**
* @version 			Seb_events 1.0
* @package			Seblod Events Template for Seblod 3.x
* @url				http://www.codigoaberto.pt
* @editor			Codigo Aberto - www.codigoaberto.pt
* @copyright		Copyright (C) 2014 Codigo Aberto. All Rights Reserved.
* @license 			GNU General Public License version 2 or later; see _LICENSE.php
**/

defined( '_JEXEC' ) or die;

global $user;

$app		=	JFactory::getApplication();
$path_lib	=	JPATH_SITE.'/libraries/cck/rendering/rendering.php';
$user		=	JCck::getUser();

if ( ! file_exists( $path_lib ) ) {
	print( '/libraries/cck/rendering/rendering.php file is missing.' );
	die;
}

require_once $path_lib;
?>
