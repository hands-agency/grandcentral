<?php
/**
 * Boite à outil pour la synchronisation du catalogue Hubber
 *
 * @package  Hubber
 * @author   Sylvain Frigui <sf@cafecentral.fr>
 * @access   public
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class hubberCatalog
{
  private $xml;

/**
 * Récupérer le catalogue
 *
 * @return	bunch  Retourne le bunch des séances de l'événement
 * @access	public
 */
    var $test = "test";

	public function contruct()
	{

	}

/**
 * Récupérer le xml du catalogue
 *
 * @access	public
 */
  public function parse_url($url, $user, $pass)
	{
    $timeout = 15;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FAILONERROR,0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    if (preg_match('`^https://`i', $url))
    {
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    }

    if (!empty($user) && !empty($pass))
    {
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
      curl_setopt($ch, CURLOPT_USERPWD, $user.':'.$pass);
    }

    $this->xml = curl_exec($ch);
    curl_close($ch);
	}

/**
 * Récupérer le xml du catalogue
 *
 * @access	public
 */
  public function parse_xml()
	{
    libxml_use_internal_errors(TRUE);
    $dom = new DomDocument();
    $dom->loadXML($this->xml);
    $errors = libxml_get_errors();
    // error
    if (count($errors) > 0)
    {
      echo "<pre>";print_r($errors);echo "</pre>";
      exit;
    }
    // parse
    else
    {
      $event = $dom->getElementsByTagName("SPECTACLE");
      // echo "<pre>";print_r($event);echo "</pre>";
      foreach ($event as $e)
      {
        echo $e->nodeValue . " / " . $e->firstChild->nodeValue;
        echo "<br /><br /><br /><br /><br /><br /><br /><br />";
      }
      // $root = $dom->documentElement;
      // echo "<pre>";print_r($dom->firstChild->nodeValue);echo "</pre>";
    }
	}

}
?>
