<?php

// namespace Sioen\HtmlToJson;
//
// use Sioen\SirTrevorBlock;

include_once('StConverter.php');
include_once('StHtmlToMarkdown.php');

final class StBaseConverter implements StConverter
{
    use StHtmlToMarkdown;

    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        return new SirTrevorBlock(
            'text',
            array('text' => ' ' . $this->htmlToMarkdown($html))
        );
    }

    public function matches(\DomElement $node)
    {
        return true;
    }
}
