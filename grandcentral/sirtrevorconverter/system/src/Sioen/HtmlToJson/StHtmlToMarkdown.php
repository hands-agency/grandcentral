<?php

// namespace Sioen\HtmlToJson;

trait StHtmlToMarkdown
{
    /**
     * @param string $html
     * @return string
     */
    protected function htmlToMarkdown($html)
    {
        $markdown = new HtmlConverter(
            array(
                'header_style' => 'atx',
                'bold_style' => '__',
                'italic_style' => '_',
            )
        );

        return $markdown->convert($html);
    }
}
