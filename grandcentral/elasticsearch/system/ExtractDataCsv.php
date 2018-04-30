<?php

class ExtractDataCsv
{

  private $file;
  private $fields;
  private $allowedFields;

  function __construct(array $config = [])
  {
    $fileBase = app('elasticsearch')->get_templateroot('site') . '/';
    $this->file = isset($config['file']) ? $fileBase . $config['file'] : $fileBase . 'import.csv';
    $this->fields = !empty($config['fields']) ? $config['fields'] : [];
    $this->allowedFields = !empty($config['allowedFields']) ? $config['allowedFields'] : [];

    $this->handle = fopen($this->file, 'r');

    return $this;
  }

  public function extractNextItem()
  {
    if (($data = fgetcsv($this->handle, null, ';')) !== false) {
      return $this->formatData($data);
    }

    return false;
  }

  public function getAllowedFields($table)
  {
    return $this->allowedFields;
  }

  public function addGeoPoint($data, $fieldName, $fieldsUsedArray)
  {
    $baseApiUrl = 'https://api-adresse.data.gouv.fr/search/?q=';
    $results = [];
    $choiceIndex = 0;

    foreach ($fieldsUsedArray as $fieldsUsed) {
      $apiUrl = $baseApiUrl;

      foreach ($fieldsUsed as $key => $value) {
        $position = array_search($value, $this->fields);
        if ($position !== false) {
          $apiUrl .= $data['body'][$value] . ' ';
        }
      }

      $apiUrl = trim($apiUrl);
      $apiUrl = preg_replace('/\s+/', '+', $apiUrl);

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, $apiUrl);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

      $result = json_decode(curl_exec($curl));

      curl_close($curl);

      if (!empty($result->features[0])) {
        $results[] = $result->features[0]->geometry->coordinates;
      }
    }

    if (count($results) > 1) {
      for ($i=$choiceIndex; $i < count($results) - 1; $i++) {
        if ((abs($results[$i][0] - $results[$i + 1][0]) <= 0.01) && (abs($results[$i][1] - $results[$i + 1][1]) <= 0.01)) {
          $choiceIndex = $i + 1;
        }
      }
      $data['body'][$fieldName] = $results[$choiceIndex];
    } elseif (count($results) === 1) {
      $data['body'][$fieldName] = $results[$choiceIndex];
    } else {
      $data['body'][$fieldName] = [0, 0];
    }

    return $data;
  }

  private function formatData($item, $ignore = [])
  {
    $data = [];
    $idPosition = array_search('id', $this->fields);
    $data['id'] = $item[$idPosition];

    $body = [];
    foreach ($this->allowedFields as $key => $value) {
      if (!in_array($key, $ignore)) {
        $position = array_search($key, $this->fields);
        switch ($value) {
          case 'id':
            $body[$key] = $item[$position];
            break;

          case 'boolean':
            $body[$key] = !empty($item[$position]) && !is_null($item[$position]) && $item[$position] !== 0 && $item[$position] !== 'false' ? true : false;
            break;

          case 'geo_point':
            break;

          default:
            $body[$key] = $item[$position];
            break;
        }
      }
    }
    $data['body'] = $body;

    return $data;
  }

}
