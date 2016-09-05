<?php

// namespace Sioen\HtmlToJson;
//
// use Sioen\SirTrevorBlock;

include_once('StConverter.php');
include_once('StHtmlToMarkdown.php');

final class StBlockquoteConverter implements StConverter
{
    use StHtmlToMarkdown;

    public function toJson(\DOMElement $node)
    {
        $converter = new HtmlConverter();
        $cite = $this->getCiteHtml($node);

        // we use the remaining html to create the remaining text
        $html = $node->ownerDocument->saveXML($node);
        $html = preg_replace('/<(\/|)blockquote>/i', '', $html);

        return new SirTrevorBlock(
            'quote',
            array(
                'text' => ' ' . $converter->convert($html),
                'cite' => $cite,
            )
        );
    }

    public function matches(\DomElement $node)
    {
        return $node->nodeName === 'blockquote';
    }

    private function getCiteHtml(\DOMElement $node)
    {
        $cite = '';

        foreach ($this->getCiteNodes($node) as $child) {
            $html = $child->ownerDocument->saveXML($child);
            $html = preg_replace('/<(\/|)cite>/i', '', $html);
            $child->parentNode->removeChild($child);
            $cite = ' ' . $this->htmlToMarkdown($html);
        }

        return $cite;
    }

    private function getCiteNodes(\DOMElement $node)
    {
        return array_filter(
            iterator_to_array($node->childNodes),
            function (\DOMElement $childNode) {
                return $childNode->nodeName == 'cite';
            }
        );
    }
}
