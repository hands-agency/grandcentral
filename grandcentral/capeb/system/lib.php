<?php
  // tester si l'utilisateur est connecté et peut voir les offres réservées
  function user_can_see()
  {
    return ($_SESSION['user']->is_a('member') && ($_SESSION['capeb']->get_nickname() === 'capeb_118' || in_array($_SESSION['capeb']->get_nickname(), $_SESSION['user']['capeb']->get()))) || $_SESSION['user']->is_a('webmaster') || $_SESSION['user']->is_admin() ? true : false;
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
      'list' => (string) i('page', 'admin_list')['url'],
      'update' => (string) i('page', 'admin_update')['url'],
      'delete' => (string) i('page', 'admin_delete')['url']
    );
    $capeb = new dataCapeb();
    $texts = $capeb->get_texts()->set_index('key');
    $sections = $capeb->get_sections()->set_index('key');
    // $nav = $capeb->get_nav();
    // echo "<pre>";print_r($nav->get_column('title'));echo "</pre>";

    $tree = array(
      'news' => array(
        'see'            => $url['list'].'?item=news',
        'add'    => $url['update'].'?item=news',
        'update' => $url['update'].'?item=news&id=[itemid]',
        'delete' => $url['delete'].'?item=news&id=[itemid]',
        'blacklist' => $url['update'].'?item=custom&id=newsblacklist'
      ),
      'event' => array(
        'see'    => $url['list'].'?item=event',
        'add'    => $url['update'].'?item=event',
        'update' => $url['update'].'?item=event&id=[itemid]',
        'delete' => $url['delete'].'?item=event&id=[itemid]',
        'blacklist' => $url['update'].'?item=custom&id=eventblacklist'
      ),
      'presentation' => array(
        //'see'            => $url['list'].'?item=text',
        'text_about1'    => $url['update'].'?item=text&id='.$texts['text_about1']['id'],
        'text_about3'    => $url['update'].'?item=text&id='.$texts['text_about3']['id'],
        'contributor_see' => $url['list'].'?item=contributor',
        'contributor_add' => $url['update'].'?item=contributor',
        'contributor_organize' => $url['update'].'?item=section&id='.$sections['section_about2']['id'],
        'contact' => $url['update'].'?item=custom&id=contact',
        'contactform' => $url['update'].'?item=section&id='.$sections['section_contact']['id'],
        'press' => $url['update'].'?item=text&id='.$texts['text_press']['id'],
        'legal' => $url['update'].'?item=text&id='.$texts['text_legals']['id'],
        'privacy' => $url['update'].'?item=custom&id=privacy',
        'text_exposer' => $url['update'].'?item=section&id='.$sections['section_exposer']['id'],
      ),
      'service' => array(
        'see'              => $url['list'].'?item=service',
        'add'              => $url['update'].'?item=service',
        'update'           => $url['update'].'?item=service&id=[itemid]',
        // 'delete'           => $url['delete'].'?item=event&id=[itemid]',
        'service_organize' => $url['update'].'?item=custom&id=service_organize',
        'service_intro'    => $url['update'].'?item=custom&id=service_intro',
      ),
      'serviceannexe' => array(
        'see'              => $url['list'].'?item=serviceannexe',
        'add'              => $url['update'].'?item=serviceannexe',
        'update'           => $url['update'].'?item=serviceannexe&id=[itemid]',
        // 'delete'           => $url['delete'].'?item=event&id=[itemid]',
        // 'service_organize' => $url['update'].'?item=custom&id=service_organize',
        // 'service_intro'    => $url['update'].'?item=custom&id=service_intro',
      ),
      'document' => array(
        'see' => $url['list'].'?item=document',
        'add'    => $url['update'].'?item=document',
        'update' => $url['update'].'?item=document&id=[itemid]',
        // 'delete' => $url['delete'].'?item=document&id=[itemid]'
      ),
      'referent' => array(
        'see' => $url['list'].'?item=referent',
        'add'    => $url['update'].'?item=referent',
        'update' => $url['update'].'?item=referent&id=[itemid]',
        //'delete' => $url['delete'].'?item=referent&id=[itemid]'
      ),
      'training' => array(
        'see' => $url['list'].'?item=training',
        'add'    => $url['update'].'?item=training',
        'update' => $url['update'].'?item=training&id=[itemid]',
        //'delete' => $url['delete'].'?item=training&id=[itemid]'
      ),
      'combat' => array(
        'see' => $url['list'].'?item=combat',
        'add'    => $url['update'].'?item=combat',
        // 'update' => $url['update'].'?item=combat&id=[itemid]',
        //'delete' => $url['delete'].'?item=training&id=[itemid]'
      ),
      'partner' => array(
        'see' => $url['list'].'?item=partner',
        'add'    => $url['update'].'?item=partner',
        'update' => $url['update'].'?item=partner&id=[itemid]',
        'delete' => $url['delete'].'?item=partner&id=[itemid]',
        'blacklist' => $url['update'].'?item=custom&id=partnerblacklist'
      ),
      'guide' => array(
        'see' => $url['list'].'?item=guide',
        'add'    => $url['update'].'?item=guide',
        // 'update' => $url['update'].'?item=guide&id=[itemid]',
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
        //'see' => (string) $capeb->get_page('home')['url'],
        'section_cover' => $url['update'].'?item=section&id='.$sections['section_cover']['id'],
        // 'hide_context' => '',
        // 'show_context' => '',
        // 'hide_video' => '',
        // 'show_video' => '',
        'section_video' => $url['update'].'?item=section&id='.$sections['section_video']['id'],
        'section_links' => $url['update'].'?item=section&id='.$sections['section_links']['id'],
        'section_facebook' => $url['update'].'?item=section&id='.$sections['section_facebook']['id'],
        'section_twitter' => $url['update'].'?item=section&id='.$sections['section_twitter']['id'],
        'sort' => $url['update'].'?item=custom&id=sorthome',
      ),
      'ctx' => array(
        'see_ctx' => $url['list'].'?item=section&type=ctx',
        'add_ctx_image' => $url['update'].'?item=custom&id=ctx_image',
        'add_ctx_text' => $url['update'].'?item=custom&id=ctx_text',
        'add_ctx_icon' => $url['update'].'?item=custom&id=ctx_icon',
        'add_ctx_2col' => $url['update'].'?item=custom&id=ctx_2col',
        'section_ctx' => $url['update'].'?item=section&id='.$sections['section_boxes_context']['id']
        // 'edit_2col' => $url['update'].'?item=section&id='.$sections['section_2col']['id'],
        // 'edit_1col' => $url['update'].'?item=section&id='.$sections['section_1col']['id'],

      ),
      'media' => array(
        'see_media' => $url['update'].'?item=custom&id=media'
      ),
      'formad' => array(
        'text_annoncer' => $url['update'].'?item=section&id='.$sections['section_annoncer']['id'],
        'see' => $url['list'].'?item=formad',
        'add' => $url['update'].'?item=formad'
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
    if (isset($capeb->capeb['type']) && $capeb->capeb['type']->get() == 'region')
    {
      unset($menu['service']);
      unset($menu['serviceannexe']);
      // unset($menu['document']);
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
    $combats = i('combat',array('capeb' => $source->get_nickname()));
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
          "'.$source['key']->get().'_partner",
          "'.$source['key']->get().'_contact",
          "'.$source['key']->get().'_annoncer",
          "'.$source['key']->get().'_exposer",
          "'.$source['key']->get().'_legals"
        )'
    ))->set_index('id'); // on ordonne les pages pour garder l'ordre de l'arbo

    $combatsKeys = $combats->get_column('key');
    $sectionsKeys = $sections->get_column('key');
    $textsKeys = $texts->get_column('key');
    $pagesKeys = $pages->get_column('key');
    echo "<pre>";print_r('<h1>Source : '.$source['shorttitle'].'</h1>');echo "</pre>";
    // echo "<pre>Textes : ";print_r($textsKeys);echo "</pre>";
    // echo "<pre>Sections : ";print_r($sectionsKeys);echo "</pre>";
    // echo "<pre>Pages : ";print_r($pagesKeys);echo "</pre>";
    // destination
    $destinationCombats = i('combat',array('capeb' => $destination->get_nickname()));
    $destinationTexts = i('text',array('capeb' => $destination->get_nickname()));
    $destinationSections = i('section',array('capeb' => $destination->get_nickname()));
    $destinationPages = i('page', array('key' => $destination['key'].'%'));

    $destinationCombatsKeys = $destinationCombats->get_column('key');
    $destinationSectionsKeys = $destinationSections->get_column('key');
    $destinationTextsKeys = $destinationTexts->get_column('key');
    $destinationPagesKeys = $destinationPages->get_column('key');
    echo "<pre>";print_r('<h1>Destinations : '.$destination['shorttitle'].'</h1>');echo "</pre>";
    // echo "<pre>Textes : ";print_r($destinationTextsKeys);echo "</pre>";
    // echo "<pre>Sections : ";print_r($destinationSectionsKeys);echo "</pre>";
    // echo "<pre>Pages : ";print_r($destinationPagesKeys);echo "</pre>";
    // vars
    $bridge = array();
    $items = array(
      'combat' => new bunch(),
      'text' => new bunch(),
      'section' => new bunch(),
      'page' => new bunch()
    );
    echo "<pre>";print_r('<h1>Tâches accomplies</h1>');echo "</pre>";
    foreach ($combats as $item)
    {
      // change title
      // $title = str_replace($source['shorttitle']->get(), $destination['shorttitle']->get(), $item['title']->get());
      // $item['title'] = $title;
      // change capeb
      $item['capeb'] = $destination->get_nickname();
      // reset id and save to generate a new item
      // $old = $item->get_nickname();
      if ($destinationCombats->count == 0)
      {
        $item['id']->database_set('');
        $item->save();
        echo "<pre>";print_r('- Création du combat : '.$item['title']);echo "</pre>";
      }
      // store data for relation
      // $bridge['text'][$old] = $item->get_nickname();
      // $items['text'][] = $item;
    }
    foreach ($texts as $item)
    {
      // change title
      $title = str_replace($source['shorttitle']->get(), $destination['shorttitle']->get(), $item['title']->get());
      $item['title'] = $title;
      // change capeb
      $item['capeb'] = $destination->get_nickname();
      // reset id and save to generate a new item
      $old = $item->get_nickname();
      if (!in_array($item['key']->get(), $destinationTextsKeys))
      {
        $item['id']->database_set('');
        $item->save();
        echo "<pre>";print_r('- Création du texte : '.$title);echo "</pre>";
      }
      else
      {
        $index = array_search($item['key']->get(), $destinationTextsKeys);
        $item = $destinationTexts[$index];
      }
      // store data for relation
      $bridge['text'][$old] = $item->get_nickname();
      $items['text'][] = $item;
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

      if (!in_array($item['key']->get(), $destinationSectionsKeys))
      {
        $item['id']->database_set('');
        $item->save();
        echo "<pre>";print_r('- Création de la section : '.$title);echo "</pre>";
      }
      else
      {
        $index = array_search($item['key']->get(), $destinationSectionsKeys);
        $item = $destinationSections[$index];
      }
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
      $url = mb_strtolower(str_ireplace(wd_remove_accents($source['shorttitle']->get()), wd_remove_accents($destination['shorttitle']->get()), $item['url']->get()['fr']));
      $item['url'] = array('fr' => str_replace(' ', '-', $url));
      // change key
      $key = str_replace($source['key']->get(), $destination['key']->get(), $item['key']->get());
      $item['key'] = $key;
      // save parent
      $parent = $item->get_parent();
      $old = $item->get_nickname();
      // save
      if (!in_array($item['key']->get(), $destinationPagesKeys))
      {
        // reset id and child
        $item['id']->database_set('');
        $item['child']->set([]);
        $item['parent']->set([]);
        $item->save();
        echo "<pre>";print_r('- Création de la page : '.$title['fr']);echo "</pre>";
      }
      else
      {
        $index = array_search($item['key']->get(), $destinationPagesKeys);
        $item = $destinationPages[$index];
      }
      // restore parent (destroyed by save)
      $item['parent'] = $parent;
      // store data
      $bridge['page'][$old] = $item->get_nickname();
      $items['page'][] = $item;
      // $item->delete();
    }
    // echo "<pre>";print_r($items['text']->get_column('key'));echo "</pre>";
    // echo "<pre>";print_r($items['section']->get_column('key'));echo "</pre>";
    // echo "<pre>";print_r($items['page']->get_column('key'));echo "</pre>";
    // echo '<pre style="position:fixed;right:0;top:0;">';print_r($bridge);echo "</pre>";

    echo "<pre>";print_r('<h1>Mise en relation</h1>');echo "</pre>";
    // echo "<pre>";print_r($items['page']);echo "</pre>";
    // relier tous les nouveaux contenus : mise à jour des relations
    // page
    foreach ($items['page'] as $key => $item)
    {
      // changer le parent des pages
      $parent = $item['parent']->get()[0];
      // echo "<pre>";print_r($parent);echo "</pre>";
      $item['parent'] = isset($bridge['page'][$parent]) ? $bridge['page'][$parent] : $parent;
      // echo '<h1>'.$item['key'].'</h1>';
      // echo "parent : <br>";
      echo "<pre>";print_r('<h3>Parent de la page '.$item['title']['fr'].'</h3>'.'de '.$parent.' vers '.$item['parent']->get()[0]);echo "</pre>";
      // changer les sections
      $old = $item['section']->get();
      $new = array();
      foreach ($old as $section)
      {
        $new[] = isset($bridge['section'][$section]) ? $bridge['section'][$section] : $section;
      }
      $item['section'] = $new;
      // echo "section : <br>";
      // echo "<pre>";print_r('<h3>Section(s) de la page '.$item['title']['fr'].'</h3>');echo "</pre>";
      // echo "de : <pre>";print_r($old);echo "</pre>";
      // echo "vers : <pre>";print_r($item['section']->get());echo "</pre>";
      // echo '<hr>';
      // echo "<pre>";print_r($item['title']->get());echo "</pre>";

      // save relation
      $item->save();
      // sleep(1);
    }
    // section
    foreach ($items['section'] as $key => $item)
    {
      $app = $item['app']->get();
      // echo "<pre>";print_r('<h3>Section '.$item['title'].'</h3>');echo "</pre>";
      // echo "<pre>de : ";print_r($app['param']);echo "</pre>";
      // recherche des champs de relation
      foreach ($app['param'] as $param => $value)
      {
        if (is_array($value))
        {
          foreach ($value as $id => $v)
          {
            if (!is_array($v))
            {
              $table = mb_substr($v, 0, mb_strpos($v,'_'));

              foreach (array('text','section','page') as $i)
              {
                if (isset($bridge[$i][$v]))
                {
                  echo "<pre>";print_r('on a trouvé une relation de la table '.$table.' : '.$v.' qui devient : '.$bridge[$i][$v]);echo "</pre>";
                  $app['param'][$param][$id] = $bridge[$i][$v];
                }
              }
            }
          }
        }
      }
      // echo "<pre>";print_r($app);echo "</pre><hr>";
      $item['app']->set($app);
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
      if ($destination[$attr]->is_empty())
      {
        $destination[$attr]->set($source[$attr]->get());
      }
    }
    // on rempli le répertoire media
    // $destination['directory'] = mb_strtolower($destination['shorttile']->get());
    // echo "<pre>";print_r($destination);echo "</pre>";
    $destination->save();

    echo '<h1>done</h1>';
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

function wd_remove_accents($str, $charset='utf-8')
{
    $str = htmlentities($str, ENT_NOQUOTES, $charset);

    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

    return $str;
}

// param : un tableau de capeb
    function restore_services($capeb)
    {
      // on recupere le national
      $source = i('capeb','cnational');
      // liste des attributs de services
      $attrs = ['creer','gerer','salarie','conjoint','developpe','avantage'];
      // on vérifie chaque capeb
      foreach ($attrs as $attr)
      {
        $diff = array_diff($source[$attr]->get(),$capeb[$attr]->get());

        if (count($diff) > 0)
        {
          // echo "<pre>Différence : ";print_r($diff);echo "</pre>";
          // echo "<pre>";print_r('La capeb '.$capeb['shorttitle'].' présente une anomalie.');echo "</pre>";
          $capeb[$attr]->set(array_merge($capeb[$attr]->get(),$diff));
          // echo "<pre>";print_r('Corrigée.');echo "</pre>";
        }
      }
      return $capeb;
    }
?>
