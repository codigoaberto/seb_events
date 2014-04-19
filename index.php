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

// -- Initialize
require_once dirname(__FILE__).'/config.php';
$cck	=	CCK_Rendering::getInstance( $this->template );
if ( $cck->initialize() === false ) { return; }
$doc	=	JFactory::getDocument();
$doc->addStyleSheet( JURI::root( true ).'/templates/'.$cck->template. '/css/'.'style.css' );
$doc->addScript( JURI::root( true ).'/templates/'.$cck->template. '/js/jquery.calendario.js' );
$items				=	$cck->getItems();
?>
<section class="main">
				<div class="custom-calendar-wrap">
					<div id="custom-inner" class="custom-inner">
					<div class="custom-header clearfix">
							<nav>
								<span id="custom-prev" class="custom-prev"></span>
								<span id="custom-next" class="custom-next"></span>
							</nav>
							<h2 id="custom-month" class="custom-month"></h2>
							<h3 id="custom-year" class="custom-year"></h3>
					</div>
                  </div>
				</div>
			<div id="calendar" class="fc-calendar-container"></div>
</section>
    	<script type="text/javascript">	
			jQuery(document).ready(function($) {
var seblodEvents = {
				<?php
			$event_date		=	$cck->getFields( 'eventdate', '', false );
			$f_date = $event_date[0];
			$title		=	$cck->getFields( 'eventtitle', '', false );
			$f_title = $title[0];
           $f_content	= $cck->getFields( 'popover', '', false );
$many = count($items);
			 $is=1;			foreach ( $items as $i=>$item ) {
		$html		=	'';
			$i_date		=	$item->renderField( $f_date );
			$i_title	=	$item->getValue( $f_title );
			foreach ( $f_content as $iw ) {
				$content	=	$item->renderField( $iw );
				if ( $content != '' && ( $multiple || $item->getMarkup_Class( $iw ) ) ) {
					$html	.=	'<div class="cck-clrfix'.$item->getMarkup_Class( $iw ).'">'.$content.'</div>';
				} else {
					$html	.=	$content;
				}
			}
			$html		=	htmlspecialchars($html);
			if($many==$is):
		?>	"<?php echo $i_date;?>": {html:"<a href='<?php echo $item->getLink('art_title');?>'><?php echo $i_title;?></a>", title:"<?php echo $i_title;?>",text:"<?php echo $html; ?>"}
						<?php
		else:
		?>
		"<?php echo $i_date;?>": {html:"<a href='<?php echo $item->getLink('art_title');?>'><?php echo $i_title;?></a>", title:"<?php echo $i_title;?>",text:"<?php echo $html; ?>"},
		<?php
		endif; $is++; } ?>
				};
				jQuery( '#calendar' ).calendario( {caldata : seblodEvents});
				var cal = jQuery( '#calendar' ).calendario( {
months : [ "<?php echo JText::_('JANUARY');?>", "<?php echo JText::_('February');?>", "<?php echo JText::_('March');?>", "<?php echo JText::_('April');?>", "<?php echo JText::_('May');?>", "<?php echo JText::_('June');?>", "<?php echo JText::_('July');?>", "<?php echo JText::_('August');?>", "<?php echo JText::_('September');?>", "<?php echo JText::_('October');?>", "<?php echo JText::_('November');?>", "<?php echo JText::_('December');?>" ],
monthabbrs : [ "<?php echo JText::_('JANUARY_short');?>", "<?php echo JText::_('February_short');?>", "<?php echo JText::_('March_short');?>", "<?php echo JText::_('April_short');?>", "<?php echo JText::_('May_short');?>", "<?php echo JText::_('June_short');?>", "<?php echo JText::_('July_short');?>", "<?php echo JText::_('August_short');?>", "<?php echo JText::_('September_short');?>", "<?php echo JText::_('October_short');?>", "<?php echo JText::_('November_short');?>", "<?php echo JText::_('December_short');?>" ],
weekabbrs : [ "<?php echo JText::_('Sun');?>", "<?php echo JText::_('Mon');?>", "<?php echo JText::_('Tue');?>", "<?php echo JText::_('Wed');?>", "<?php echo JText::_('Thu');?>", "<?php echo JText::_('Fri');?>", "<?php echo JText::_('Sat');?>" ],
weeks : [ "<?php echo JText::_('Sunday');?>", "<?php echo JText::_('Monday');?>", "<?php echo JText::_('Tuesday');?>", "<?php echo JText::_('Wednesday');?>", "<?php echo JText::_('Thursday');?>", "<?php echo JText::_('Friday');?>", "<?php echo JText::_('Saturday');?>" ],
					caldata : seblodEvents,
					popover : "popover",
					popoverSelector : "hasPopover_cck1r"
				} ),
					$month = jQuery( '#custom-month' ).html( cal.getMonthName() ),
					$year = jQuery( '#custom-year' ).html( cal.getYear() );

				jQuery( '#custom-next' ).on( 'click', function() {
					cal.gotoNextMonth( updateMonthYear );jQuery(".hasPopover_cck1r").popover({"animation":false, container:"body", "html": true, "placement":"top", "trigger":"hover"});
				} );
				jQuery( '#custom-prev' ).on( 'click', function() {
					cal.gotoPreviousMonth( updateMonthYear );jQuery(".hasPopover_cck1r").popover({"animation":false, container:"body", "html": true, "placement":"top", "trigger":"hover"});
				} );
				jQuery( '#custom-current' ).on( 'click', function() {
					cal.gotoNow( updateMonthYear );jQuery(".hasPopover_cck1r").popover({"animation":false, container:"body", "html": true, "placement":"top", "trigger":"hover"});
				} );

				function updateMonthYear() {				
					$month.html( cal.getMonthName() );
					$year.html( cal.getYear() );
					jQuery(".hasPopover_cck1r").popover({"animation":false, container:"body", "html": true, "placement":"top", "trigger":"hover"});
				}jQuery(".hasPopover_cck1r").popover({"animation":false, container:"body", "html": true, "placement":"top", "trigger":"hover"});
			});
			
jQuery(document).ready(function(){
					jQuery('.hasTooltip').tooltip({"html": true,"container": "body"});
				});
		</script><noscript></noscript>
<?php
$cck->finalize();
?>
