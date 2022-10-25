<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/elastic/vendor/autoload.php';
use Elastic\Elasticsearch\ClientBuilder;
/**
 *
 */
class ElasticsearchInstance
{

  private $client;
  private $hosts = [];
  private $index;
  private $type;
  // private $fields;
  private $allowedFields;
  private $synonymsPath;
  private $searchConfig;
  private $defaultFlag = 1;
  private $errors = 0;

  function __construct(array $config, array $allowedFields = [], string $synonymsPath = null)
  {
    $this->host['url'] = !empty($config['host']) && !empty($config['host']['url']) ? $config['host']['url'] : 'http://localhost:9200';
    $this->host['username'] = !empty($config['host']) && !empty($config['host']['username']) ? $config['host']['username'] : null;
    $this->host['password'] = !empty($config['host']) && !empty($config['host']['password']) ? $config['host']['password'] : null;

    $this->index = !empty($config['index']) ? $config['index'] : null;
    $this->type = !empty($config['type']) ? $config['type'] : null;
    $this->defaultFlag = !empty($config['default_flag']) ? $config['default_flag'] : $this->defaultFlag;

    // $this->fields = $fields;
    $this->allowedFields = $allowedFields;
    $this->synonymsPath = $synonymsPath;
    $this->searchConfig = !empty($config['search']) ? $config['search'] : [];
    $this->searchConfig['limit'] = !empty($this->searchConfig['limit']) ? $this->searchConfig['limit'] : 10;
    $this->searchConfig['page'] = !empty($this->searchConfig['page']) ? $this->searchConfig['page'] : 1;
    $this->searchConfig['min_score'] = !empty($this->searchConfig['min_score']) ? $this->searchConfig['min_score'] : false;

    if (is_null($this->index)) {
      throw new Exception('Index have to be set in the config', 1);
    }

    $this->hosts = [$this->host['url']];
    if(!defined('JSON_PRESERVE_ZERO_FRACTION')) {
      define('JSON_PRESERVE_ZERO_FRACTION', 1024);
      if (!empty($this->host['username']) && !empty($this->host['password'])) {
        $this->client = ClientBuilder::create()
          ->setHosts($this->hosts)
          ->setBasicAuthentication($this->host['username'], $this->host['password'])
          ->build();
      } else {
        $this->client = ClientBuilder::create()
          ->setHosts($this->hosts)
          ->build();
      }
    } else {
      if (!empty($this->host['username']) && !empty($this->host['password'])) {
        $this->client = ClientBuilder::create()
          ->setHosts($this->hosts)
          ->setBasicAuthentication($this->host['username'], $this->host['password'])
          ->build();
        // $this->client = ClientBuilder::create()->setHosts($this->hosts)->build();
      } else {
        $this->client = ClientBuilder::create()
          ->setHosts($this->hosts)
          ->build();
      }
    }

    return $this;
  }

  public function add(array $data)
  {
    if (!is_null($this->type)) {
      $data['body']['type'] = $this->type;
    }

    $data['body']['flag'] = $this->defaultFlag;

    if (isset($data['id'])) {
      return $this->client->index([
        'index' => $this->index,
        'type' => 'doc',
        'id' => $data['id'],
        'body' => $data['body']
      ]);
    }
  }

  public function update(array $data, array $ignore = [])
  {
    if (!is_null($this->type)) {
      $data['body']['type'] = $this->type;
    }

    $data['body']['flag'] = $this->defaultFlag;

    if (isset($data['id'])) {
      return $this->client->update([
        'index' => $this->index,
        'type' => 'doc',
        'id' => $data['id'],
        'retry_on_conflict' => 5,
        'body' => [
          'doc' => $data['body'],
          'doc_as_upsert' => true
        ]
      ]);
    }
  }

  public function delete(string $id)
  {
    return $this->client->delete([
      'index' => $this->index,
      'type' => 'doc',
      'id' => $id
    ]);
  }

