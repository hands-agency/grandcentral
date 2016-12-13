<?php
  // tester si l'utilisateur est connecté et peut voir les offres réservées
  function user_can_see()
  {
    return $_SESSION['user']->is_a('member') || $_SESSION['user']->is_a('webmaster') || $_SESSION['user']->is_admin() ? true : false;
  }

  function webmaster_can_edit($table)
  {
    return $_SESSION['user']->is_admin() || ($_SESSION['user']->is_a('webmaster') && in_array($_SESSION['capeb']->get_nickname(), $_SESSION['user']['capeb']->get())) ? true : false;
  }

  function webmaster_can_see()
  {
    return $_SESSION['user']->is_admin() || ($_SESSION['user']->is_a('webmaster') && in_array($_SESSION['capeb']->get_nickname(), $_SESSION['user']['capeb']->get())) ? true : false;
  }

  function webmaster_menu()
  {
    $url = array(
      'update' => (string) i('page', 'admin_update')['url'],
      'delete' => (string) i('page', 'admin_delete')['url']
    );
    $capeb = new dataCapeb();
    $texts = $capeb->get_texts()->set_index('key');
    $sections = $capeb->get_sections()->set_index('key');
    $nav = $capeb->get_nav();

    $tree = array(
      'news' => array(
        'see' => (string) $nav[0]['url'],
        'add'    => $url['update'].'?item=news',
        'update' => $url['update'].'?item=news&id=[itemid]',
        'delete' => $url['delete'].'?item=news&id=[itemid]',
      ),
      'event' => array(
        'see' => (string) $nav[1]['url'],
        'add'    => $url['update'].'?item=event',
        'update' => $url['update'].'?item=event&id=[itemid]',
        'delete' => $url['delete'].'?item=event&id=[itemid]',
      ),
      'presentation' => array(
        'see' => (string) $nav[2]['url'],
        'text_about1'    => $url['update'].'?item=text&id='.$texts['text_about1']['id'],
        'text_about3'    => $url['update'].'?item=text&id='.$texts['text_about3']['id'],
        'contributor_add' => $url['update'].'?item=contributor',
        'contributor_organize' => $url['update'].'?item=section&id='.$sections['section_about2']['id']
      ),
      'service' => array(
        'see' => (string) $nav[4]['url'],
        'add'              => $url['update'].'?item=service',
        'update'           => $url['update'].'?item=service&id=[itemid]',
        // 'delete'           => $url['delete'].'?item=event&id=[itemid]',
        'service_organize' => $url['update'].'?item=custom&id=service_organize',
        'service_intro'    => $url['update'].'?item=custom&id=service_intro',
      ),
      'document' => array(
        'see' => (string) $nav[4]['url'],
        'add'    => $url['update'].'?item=document',
        'update' => $url['update'].'?item=document&id=[itemid]',
        // 'delete' => $url['delete'].'?item=document&id=[itemid]'
      ),
      'referent' => array(
        'see' => (string) $nav[4]['url'].'?tab=contact',
        'add'    => $url['update'].'?item=referent',
        'update' => $url['update'].'?item=referent&id=[itemid]',
        'delete' => $url['delete'].'?item=referent&id=[itemid]'
      ),
      'training' => array(
        'see' => (string) $nav[4]['url'].'?tab=training',
        'add'    => $url['update'].'?item=training',
        'update' => $url['update'].'?item=training&id=[itemid]',
        'delete' => $url['delete'].'?item=training&id=[itemid]'
      ),
      'partner' => array(
        'see' => (string) i('service','partner')['url'],
        'add'    => $url['update'].'?item=partner',
        'update' => $url['update'].'?item=partner&id=[itemid]',
        'delete' => $url['delete'].'?item=partner&id=[itemid]',
      ),
      'guide' => array(
        'see' => (string) i('service','guide')['url'],
        'add'    => $url['update'].'?item=guide',
        'update' => $url['update'].'?item=guide&id=[itemid]',
        'delete' => $url['delete'].'?item=guide&id=[itemid]',
        'guide_organize' => $url['update'].'?item=custom&id=guide_organize',
      ),
      // 'press' => array(
      //   'edit_presscontent' => '',
      // ),
      // 'contact' => array(
      //   'edit_contact' => '',
      // ),
      'home' => array(
        'see' => (string) $capeb->get_page('home')['url'],
        'section_cover' => $url['update'].'?item=section&id='.$sections['section_cover']['id'],
        // 'hide_context' => '',
        // 'show_context' => '',
        'edit_2col' => $url['update'].'?item=section&id='.$sections['section_2col']['id'],
        'edit_1col' => $url['update'].'?item=section&id='.$sections['section_1col']['id'],
        // 'hide_video' => '',
        // 'show_video' => '',
        'section_video' => $url['update'].'?item=section&id='.$sections['section_video']['id'],
        'section_links' => $url['update'].'?item=section&id='.$sections['section_links']['id'],
        'section_facebook' => $url['update'].'?item=section&id='.$sections['section_facebook']['id'],
        'section_twitter' => $url['update'].'?item=section&id='.$sections['section_twitter']['id']
      )
    );
    // echo "<pre>";print_r($tree);echo "</pre>";exit;
    // get current id
    if (defined('item') && defined('current'))
    {
      $item = i(item,current);
      $capeb = isset($item['capeb']) ? $item['capeb']->get() : '';
      // if (isset($item['capeb']))
      // {
      //   // echo "<pre>";print_r($capeb);echo "</pre>";
      //   //   echo "<pre>";print_r($_SESSION['user']['capeb']->get());echo "</pre>";exit;
      //   // delete
      //   switch (true)
      //   {
      //     case in_array($table, array('news','partner','event')):
      //       $authorizeDelete = true;
      //       break;
      //
      //     default:
      //       $authorizeDelete = false;
      //       break;
      //   }
      //   // update
      //   $authorizeUpdate = in_array($capeb, $_SESSION['user']['capeb']->get());
      //
      // }
      // gestion des cas particuliers

       //&&
    }
    // clean menu
    $menu = array();
    foreach ($tree as $table => $data)
    {
      foreach ($data as $key => $url)
      {
        // on remplace tous les éléments par l'id courante
        if (isset($item))
        {
          $url = str_replace('[itemid]',$item['id']->get(), $url);
        }
        // on retire certaines options en fonction du contexte
        // if (!in_array($key, array('update')) && isset($item) && item == $table && $authorizeUpdate === true)
        // {
        //   $menu[$table][$key] = $url;
        // }
        // if (!in_array($key, array('delete')) && isset($item) && item == $table && $authorizeDelete === true)
        // {
        //   $menu[$table][$key] = $url;
        // }
        switch ($key)
        {
          case 'delete':
            if (isset($item) && item == $table && in_array('partner','news','event'))
            {
              $menu[$table][$key] = $url;
            }
            break;
          case 'update':
            if (isset($item) && item == $table)
            {
              $menu[$table][$key] = $url;
            }
            break;

          default:
            $menu[$table][$key] = $url;
            break;
        }
      }
    }
    return $menu;
  }

  // // guess itemCapeb to return depending on page key
  // function page_to_capeb()
  // {
  //   $page = i('page',current);
  //   $data = explode('_', $page['key']->get());
  //   $count = count($data);
  //   $key = 'cnational';
  //   if ($count > 1)
  //   {
  //     $key = $data[0];
  //   }
  //   return i('capeb',$key);
  // }
  //
  // // retourne la liste des actualités en fonction des paramètres passés
  // function get_news($capeb = 'capeb_118', $limit = 9, $p = 1, $tag = null)
  // {
  //   // default query params
  //   $start = $p * $limit - $limit;
  //   $params = array(
  //     'limit()' => $start.','.$limit,
  //     'order()' => 'date DESC'
  //   );
  //   // capeb
  //   if (!empty($capeb))
  //   {
  //     if ($capeb != 'capeb_118')
  //     {
  //       $itemCapeb = i($capeb);
  //       $type = $itemCapeb['type']->get();
  //       switch ($type)
  //       {
  //         case 'departement':
  //           $params['capeb'] = array($capeb, 'capeb_118');
  //           $region = i('capeb', array('departement' => $capeb));
  //           // echo "<pre>";print_r($region);echo "</pre>";
  //           if ($region->count > 0)
  //           {
  //             $params['capeb'][] = $region[0]->get_nickname();
  //           }
  //           break;
  //         case 'region':
  //           $params['capeb'] = array_merge($capeb['departement']->get(), array($capeb, 'capeb_118'));
  //           break;
  //       }
  //       // echo "<pre>";print_r($capeb);echo "</pre>";
  //     }
  //     else
  //     {
  //       $params['capeb'] = $capeb;
  //     }
  //   }
  //   // tag
  //   if (!empty($tag))
  //   {
  //     $tag = i('newscategory',$tag);
  //     $params['category'] = $tag->get_nickname();
  //   }
  //   // query news
  //   echo "<pre>";print_r($params);echo "</pre>";
  //   $data = i('news', $params);
  //   // total
  //   if ($data->count > 0)
  //   {
  //     unset($params['limit()']);
  //     // echo "<pre>";print_r($params);echo "</pre>";
  //     $data['total'] = count::get('news',$params);
  //   }
  //   else
  //   {
  //     $data['total'] = 0;
  //   }
  //   // echo "<pre>";print_r($data);echo "</pre>";
  //
  //   return $data;
  // }
?>
