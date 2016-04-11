<?php
/**
 * Magazines
 *
 * @access	public
 * @link		http://grandcentral.fr
 */
class itemMagazine extends _items
{
/**
 * Save item into database and synchronise article
 *
 * @access  public
 */
	public function save()
	{
		parent::save();

    // remise à zéro des champs magazine dans les articles liés
    $articles = $this['article']->unfold();
    $articles->get('article', array(
      'magazine' => $this->get_nickname()
    ));
    if ($articles->count > 0)
    {
      // connexion à la base de données
      $db = database::connect('site');

      foreach ($articles as $article)
      {
        // suppression de la relation
        if (!in_array($article->get_nickname(), $this['article']->get()))
        {
          $q = 'UPDATE article SET magazine = "" WHERE id = '.$article['id'];
        }
        // création de la relation
        else
        {
          $q = 'UPDATE article SET magazine = "'.$this->get_nickname().'" WHERE id = '.$article['id'];
        }
        // exécuton de la requête
        $db->query($q);
      }
    }
	}
/**
 * Format date for display
 *
 * @access  public
 */
	public function format_date()
	{
		if ($this['date']->is_empty()) return '';

		return $this['date']->format('j').' '.cst('MONTH_'.$this['date']->format('n')).' '.$this['date']->format('Y');
	}
}
?>
