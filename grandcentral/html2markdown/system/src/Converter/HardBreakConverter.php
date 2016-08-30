<?php

// namespace League\HTMLToMarkdown\Converter;

include_once('ConverterInterface.php');

class HardBreakConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        return "  \n";
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('br');
    }
}
