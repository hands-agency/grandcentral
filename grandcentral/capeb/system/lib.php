<?php
  // tester si l'utilisateur est connecté et peut voir les offres réservées
  function user_can_see()
  {
    return $_SESSION['user']->is_a('member') || $_SESSION['user']->is_admin() ? true : false;
  }

  // guess itemCapeb to return depending on page key
  function page_to_capeb()
  {
    $page = i('page',current);
    $data = explode('_', $page['key']->get());
    $count = count($data);
    $key = 'cnational';
    if ($count > 1)
    {
      $key = $data[0];
    }
    return i('capeb',$key);
  }

  // retourne la liste des actualités en fonction des paramètres passés
  function get_news($capeb = 'capeb_118', $limit = 9, $p = 1, $tag = null)
  {
    // default query params
    $start = $p * $limit - $limit;
    $params = array(
      'limit()' => $start.','.$limit,
      'order()' => 'date DESC'
    );
    // capeb
    if (!empty($capeb))
    {
      if ($capeb != 'capeb_118')
      {
        $itemCapeb = i($capeb);
        $type = $itemCapeb['type']->get();
        switch ($type)
        {
          case 'departement':
            $params['capeb'] = array($capeb, 'capeb_118');
            $region = i('capeb', array('departement' => $capeb));
            // echo "<pre>";print_r($region);echo "</pre>";
            if ($region->count > 0)
            {
              $params['capeb'][] = $region[0]->get_nickname();
            }
            break;
          case 'region':
            $params['capeb'] = array_merge($capeb['departement']->get(), array($capeb, 'capeb_118'));
            break;
        }
        // echo "<pre>";print_r($capeb);echo "</pre>";
      }
      else
      {
        $params['capeb'] = $capeb;
      }
    }
    // tag
    if (!empty($tag))
    {
      $tag = i('newscategory',$tag);
      $params['category'] = $tag->get_nickname();
    }
    // query news
    echo "<pre>";print_r($params);echo "</pre>";
    $data = i('news', $params);
    // total
    if ($data->count > 0)
    {
      unset($params['limit()']);
      // echo "<pre>";print_r($params);echo "</pre>";
      $data['total'] = count::get('news',$params);
    }
    else
    {
      $data['total'] = 0;
    }
    // echo "<pre>";print_r($data);echo "</pre>";

    return $data;
  }
?>
