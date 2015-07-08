<?php
/**
 * Dashboard widget class file.
 * @author Aruna Attanayake <aruna470@gmail.com>
 * @copyright Copyright &copy; Aruna Attanayake 2012-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Dashboard extends CWidget
{
	private $assetsPath = '';
	public $portletIds = array();
	public $divColumns = array();
	public $dashHeader = array(
		'show' => true,
		'title' => 'Dashboard',
	);
	
	/*
	 * Register css and javascripts
	 */
    protected function registerClientScripts()
    {		
    	$cs = Yii::app()->clientScript;	
		$cs->registerCssFile($this->assetsPath . '/css/jquery-ui.css');
		$cs->registerCssFile($this->assetsPath . '/css/dashboard.css');
		$cs->registerCoreScript('jquery'); 
		$cs->registerScriptFile($this->assetsPath . '/js/jquery-ui.js');
		$cs->registerScriptFile($this->assetsPath . '/js/jquery.cookie.js');
    }
	
	public function run()
	{		
		$this->assetsPath = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assests');
		
		$this->registerClientScripts();

		if ($this->dashHeader['show'])
		{
			$this->dashHeader();
		}

		$this->registerDashScript();
	}
	
	/*
	 * Get div column class as string
	 */
	private function getColumnStr()
	{
		$col_str = '';
		
		foreach ($this->divColumns as $col)
		{
			$col_str .= ".$col, ";
		}
		
		return rtrim($col_str, ", ");
	}
	
	/*
	 *  Get jquery string for each column
	 */
	private function getColumnScript()
	{
		$col_str = $this->getColumnStr();
		$col_script_str = '';
		
		foreach ($this->divColumns as $col)
		{
			$col_script_str .= "$( \".$col\" ).sortable({
			    connectWith: \"$col_str\"
			  });";
		}

		return $col_script_str;
	}
	
	/*
	 * Regiser dashboard core script
	 */
	private function registerDashScript()
	{
		$cs = Yii::app()->clientScript;
		
		$cs->registerScript('portlets', " 
			$(function() {" . $this->getColumnScript() . "		
			  $( \".portlet\" ).addClass( \"ui-widget ui-widget-content ui-helper-clearfix ui-corner-all\" )
			    .find( \".portlet-header\" )
			      .addClass( \"ui-widget-header ui-corner-all\" )
			      .prepend( \"<span  class='ui-icon ui-icon-closethick icon-close'></span><span class='ui-icon ui-icon-minusthick icon-vis'></span>\")
			      .end()
			    .find( \".portlet-content\" );
			
			  $( \".icon-vis\" ).click(function() {
			    $( this ).toggleClass( \"ui-icon-minusthick\" ).toggleClass( \"ui-icon-plusthick\" );
			    $( this ).parents( \".portlet:first\" ).find( \".portlet-content\" ).toggle();
			  });
			  $( \".icon-close\" ).click(function() {
			    //$( this ).toggleClass( \"ui-icon-minusthick\" ).toggleClass( \"ui-icon-plusthick\" );
			    $( this ).parents( \".portlet:first\" ).hide();
			  });
			  $( \".column\" ).disableSelection();
			});
		");	
	} 
	
	/*
	 * Prepare dashboard header
	 */
	private function dashHeader()
	{
		echo '<div id="dash-header" class="ui-widget-header ui-corner-all ui-widget">
				<div>' . $this->dashHeader['title'] . '</div>
				<div id="menu2" class="ui-icon ui-icon-wrench"></div>
				<br class="clear"/>
			  </div>';
	}
	
	/*
	 * Prepare dashboard visibility setting menu
	 */
	private function dashPortletVisibility()
	{
		$cs = Yii::app()->clientScript;
		$portlets = json_encode($this->portletIds);
		
		$cs->registerScript('portlet_options', "

			var portlets = $portlets;		

			$(document).ready(function () {
			  $('#menu2').click(function(event) {
			    $('#window_dialog').dialog({
			        autoOpen: true,
			        draggable: false,
			        modal: true,
			        title: 'Settings',
			        buttons: {
			            \"Save\": function () { 
			              save_visible_portlets(portlets);
			              $(portlets).each(function() {
			                set_window_visibility(this);
			              });
			              $(this).dialog('destroy');
			            },
			            \"Cancel\": function () {
			              $(this).dialog('destroy');
			            }
			        } 
			      });
			  });

			  function set_window_visibility(name){
			    if($('#'+name+'-visible').is(':checked'))
			      $('#'+name+'-portlet').show();
			    else
			      $('#'+name+'-portlet').hide();
			  }

			  function save_visible_portlets(portlets)
			  {
				 var checked_arr = [];

				 $(portlets).each(function() {				
					if($('#'+this+'-visible').is(':checked'))
					{
						//checked_arr.push(this);
					}
					else
					{
						checked_arr.push(this);
					}
			     });

				 $.cookie('in_visible_portlets', checked_arr, {expires: 30});
				 //alert($.cookie('in_visible_portlets'));
			  }

			  function set_visible_check(name){
			    if($('#'+name+'-portlet').is(\":visible\"))
			      $('#'+name+'-visible').each(function(){ this.checked = true; });
			    else
			      $('#'+name+'-visible').attr(\"checked\", false);
			  }
			  $( \"#settings_dialog\" ).bind( \"dialogopen\", function(event, ui) {
			
			  });
			  $( \"#window_dialog\" ).bind( \"dialogopen\", function(event, ui) {
			    $(portlets).each(function() {
			      set_visible_check(this);
			    });
			  });
			});
		");
		
		echo '<div id="window_dialog" class="hidden">' .
				'<fieldset>';
		
			foreach ($this->portletIds as $portlet_name)
			{
				echo '<input type="checkbox" id="' . $portlet_name . '-visible"/><label>' . $portlet_name . '</label><br/>';
			}        

		echo '</fieldset>' .
			 '</div>';
	}
	
	/*
	 * Add portlets
	 * @param string $id Unique id for each portlet
	 * @param string $header Portlet header name
	 * @param string $content Portlet content
	 */
	public function addPortlet($id, $header, $content)
	{
		$this->portletIds[] = $id;
		echo '<div id="' . $id . '-portlet" class="portlet">' .
				 '<div class="portlet-header">' . $header . '</div>' .
				 '<div class="portlet-content">' . $content . '</div>' .
			 '</div>';
	}
	
	/*
	 * Set portlet visibilty at the initialization
	 * Load allowed portlet options from cookie and display them
	 */
	public function initVisibility()
	{
		$portlets = json_encode(explode(',', @$_COOKIE['in_visible_portlets']));

		$cs = Yii::app()->clientScript;
		$cs->registerScript('init_portlets', " 
			$(function() {
				
			  init_portlets = $portlets

              $(init_portlets).each(function() {
                $('#'+this+'-portlet').hide();
              });
			});
		");	
	}
	
	/*
	 * End widget
	 */
	public function end()
	{
		$this->dashPortletVisibility();
		$this->initVisibility();
	}
}
?>