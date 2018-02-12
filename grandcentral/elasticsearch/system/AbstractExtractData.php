<?php

abstract class AbstractExtractData
{

  abstract protected function extract();

  private function createGeoPoint(array $item, array $ignore = [])
  {
    $apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=';

    $addressPosition = array_search('address', $this->fields);
    if ($addressPosition !== false && !in_array('address', $ignore)) {
      $apiUrl .= $item[$addressPosition];
    }

    $addressComplementPosition = array_search('address_complement', $this->fields);
    if ($addressComplementPosition !== false && !in_array('address_complement', $ignore)) {
      $apiUrl .= ' ' . $item[$addressComplementPosition];
    }

    $postcodePosition = array_search('postcode', $this->fields);
    if ($postcodePosition !== false && !in_array('postcode', $ignore)) {
      $apiUrl .= ' ' . $item[$postcodePosition];
    }

    $cityPosition = array_search('city', $this->fields);
    if ($cityPosition !== false && !in_array('city', $ignore)) {
      $apiUrl .= ' ' . $item[$cityPosition];
    }

    $apiUrl = preg_replace('/\s+/', '+', $apiUrl);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

    $result = json_decode(curl_exec($curl));

    curl_close($curl);

    if (!empty($result->features[0])) {
      return $result->features[0]->geometry->coordinates;
    } else {
      if (count($ignore) == 0) {
        return $this->createGeoPoint($item, ['address_complement']);
      } elseif (count($ignore == 1)) {
        return $this->createGeoPoint($item, ['address', 'address_complement']);
      } else {
        return [0, 0];
      }
    }
  }
  
}
