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
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Bind
/********************************************************************************************/	
	$_VIEW->bind('css', '/css/sitetree.css');
	$_VIEW->bind('script', '/js/nestedSortable/jquery.mjs.nestedSortable.js');
	// $_VIEW->bind('script', '/js/nestedSortable/jquery.ui.touch-punch.js');
	$_VIEW->bind('script', '/js/nestedSortable/treemap.js');

/********************************************************************************************/
//	Make the tree
/********************************************************************************************/
	class sitetree
	{
		private $start = 'page_home';
		private $class = 'sitetree';
		private $tree;
		private $pages;
		private $ref;
		
		public function __construct()
		{
		//	query the pages
			$this->get_pages();
		//	build the tree
			$this->tree[0] = $this->prepare_tree($this->start, 0);
		//	add pages with no relation
		//	$this->add_norel();
		}
		
		private function get_pages()
		{

		//	Get the list of those items
			$p = array('fitsinsitetree' => true);
			$fitsinthetree = cc('structure', $p);
		//	This will be the bunch of items that fit in the site tree
			$this->pages = new bunch(null, null, $_SESSION['pref']['handled_env']);
			$p = array('system' => false);
			foreach ($fitsinthetree as $item) $this->pages->get($item['key'], $p);
		
		//	DEBUG: our pages
		//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $this->pages);

		//	Find the home page
			$this->pages->set_index('key');
			$this->start = $this->pages[$this->start]->get_nickname();
		//	set_index
			$this->pages->set_index('id');
		//	create the reference bunch
			$this->ref = clone $this->pages;
		}
		
		private function prepare_tree($start, $key)
		{
			if (isset($this->pages[$start]))
			{
				$tmp = array(
					'id' => $start,
					'key' => $key
				);
				if (isset($this->pages[$start]->rel['child']))
				{
					$base = ($key != 0) ? $key.'.' : null;
					foreach ($this->pages[$start]->rel['child'] as $child)
					{
						$ref = $child->data['rel'].'_'.$child->data['relid'];
						if (isset($this->pages->data[$ref]))
						{
							$tmp['children'][] = $this->prepare_tree($ref, $base.$child->data['position']);
						}
					}
				}
				$tree = $tmp;
				unset($this->pages[$start]);
				return $tree;
			}
		}
		
		private function add_norel()
		{
			foreach ($this->pages as $page)
			{
				$key = (isset($this->tree[0]['children'])) ? count($this->tree[0]['children']) + 1 : 1;
				$this->tree[0]['children'][] = array(
					'id' => $page->get_nickname(),
					'key' => $key
				);
			}
		}
		
		private function make_tree($tree, $class = null)
		{
			$li = null;
			foreach ($tree as $node)
			{
				$page = $this->ref[$node['id']];
				$node['id'] = ($page['key'] == 'home') ? 'home' : $node['id'];
				$content = '
				<div class="'.$page->get_table().'">
				
					<div class="icon">'.$node['key'].'</div>
					
					<div class="title"><a href="'.$page->edit().'">'.$page['title'].'</a></div>
					<div class="url"><a href="'.$page->link().'">'.$page['url'].'</a></div>
					
					<div class="clear"><!-- Clearing floats --></div>

				</div>';
				if (isset($node['children'])) $content .= $this->make_tree($node['children']);
				$li .= '<li data-item="'.$page->get_nickname().'">'.$content.'</li>';
			}
			if (!is_null($class)) $class = ' class="'.$class.'"';
			return '<ol'.$class.'>'.$li.'</ol>';
		}
		
		public function __tostring()
		{
			return $this->make_tree($this->tree, $this->class);
		}
	}
//	Build the tree
	$sitetree = new sitetree();	
?>