<?php

// namespace League\HTMLToMarkdown\Converter;

include_once('ConverterInterface.php');

class HorizontalRuleConverter implements ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element)
    {
        return "- - - - - -\n\n";
    }

    /**
     * @return string[]
     */
    public function getSupportedTags()
    {
        return array('hr');
    }
}
