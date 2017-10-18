<?php
/**
* TDC Event object
*
* @package  Core
* @author   Sylvain Frigui <sf@cafecentral.fr>
* @access   public
* @see      http://www.cafecentral.fr/fr/wiki
*/
class itemExhibition extends _items
{
  public $tagrel;

  /**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_formated_date($for)
	{

		switch (true)
		{
      // pas de date remplie
			case $this['start']->is_empty() && $this['end']->is_empty():
				$return = null;
				break;
    // si date de départ et de fin avec année différentes
      case !$this['start']->is_empty() && !$this['end']->is_empty() && $this['start']->format('Y') != $this['end']->format('Y'):
        $sday = $this['start']->format('j') == '1' ? $this['start']->format('j').cst('DATE_DAY_FIRST') : $this['start']->format('j');
        $smonth = $this['start']->format('n') == $this['end']->format('n') ? null : cst('MONTH_'.$this['start']->format('n'));
        $eday = $this['end']->format('j') == '1' ? $this['end']->format('j').cst('DATE_DAY_FIRST') : $this['end']->format('j');
        $return = cst('EVENT_BOX_DATE_START_DATE_END', array(
          'sday' => $sday,
          'smonth' => $smonth,
          'syear' => $this['start']->format('Y'),
          'eday' => $eday,
          'emonth' => cst('MONTH_'.$this['end']->format('n')),
          'eyear' => $this['end']->format('Y')
        ));
        break;
      // si date de départ uniquement ou si jour et mois de la date de début de et fin correspondent
			case !$this['start']->is_empty() && $this['end']->is_empty():
			case !$this['start']->is_empty() && !$this['end']->is_empty() && $this['start']->format('dn') == $this['end']->format('dn'):
				$sday = $this['start']->format('j') == '1' ? $this['start']->format('j').cst('DATE_DAY_FIRST') : $this['start']->format('j');
        $hour = $this['start']->format('i') == '00' ? $this['start']->format('H\h') : $this['start']->format('H\hi');
				$return = cst('EVENT_BOX_DATE_START', array(
					'sday' => $sday,
					'smonth' => cst('MONTH_'.$this['start']->format('n')),
					'year' => cst($this['end']->format('Y')),
          'hour' => '&nbsp;'.$hour
				));
				break;
			default:
				$sday = $this['start']->format('j') == '1' ? $this['start']->format('j').cst('DATE_DAY_FIRST') : $this['start']->format('j');
				$smonth = $this['start']->format('n') == $this['end']->format('n') ? null : cst('MONTH_'.$this['start']->format('n'));
				$eday = $this['end']->format('j') == '1' ? $this['end']->format('j').cst('DATE_DAY_FIRST') : $this['end']->format('j');
        if ($for === 'cover') {
          $return = cst('EVENT_BOX_DATE_END_COVER', array(
            'sday' => $sday,
            'smonth' => $smonth,
            'eday' => $eday,
            'emonth' => cst('MONTH_'.$this['end']->format('n')),
            'year' => $this['end']->format('Y')
          ));
        }
        else {
          $return = cst('EVENT_BOX_DATE_END', array(
            'sday' => $sday,
            'smonth' => $smonth,
            'eday' => $eday,
            'emonth' => cst('MONTH_'.$this['end']->format('n')),
            'year' => $this['end']->format('Y')
          ));
        }
				break;
		}
		return $return;
	}
}
?>