  public function updateByQuery(array $body)
  {
    if (!is_null($this->type)) {
      $query = $body['query'];

      $bodyFilered = [
        'query' => [
          'bool' => [
            'must' => $query,
            'filter' => [
              'match' => [
                'type' => $this->type
              ]
            ]
          ]
        ]
      ];

      if (!empty($body['script'])) {
        $bodyFilered['script'] = $body['script'];
      }

      $body = $bodyFilered;
    }

    return $this->client->updateByQuery([
      'index' => $this->index,
      'type' => 'doc',
      'body' => $body,
      'conflicts' => 'proceed'
    ]);
  }

  public function deleteByQuery(array $body)
  {
    if (!is_null($this->type)) {
      $query = $body['query'];

      $bodyFilered = [
        'query' => [
          'bool' => [
            'must' => $query,
            'filter' => [
              'match' => [
                'type' => $this->type
              ]
            ]
          ]
        ]
      ];

      if (!empty($body['script'])) {
        $bodyFilered['script'] = $body['script'];
      }

      $body = $bodyFilered;
    }

    return $this->client->deleteByQuery([
      'index' => $this->index,
      'type' => 'doc',
      'body' => $body,
      'conflicts' => 'proceed'
    ]);
  }

  public function get(string $id)
  {
    $exists = $this->client->exists(['index' => $this->index, 'type' => 'doc', 'id' => $id]);
    if ($exists) {
      return $this->client->get([
        'index' => $this->index,
        'type' => 'doc',
        'id' => $id
      ]);
    } else {
      return false;
    }
  }

  public function search(array $body)
  {
    if (!is_null($this->type)) {
      $bodyFilered = null;
      if (!empty($body['query']['bool'])) {
        $bodyFilered = $body;

        if (!empty($bodyFilered['query']['bool']['filter'])) {
          $filter = $bodyFilered['query']['bool']['filter'];
          $filters = [$filter, [
            'match' => [
              'type' => $this->type
            ]
          ]];
          $bodyFilered['query']['bool']['filter'] = $filters;
        } else {
          $bodyFilered['query']['bool']['filter']['match'] = [
            'type' => $this->type
          ];
        }
      } else {
        $query = $body['query'];

        $bodyFilered = [
          'query' => [
            'bool' => [
              'must' => $query,
              'filter' => [
                'match' => [
                  'type' => $this->type
                ]
              ]
            ]
          ]
        ];
      }

      if (!empty($body['script'])) {
        $bodyFilered['script'] = $body['script'];
      }

      $body = $bodyFilered;
    }

    $body['from'] = $this->searchConfig['limit'] * ($this->searchConfig['page'] - 1);
    $body['size'] = $this->searchConfig['limit'];

    return $this->client->search([
      'index' => $this->index,
      'type' => 'doc',
      'body' => $body
    ]);
  }

