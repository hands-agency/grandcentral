<?php

// namespace Sioen\HtmlToJson;
//
// use Sioen\SirTrevorBlock;

include_once('StConverter.php');
include_once('StHtmlToMarkdown.php');

final class StImageConverter implements StConverter
{
    use StHtmlToMarkdown;

    public function toJson(\DOMElement $node)
    {
        return new SirTrevorBlock(
            'image',
            array(
                'file' => array('url' => $node->getAttribute('src')),
            )
        );
    }

    public function matches(\DomElement $node)
    {
        return $node->nodeName === 'img';
    }
}
