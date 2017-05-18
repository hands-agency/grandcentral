<?php

// namespace Sioen\HtmlToJson;
//
// use Sioen\SirTrevorBlock;

include_once('StConverter.php');
include_once('StHtmlToMarkdown.php');

final class StBreakConverter implements StConverter
{
    use StHtmlToMarkdown;

    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        return new SirTrevorBlock(
            'break',
            ['text' => '']
        );
    }

    public function matches(\DomElement $node)
    {
        return $node->nodeName === 'hr';
    }
}