  public function geolocatedSearchWithCoords($body, $field, $location, $distance)
  {
    $query = $body['query'];
    $sort = !empty($body['sort']) ? $body['sort'] : false;
    $script = !empty($body['script']) ? $body['script'] : false;
    $filter = !empty($body['filter']) ? $body['filter'] : false;
    $cleanLocation = isset($location['lon']) ? $location : ['lon' => $location[0], 'lat' => $location[1]];
    $body = [
      'from' => 0,
      'size' => $this->searchConfig['limit'],
      'query' => [
        'bool' => [
          'must' => $query,
          'filter' => [
            'geo_distance' => [
              'distance' => $distance,
              $field => $cleanLocation
            ]
          ]
        ]
      ]
    ];

    if (!is_null($this->type)) {
      $bodyFilered = null;
      if (!empty($body['query']['bool'])) {
        $bodyFilered = $body;

        if (!empty($bodyFilered['query']['bool']['filter'])) {
          $currentFilter = $bodyFilered['query']['bool']['filter'];
          $filters = [$currentFilter, [
            'match' => [
              'type' => $this->type
            ]
          ]];
          $bodyFilered['query']['bool']['filter'] = $filters;
        } else {
          $bodyFilered['query']['bool']['filter']['match'] = [
            'type' => $this->type
          ];
        }
      } else {
        $query = $body['query'];

        $bodyFilered = [
          'from' => 0,
          'size' => $this->searchConfig['limit'],
          'query' => [
            'bool' => [
              'must' => $query,
              'filter' => [
                'match' => [
                  'type' => $this->type
                ]
              ]
            ]
          ]
        ];
      }

      if (!empty($body['script'])) {
        $bodyFilered['script'] = $body['script'];
      }

      $body = $bodyFilered;
    }

    if ($sort) {
      $body['sort'] = $sort;
    }

    if ($filter) {
      foreach ($filter as $key => $value) {
        array_push($body['query']['bool']['filter'], $value);
      }
    }

    if ($script) {
      $body['script'] = $script;
    }

    if ($this->searchConfig['min_score'] !== false) {
      $body['min_score'] = $this->searchConfig['min_score'];
    }

    try {
      return $this->client->search([
        'index' => $this->index,
        'type' => 'doc',
        'body' => $body
      ]);
    } catch (\Exception $e) {
      echo "<pre>";print_r($e);echo "</pre>";
    }


  }

  public function geolocatedSearchWithText($body, $field, $locationText, $distance)
  {
      $apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=' . $locationText;
      $apiUrl = preg_replace('/\s+/', '+', $apiUrl);
      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $apiUrl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($curl);
      $errors = curl_error($curl);
      if (!empty($errors)) echo "<pre>";print_r($errors);echo "</pre>";
      curl_close($curl);

      $result = json_decode($response);

      if (!empty($result->features[0])) {
        $locationCoords = $result->features[0]->geometry->coordinates;
        return $this->geolocatedSearchWithCoords($body, $field, $locationCoords, $distance);
      } else {
        return false;
      }
  }

