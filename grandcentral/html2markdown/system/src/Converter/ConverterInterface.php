<?php

// namespace League\HTMLToMarkdown\Converter;

interface ConverterInterface
{
    /**
     * @param ElementInterface $element
     *
     * @return string
     */
    public function convert(ElementInterface $element);

    /**
     * @return string[]
     */
    public function getSupportedTags();
}
