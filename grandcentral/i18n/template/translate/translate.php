<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 *
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	/* Look in the view */
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$forms = array();
	if (!isset($_POST['item'])) $_POST['item'] = 'page';
	$handled_env = $_SESSION['pref']['handled_env'];
	
/********************************************************************************************/
//	Some data
/********************************************************************************************/
	$items = i('item', array('key' => $_POST['item']));
	$tocItems = i('item', all);
	
/********************************************************************************************/
//	Lets get to work
/********************************************************************************************/
//	Loop through items
	foreach ($items as $item)
	{
	//	Get i18n fields
		$attrs = $item['attr'];

	//	Loop Through attrs to find i18n
		$i18ns = array();
		foreach ($attrs as $attr)
		{
			if ($attr['type'] == 'i18n') $i18ns[] = $attr;
		}
	
	//	If we have some i18n in this item
		if (!empty($i18ns))
		{
			
		//	Fetch all items 
			$is = i($item['key']->get(), all);
			foreach ($is as $i)
			{
				$key = $handled_env.'_'.$item['key'].'_i18n';
				
			//	Create a form for this item
				$form = i('form', $key);
				$form->set_action(i('page', 'post', 'admin')['url']);

			//	Update general form data
				$form['key'] = $key;
				$form['template'] = 'default';
				$form['method'] = 'post';
				$form['action'] = 'post';
				$form['field'] = array();
				
			//	System fields
				$form['field']['id'] = array(
					'key' => 'id',
					'type' => 'text',
					'label' => 'id',
				);
				$form['field']['status'] = array(
					'key' => 'status',
					'type' => 'text',
					'label' => 'status',
				);
				
			//	Update the fields with i18n
				foreach ($i18ns as $i18n)
				{
					$form['field'][$i18n['key']] = array(
						'key' => $i18n['key'],
						'field' => $i18n['field'],
						'label' => $i18n['key'],
						'type' => 'i18n',
						'placeholder' => 'Please translate me.'
					);
				}
			//	Save the form (needed for validation)
				$form->save();
				
			//	Store for late
				$form->populate_with_item($i);
				$forms[$item['key']->get()][] = array(
					'item' => $i,
					'form' => $form,
				);
			}
			
		}
	}
	
?>