  public function map()
  {
    $indexExistsResponse = $this->client->indices()->exists(['index' => $this->index]);

    if (!$indexExistsResponse->asBool())
    {
      $params = [
        'index' => $this->index,
        'body' => [
          'settings' => [
            'number_of_shards' => 3,
            'number_of_replicas' => 2
          ],
        ],
        'mappings' => [
          'properties' => [
            'type' => [
              'type' => 'keyword'
            ]
          ]
        ]
      ];

      foreach ($this->allowedFields as $key => $value) {
        if ($value === 'geo_point') {
          $params['mappings']['properties'][$key] = ['type' => 'geo_point'];
        }
        if ($value === 'date') {
          $params['mappings']['properties'][$key] = ['type' => 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'];
        }
      }

      
        $params['body']['settings']['analysis'] = [
          'filter' => [
            'snowball_filter' => [
              'type' => 'snowball',
              'language' => 'French'
            ],
            'french_elision' => [
              'type' => 'elision',
              'articles_case' => true,
              'articles' => [
                'l', 'm', 't', 'qu', 'n', 's',
                'j', 'd', 'c', 'jusqu', 'quoiqu',
                'lorsqu', 'puisqu'
              ]
            ],
            'french_stop' => [
              'type' => 'stop',
              'stopwords' => '_french_'
            ],
            'french_keywords' => [
              'type' => 'keyword_marker',
              'keywords' => ['']
            ],
            'french_stemmer' => [
              'type' => 'stemmer',
              'language' => 'light_french'
            ]
          ],
          'analyzer' => [
            'french_heavy' => [
              'type' => 'custom',
              'tokenizer' => 'icu_tokenizer',
              'filter' => [
                'french_elision',
                // 'icu_folding',
                // 'synonym_filter',
                'french_stemmer'
              ]
            ],
            'french_light' => [
              'type' => 'custom',
              'tokenizer' => 'icu_tokenizer',
              'filter' => [
                'french_elision',
                // 'icu_folding',
                // 'synonym_filter'
              ]
            ]
          ]
        ];
        if (!is_null($this->synonymsPath))
        {
          $params['body']['settings']['analysis']['filter']['synonym_filter'] = [
            'type' => 'synonym',
            'ignore_case' => true,
            'synonyms_path' => $this->synonymsPath
          ];
          $params['body']['settings']['analysis']['analyzer']['french_heavy']['filter'][] = 'synonym_filter';
          $params['body']['settings']['analysis']['analyzer']['french_light']['filter'][] = 'synonym_filter';
        }

      $indexCreateResponse = $this->client->indices()->create($params);
    }
  }

  public function updateSynonyms()
  {
    $this->client->indices()->close([
      'index' => $this->index
    ]);
    $this->client->indices()->open([
      'index' => $this->index
    ]);
  }

  // private function getData(array $item, array $ignore = [])
  // {
  //   $data = [];
  //
  //   $idPosition = array_search('id', $this->fields);
  //   $data['id'] = $item[$idPosition];
  //
  //   $body = [];
  //   foreach ($this->allowedFields as $key => $value) {
  //     if (!in_array($key, $ignore)) {
  //       $position = array_search($key, $this->fields);
  //       switch ($value) {
  //         case 'id':
  //           $body[$key] = $item[$position];
  //           break;
  //
  //         case 'boolean':
  //           $body[$key] = !empty($item[$position]) && !is_null($item[$position]) && $item[$position] !== 0 && $item[$position] !== 'false' ? true : false;
  //           break;
  //
  //         case 'geo_point':
  //           $body[$key] = $this->createGeoPoint($item);
  //           break;
  //
  //         case 'flag':
  //           $body[$key] = $this->defaultFlag;
  //           break;
  //
  //         default:
  //           $body[$key] = $item[$position];
  //           break;
  //       }
  //     }
  //   }
  //   $data['body'] = $body;
  //
  //   return $data;
  // }

  // private function createGeoPoint(array $item, array $ignore = [])
  // {
  //   $apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=';
  //
  //   $addressPosition = array_search('address', $this->fields);
  //   if ($addressPosition !== false && !in_array('address', $ignore)) {
  //     $apiUrl .= $item[$addressPosition];
  //   }
  //
  //   $addressComplementPosition = array_search('address_complement', $this->fields);
  //   if ($addressComplementPosition !== false && !in_array('address_complement', $ignore)) {
  //     $apiUrl .= ' ' . $item[$addressComplementPosition];
  //   }
  //
  //   $postcodePosition = array_search('postcode', $this->fields);
  //   if ($postcodePosition !== false && !in_array('postcode', $ignore)) {
  //     $apiUrl .= ' ' . $item[$postcodePosition];
  //   }
  //
  //   $cityPosition = array_search('city', $this->fields);
  //   if ($cityPosition !== false && !in_array('city', $ignore)) {
  //     $apiUrl .= ' ' . $item[$cityPosition];
  //   }
  //
  //   $apiUrl = preg_replace('/\s+/', '+', $apiUrl);
  //
  //   $curl = curl_init();
  //   curl_setopt($curl, CURLOPT_URL, $apiUrl);
  //   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  //   curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  //
  //   $result = json_decode(curl_exec($curl));
  //
  //   curl_close($curl);
  //
  //   if (!empty($result->features[0])) {
  //     return $result->features[0]->geometry->coordinates;
  //   } else {
  //     if (count($ignore) == 0) {
  //       return $this->createGeoPoint($item, ['address_complement']);
  //     } elseif (count($ignore == 1)) {
  //       return $this->createGeoPoint($item, ['address', 'address_complement']);
  //     } else {
  //       return [0, 0];
  //     }
  //   }
  // }

  public function getClient()
  {
    return $this->client;
  }

  public function getIndex()
  {
    return $this->index;
  }

  public function getType()
  {
    return $this->type;
  }

}
