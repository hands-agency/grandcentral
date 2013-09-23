<?php
/**
 * La classe de manipulation des vues event-stream
 *
 * @package  views
 * @author   Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @see      http://www.cafecentral.fr/fr/wiki
 */
class eventstream extends _views
{
	protected $key = 'eventstream';
	const content_type = 'text/event-stream';
}
?>