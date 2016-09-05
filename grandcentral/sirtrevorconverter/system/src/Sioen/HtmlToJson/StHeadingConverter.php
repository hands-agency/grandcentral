<?php

// namespace Sioen\HtmlToJson;
//
// use Sioen\SirTrevorBlock;

include_once('StConverter.php');
include_once('StHtmlToMarkdown.php');

final class StHeadingConverter implements StConverter
{
    use StHtmlToMarkdown;

    public function toJson(\DOMElement $node)
    {
        $html = $node->ownerDocument->saveXML($node);

        // remove the h2 tags from the text. We just need the inner text.
        $html = preg_replace('/<(\/|)h2>/i', '', $html);

        return new SirTrevorBlock(
            'heading',
            array('text' => ' ' . $this->htmlToMarkdown($html))
        );
    }

    public function matches(\DomElement $node)
    {
        return $node->nodeName === 'h2';
    }
}
