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
        // 'see' => (string) $nav[4]['url'],
        'add'    => $url['update'].'?item=document',
        'update' => $url['update'].'?item=document&id=[itemid]',
        // 'delete' => $url['delete'].'?item=document&id=[itemid]'
      ),
      'referent' => array(
        'see' => (string) $nav[4]['url'].'?tab=contact',
        'add'    => $url['update'].'?item=referent',
        'update' => $url['update'].'?item=referent&id=[itemid]',
        //'delete' => $url['delete'].'?item=referent&id=[itemid]'
      ),
      'training' => array(
        'see' => (string) $nav[4]['url'].'?tab=training',
        'add'    => $url['update'].'?item=training',
        'update' => $url['update'].'?item=training&id=[itemid]',
        //'delete' => $url['delete'].'?item=training&id=[itemid]'
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
        //'delete' => $url['delete'].'?item=guide&id=[itemid]',
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
            if (isset($item) && item == $table && in_array($table, array('partner','news','event')))
            {
              $menu[$table][$key] = $url;
            }
            break;
          case 'update':
            if (isset($item) && item == $table && isset($item['capeb']) && in_array($item['capeb']->get(), $_SESSION['user']['capeb']->get()))
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

  function duplicate_capeb(itemCapeb $source, itemCapeb $destination)
  {
    // dupliquer le contenu
    $texts = i('text',array('capeb' => $source->get_nickname()));
    $sections = i('section',array(
      'capeb' => $source->get_nickname())
    );
    $pages = i('page',array(
      'key' => $source['key']->get().'_%',
      'order()' => 'FIELD(key, "'.$source['key']->get().'_home",
          "'.$source['key']->get().'_news",
          "'.$source['key']->get().'_event",
          "'.$source['key']->get().'_about",
          "'.$source['key']->get().'_service",
          "'.$source['key']->get().'_press",
          "'.$source['key']->get().'_about1",
          "'.$source['key']->get().'_about2",
          "'.$source['key']->get().'_about3",
          "'.$source['key']->get().'_partner"
        )'
    ))->set_index('id'); // on ordonne les pages pour garder l'ordre de l'arbo
    $bridge = array();
    $items = array(
      'text' => new bunch(),
      'section' => new bunch(),
      'page' => new bunch()
    );
    foreach ($texts as $item)
    {
      // change title
      $title = str_replace($source['shorttitle']->get(), $destination['shorttitle']->get(), $item['title']->get());
      $item['title'] = $title;
      // change capeb
      $item['capeb'] = $destination->get_nickname();
      // reset id and save to generate a new item
      $old = $item->get_nickname();
      $item['id']->database_set('');
      $item->save();
      // store data
      $bridge['text'][$old] = $item->get_nickname();
      $items['text'][] = $item;
      // $item->delete();
    }
    foreach ($sections as $item)
    {
      // change title
      $title = str_replace($source['shorttitle']->get(), $destination['shorttitle']->get(), $item['title']->get());
      $item['title'] = $title;
      // change capeb
      $item['capeb'] = $destination->get_nickname();
      // save and reset id
      $old = $item->get_nickname();
      $item['id']->database_set('');
      $item->save();
      // store data
      $bridge['section'][$old] = $item->get_nickname();
      $items['section'][] = $item;
      // $item->delete();
    }
    foreach ($pages as $item)
    {
      // change title
      $title = str_replace($source['shorttitle']->get(), $destination['shorttitle']->get(), $item['title']->get());
      $item['title'] = $title;
      // change url
      $url = mb_strtolower(str_ireplace($source['shorttitle']->get(), $destination['shorttitle']->get(), $item['url']->get()['fr']));
      $item['url'] = array('fr' => str_replace(' ', '-', $url));
      // change key
      $key = str_replace($source['key']->get(), $destination['key']->get(), $item['key']->get());
      $item['key'] = $key;
      // save parent
      $parent = $item->get_parent();
      // reset id and child
      $old = $item->get_nickname();
      $item['id']->database_set('');
      $item['child']->set([]);
      $item['parent']->set([]);
      // save
      $item->save();
      // restore parent (destroyed by save)
      $item['parent'] = $parent;
      // store data
      $bridge['page'][$old] = $item->get_nickname();
      $items['page'][] = $item;
      // $item->delete();
    }
    echo '<pre style="position:fixed;right:0;top:0;">';print_r($bridge);echo "</pre>";
    // echo "<pre>";print_r($items['page']);echo "</pre>";
    // relier tous les nouveaux contenus : mise à jour des relations
    // page
    foreach ($items['page'] as $key => $item)
    {
      // changer le parent des pages
      $parent = $item['parent']->get()[0];
      $item['parent'] = isset($bridge['page'][$parent]) ? $bridge['page'][$parent] : array($parent);
      // echo '<h1>'.$item['key'].'</h1>';
      // echo "parent : <br>";
      // echo "old : <pre>";print_r($item['id']);echo "</pre>";
      // echo "old : <pre>";print_r($parent);echo "</pre>";
      // echo "new : <pre>";print_r($item['parent']->get()[0]);echo "</pre>";
      // changer les sections
      $sections = $item['section'];
      $new = array();
      foreach ($sections as $section)
      {
        $new[] = isset($bridge['section'][$section]) ? $bridge['section'][$section] : $section;
      }
      $item['section'] = $new;
      // echo "section : <br>";
      // echo "old : <pre>";print_r($sections->get());echo "</pre>";
      // echo "new : <pre>";print_r($item['section']->get());echo "</pre>";
      // echo '<hr>';
      // echo "<pre>";print_r($item);echo "</pre>";
      $item->save();
      // sleep(1);
    }
    // section
    foreach ($items['section'] as $key => $item)
    {
      $app = $item['app']->get();
      // echo "<pre>";print_r($app);echo "</pre>";
      foreach ($app['param'] as $param => $value)
      {
        if (is_array($value))
        {
          foreach ($value as $id => $v)
          {
            // echo "<pre>";print_r($v);echo "</pre>";
            if (!is_array($v) && isset($bridge['section'][$v]))
            {
              $app['param'][$param][$id] = $bridge['section'][$v];
            }
            if (!is_array($v) && isset($bridge['text'][$v]))
            {
              $app['param'][$param][$id] = $bridge['text'][$v];
            }
          }
        }
        else
        {
          if (!is_array($value) && isset($bridge['section'][$value]))
          {
            $app['param'][$param] = $bridge['section'][$value];
          }
          if (!is_array($value) && isset($bridge['text'][$value]))
          {
            $app['param'][$param] = $bridge['text'][$value];
          }
        }
      }
      // echo "<pre>";print_r($app);echo "</pre><hr>";
      $item['app']->set($app);
      // echo "section : <br>";
      // echo "old : <pre>";print_r($sections->get());echo "</pre>";
      // echo "new : <pre>";print_r($item['section']->get());echo "</pre>";
      // echo '<hr>';
      // echo "<pre>";print_r($item);echo "</pre>";
      $item->save();
      // sleep(1);
    }
    // on replique les données des services et des guides
    $replicate = array(
      'creer','gerer','salarie','conjoint','developpe','avantage','guide','chantier','cahier','guidepartner'
    );
    foreach ($replicate as $attr)
    {
      $destination[$attr]->set($source[$attr]->get());
    }
    // on rempli le répertoire media
    $destination['directory'] = mb_strtolower($destination['shorttile']);
    // echo "<pre>";print_r($destination);echo "</pre>";
    $destination->save();

    echo 'done';
    // $bridge = array(
    //   'text' => array(
    //       'text_7' => 'text_29',
    //       'text_12' => 'text_30'
    //   ),
    //   'section' => array(
    //       'section_11' => 'section_133',
    //       'section_47' => 'section_134',
    //       'section_48' => 'section_135',
    //       'section_77' => 'section_136',
    //       'section_78' => 'section_137',
    //       'section_79' => 'section_138',
    //       'section_80' => 'section_139',
    //       'section_91' => 'section_140',
    //       'section_93' => 'section_141',
    //       'section_95' => 'section_142',
    //       'section_98' => 'section_143'
    //   ),
    //   'page' => array(
    //       'page_34' => 'page_108',
    //       'page_38' => 'page_109',
    //       'page_39' => 'page_110',
    //       'page_40' => 'page_111',
    //       'page_36' => 'page_112',
    //       'page_33' => 'page_113',
    //       'page_35' => 'page_114',
    //       'page_67' => 'page_115',
    //       'page_75' => 'page_116',
    //       'page_37' => 'page_117'
    //   )
    // );
    // echo "<pre>";print_r($bridge);echo "</pre>";
    // foreach ($variable as $key => $value) {
    //   # code...
    // }
    // echo "<pre>";print_r($tosave['text']->get_column('title'));echo "</pre>";
    // echo "<pre>";print_r($tosave['section']->get_column('title'));echo "</pre>";
    // echo "<pre>";print_r($tosave['page']->get_column('title'));echo "</pre>";
  }
?>
