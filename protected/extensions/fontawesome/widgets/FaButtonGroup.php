<?php
/**
 * FaButtonGroup class file.
 * 
 * Extended version of TbButtonGroup from Yii-Boostrap / Twitter Boostrap, that 
 * uses customized buttons (FaButton) in button group.
 * 
 * @author Tomasz Trejderowski -- http://www.yiiframework.com/user/7141/
 * @license CC BY 3.0 http://creativecommons.org/licenses/by/3.0/
 * 
 * Based on: * 
 * - TbButtonGroup by Christoffer Niska: http://www.cniska.net/yii-bootstrap/
 * - Bootstrap button widget: http://twitter.github.com/bootstrap/base-css.html#buttons
 */

Yii::import('bootstrap.widgets.TbButtonGroup');
Yii::import('fontawesome.widgets.FaButton');

class FaButtonGroup extends TbButtonGroup
{    
	public function run()
	{
		echo(CHtml::openTag('div', $this->htmlOptions));

		foreach($this->buttons as $button)
		{
			if(isset($button['visible']) && $button['visible'] === false) continue;

			$this->controller->widget('fontawesome.widgets.FaButton', array
            (
				'buttonType'=>isset($button['buttonType']) ? $button['buttonType'] : $this->buttonType,
				'iconType'=>isset($button['iconType']) ? $button['iconType'] : 'icon-left',
				'iconSize'=>isset($button['iconSize']) ? $button['iconSize'] : 'icon-normal',
				'iconSpin'=>isset($button['iconSpin']) ? $button['iconSpin'] : FALSE,
				'type'=>isset($button['type']) ? $button['type'] : $this->type,
				'size'=>$this->size, // all buttons in a group cannot vary in size
				'icon'=>isset($button['icon']) ? $button['icon'] : null,
				'label'=>isset($button['label']) ? $button['label'] : null,
				'url'=>isset($button['url']) ? $button['url'] : null,
				'active'=>isset($button['active']) ? $button['active'] : false,
				'disabled'=>isset($button['disabled']) ? $button['disabled'] : false,
				'items'=>isset($button['items']) ? $button['items'] : array(),
				'ajaxOptions'=>isset($button['ajaxOptions']) ? $button['ajaxOptions'] : array(),
				'htmlOptions'=>isset($button['htmlOptions']) ? $button['htmlOptions'] : array(),
                'dropdownOptions'=>isset($button['dropdownOptions']) ? $button['dropdownOptions'] : array(),
				'encodeLabel'=>isset($button['encodeLabel']) ? $button['encodeLabel'] : $this->encodeLabel,
			));
		}
		echo('</div>');
	}
}
