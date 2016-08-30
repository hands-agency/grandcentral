<?php

// namespace League\HTMLToMarkdown\Converter;

include_once('ConverterInterface.php');

class CommentConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        return '';
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('#comment');
    }
}
