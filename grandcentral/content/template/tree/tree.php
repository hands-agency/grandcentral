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
	$_APP->bind_css('tree/css/tree.css');
//	$_APP->bind_script('tree/js/nestedSortable/jquery.mjs.nestedSortable.js');
//	$_APP->bind_script('tree/js/nestedSortable/jquery.ui.touch-punch.js');
//	$_APP->bind_script('tree/js/jquery-sortable.js');
	$_APP->bind_script('tree/js/tree.js');

/********************************************************************************************/
//	Make the tree
/********************************************************************************************/
	class tree
	{
		private $start = 'page_home';
		private $class = 'tree';
		private $tree;
		private $pages;
		private $ref;
		public $count = 0;
		
		public function __construct()
		{
		//	query the pages
			$this->get_pages();
		//	build the tree
			$this->tree[0] = $this->prepare_tree($this->start, 0);
		}
		
		private function get_pages()
		{
			$q = 'SELECT id, title FROM `page` WHERE `key` = "home" OR `system` = false';
			$db = database::connect($_SESSION['pref']['handled_env']);
			$r = $db->query($q);
			
			foreach ($r['data'] as $data)
			{
				$ids[] = $data['id'];
			}
		//	This will be the bunch of items that fit in the site tree
			$this->pages = i('page', array
			(
				'id' => $ids,
				'status' => array('live', 'asleep'),
			//	'live' => array(true, false) /* #4.3 */
			), $_SESSION['pref']['handled_env']);
		//	DEBUG: our pages
		//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $this->pages);
			
			if ($this->pages->count > 0)
			{
			//	Find the home page
				$this->pages->set_index('key');
				$this->start = $this->pages[$this->start]->get_nickname();
			//	set_index
				$this->pages->set_index('id');
			//	create the reference bunch
				$this->ref = clone $this->pages;
			}
			else
			{
				trigger_error('No page. No tree. What else ?', E_USER_NOTICE);
			}
		}
		
		private function prepare_tree($start, $key)
		{
			if (isset($this->pages[$start]))
			{
				$tmp = array(
					'id' => $start,
					'key' => $key
				);
				if (!$this->pages[$start]['child']->is_empty())
				{
					$base = ($key != 0) ? $key.'.' : null;
					$position = 1;
					foreach ($this->pages[$start]['child'] as $ref)
					{
						if (isset($this->pages[$ref]))
						{
							$tmp['children'][] = $this->prepare_tree($ref, $base.$position);
						}
						$position++;
					}
				}
				$tree = $tmp;
				unset($this->pages[$start]);
				return $tree;
			}
		}
		
		public function count()
		{
			return $this->pages->count;
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
		//	Some vars
			$li = null;
			
		//	Loop through pages
			foreach ($tree as $node)
			{
				$page = $this->ref[$node['id']];
				$node['id'] = ($page['key'] == 'home') ? 'home' : $node['id'];
				
			//	Do you have zones ?
				/* TODO */
				
			//	Depending on pages
				switch ($page['key'])
				{
					case 'home':
						$asleep = 'Maintenance';
						break;
					
					default:
						$asleep = 'Put asleep';
						break;
				}
	
			//	Depending on type
				switch ($page['type']['key'])
				{
					case 'link':
						$parse = parse_url($page['type']['url']);
						$host = !empty($parse['host']) ? $parse['host'] : '';
						$type = '<a class="url" href="'.$page['type']['url'].'" title="'.$page['type']['url'].'">⇢&nbsp;'.$host.'</a>';
						break;
					
					default:
						$type = null;
						break;
				}
			//	Depending on sections
				$badge = null;
				if ($page->is_reader())
				{
					$readItem = i('item', $page->get_reader(), $_SESSION['pref']['handled_env']);
					$badge = '<a href="'.ADMIN_URL.'/list?item='.$page->get_reader().'" class="cc-badge" title="'.$readItem['title'].'"><span data-feathericon="&#xe'.$readItem['icon'].'"></span></a>';
				}
				
			//	Content
				$content = '
				<div class="page" data-status="'.$page['status'].'" data-type="'.$page['type']['key'].'" data-url="'.$page['url'].'">
					<div class="connector"></div>
					'.$badge.'
				
					<div class="card" id="'.$page->get_nickname().'">
					
						<div class="face front">
				            <div class="title">
								<a href="'.$page->edit().'">'.$page['title'].'</a>
							</div>
				            <div class="option" data-feathericon="&#xe129"></div>
				    	</div>
					    <div class="face back">
							<div class="action">
								<a class="edit" data-feathericon="&#xe095" href="'.$page->edit().'">Edit</a>
								<a class="preview" data-feathericon="&#xe000">Preview</a>
								<a class="asleep" data-feathericon="&#xe061">'.$asleep.'</a>
								<a class="live" data-feathericon="&#xe064">Go live</a>
							</div>
							<div class="preview"><iframe></iframe></div>
					    </div>
				
						<div class="add">+</div>
					</div>
					'.$type.'
				</div>';
				
			//	If the tree goes on
				if (isset($node['children']))
				{
				//	Recurse
					$content .= $this->make_tree($node['children']);
				}
			//	The list stops, but we need to be ready to welcome new pages...
				else
				{
					$content .= '<ol></ol>';
				}
			//	Build the <li>
				$li .= '<li data-item="'.$page->get_nickname().'"><div class="node">'.$content.'</div></li>';
			}
			if (!is_null($class)) $class = ' class="'.$class.'"';
			
		//	Plus 1
			$this->count = '234';
			
		//	Return
			return '<ol'.$class.'>'.$li.'</ol>';
		}	
		
		public function __tostring()
		{
			return $this->make_tree($this->tree, $this->class);
		}
	}

//	Build the tree
	$tree = new tree();	
	$count = $tree->count();
?>