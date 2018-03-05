<?php

class ExtractDataGc
{

  private $tables;
  private $currentTableIndex;
  private $allowedAttrs;
  private $limit;

  function __construct(array $config = [])
  {
    $p = isset($config['url']) && $config['url'] ? ['hasurl' => true] : [];
    $this->tables = !empty($config['tables']) ? $config['tables'] : i('item', $p, 'site')->get_column('key');
    $this->currentTableIndex = 0;
    $this->currentItemIndex = 0;
    $this->allowedAttrs = !empty($config['allowedAttrs']) ? $config['allowedAttrs'] : ['attrString', 'attrSirtrevor', 'attrI18n'];
    $this->allowedFields = [];
    $this->bunchData = [];
    $this->limit = isset($config['limit']) ? $config['limit'] : 100;
    $this->start = 0;

    $this->countTables();

    return $this;
  }

  private function extractTable($table)
  {
    $p = ['status' => 'live', 'limit()' => $this->start . ', ' . $this->limit];
    $this->bunchData = i($table, $p, 'site');
    $this->start += $this->limit;
  }

  public function extractNextItem($table)
  {
    if ($this->currentItemIndex === 0) {
      $this->allowedFields = $this->getAllowedFields($table);
    }
    if ($this->currentItemIndex % $this->limit === 0) {
      $this->extractTable($table);
    }
    if ($this->currentItemIndex >= $this->countTables[$table]) {
      $this->currentItemIndex = 0;
      $this->start = 0;
      $this->bunchData = [];
      return false;
    }

    $data = $this->formatData($this->bunchData[$this->currentItemIndex % $this->limit]);

    $this->currentItemIndex++;

    return $data;
  }

  // public function getTable()
  // {
  //   if ($this->currentTableIndex <= count($this->tables) - 1) {
  //     return $this->tables[$this->currentTableIndex];
  //   }
  //
  //   return false;
  // }
  //
  // public function getNextTable()
  // {
  //   if ($this->currentTableIndex <= count($this->tables) - 1) {
  //     $this->currentTableIndex++;
  //     return $this->tables[$this->currentTableIndex];
  //   }
  //
  //   return false;
  // }

  public function getAllowedFields($table)
  {
    $item = i($table);
    $allowedFields = [];

    foreach ($item as $key => $attr) {
      $class = get_class($attr);
      if (in_array($class, $this->allowedAttrs)) {
        // This sould be based on class but only text for now
        $allowedFields[$key] = 'text';
      }
    }

    return $allowedFields;
  }

  private function createGeoPoint()
  {

  }

  private function countTables()
  {
    $countTables = [];

    foreach ($this->tables as $table) {
      $count = count::get($table, ['status' => 'live'], 'site');
      $countTables[$table] = $count;
    }

    $this->countTables = $countTables;
  }

  private function formatData($item)
  {
    $data = [];
    $data['id'] = $item->get_nickname();
    $data['body'] = [];

    foreach ($this->allowedFields as $key => $field) {
      $class = get_class($item[$key]);
      $attr = mb_substr($class, 4);

      switch ($class) {
        case 'attrString':
          $data['body'][$key] = $this->getGenericValue($item[$key]);
          break;
        case 'attrSirtrevor':
          $data['body'][$key] = $this->getSirtrevorValue($item[$key]);
          break;
        case 'attrI18n':
          $data['body'][$key] = $this->getI18nValue($item[$key]);
          break;
        case 'attrUrl':
          $data['body'][$key] = $this->getUrlValue($item[$key]);
          break;
      }

      if (method_exists($this, 'get' . $attr . 'Value')) {
        $data['body'][$key] = $this->{'get' . $attr . 'Value'}($item[$key]);
      } else {
        $data['body'][$key] = $this->getGenericValue($item[$key]);
      }
    }

    return $data;
  }

  private function getGenericValue($field)
  {
    return $field->get();
  }

  private function getSirtrevorValue($field)
  {
    $value = json_decode($field->get(), true);
    $text = (string)$field;
    $text = trim(str_replace(PHP_EOL, ' ', strip_tags($text)));

    return $text;
  }

  private function getI18nValue($field)
  {
    $attr = mb_substr($field->get_attr(), 4);
    $text = '';

    if (method_exists($this, 'get' . $attr . 'Value')) {
      $class = 'attr' . $attr;
      foreach ($field->get() as $lang) {
        $text .= $this->{'get' . $attr . 'Value'}(new $class($lang)) . ' ';
      }
    } else {
      foreach ($field->get() as $lang) {
        $text .= $this->getGenericValue(new attrString($lang)) . ' ';
      }
    }

    return $text;
  }

  private function getUrlValue($field)
  {
    return (string)$field;
  }

}
