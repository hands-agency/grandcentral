<?php
/**
* TDC Event object
*
* @package  Core
* @author   Sylvain Frigui <sf@cafecentral.fr>
* @access   public
* @see      http://www.cafecentral.fr/fr/wiki
*/
class itemExternalevent extends _items
{
  /**
 * Obtenir la date formatée pour l'affichage
 *
 * @return	string  la date formatée
 * @access	public
 */
	public function get_formated_date($for = false)
	{
    // echo "<pre>";print_r($this);echo "</pre>";
		switch (true)
		{
      // pas de date remplie
			case $this['start_date']->is_empty() && $this['end_date']->is_empty():
				$return = null;
				break;
    // si date de départ et de fin avec année différentes
      case !$this['start_date']->is_empty() && !$this['end_date']->is_empty() && $this['start_date']->format('Y') != $this['end_date']->format('Y'):
        $sday = $this['start_date']->format('j') == '1' ? $this['start_date']->format('j').cst('DATE_DAY_FIRST') : $this['start_date']->format('j');
        $smonth = $this['start_date']->format('n') == $this['end_date']->format('n') ? null : cst('MONTH_'.$this['start_date']->format('n'));
        $eday = $this['end_date']->format('j') == '1' ? $this['end_date']->format('j').cst('DATE_DAY_FIRST') : $this['end_date']->format('j');
        $return = cst('EVENT_BOX_DATE_START_DATE_END', array(
          'sday' => $sday,
          'smonth' => $smonth,
          'syear' => $this['start_date']->format('Y'),
          'eday' => $eday,
          'emonth' => cst('MONTH_'.$this['end_date']->format('n')),
          'eyear' => $this['end_date']->format('Y')
        ));
        break;
      // si date de départ uniquement ou si jour et mois de la date de début de et fin correspondent
			case !$this['start_date']->is_empty() && $this['end_date']->is_empty():
			case !$this['start_date']->is_empty() && !$this['end_date']->is_empty() && $this['start_date']->format('dn') == $this['end_date']->format('dn'):
				$sday = $this['start_date']->format('j') == '1' ? $this['start_date']->format('j').cst('DATE_DAY_FIRST') : $this['start_date']->format('j');
        $hour = $this['start_date']->format('i') == '00' ? $this['start_date']->format('H\h') : $this['start_date']->format('H\hi');
				$return = cst('EVENT_BOX_DATE_START', array(
					'sday' => $sday,
					'smonth' => cst('MONTH_'.$this['start_date']->format('n')),
					'year' => cst($this['end_date']->format('Y')),
          'hour' => '&nbsp;'.$hour
				));
				break;
			default:
				$sday = $this['start_date']->format('j') == '1' ? $this['start_date']->format('j').cst('DATE_DAY_FIRST') : $this['start_date']->format('j');
				$smonth = $this['start_date']->format('n') == $this['end_date']->format('n') ? null : cst('MONTH_'.$this['start_date']->format('n'));
				$eday = $this['end_date']->format('j') == '1' ? $this['end_date']->format('j').cst('DATE_DAY_FIRST') : $this['end_date']->format('j');
        if ($for === 'cover') {
          $return = cst('EVENT_BOX_DATE_END_COVER', array(
            'sday' => $sday,
            'smonth' => $smonth,
            'eday' => $eday,
            'emonth' => cst('MONTH_'.$this['end_date']->format('n')),
            'year' => $this['end_date']->format('Y')
          ));
        }
        else {
          $return = cst('EVENT_BOX_DATE_START_DATE_END', array(
            'sday' => $sday,
            'smonth' => $smonth,
            'syear' => '',
            'eday' => $eday,
            'emonth' => cst('MONTH_'.$this['end_date']->format('n')),
            'eyear' => $this['end_date']->format('Y')
          ));
        }
				break;
		}
		return $return;
	}
}
?>
