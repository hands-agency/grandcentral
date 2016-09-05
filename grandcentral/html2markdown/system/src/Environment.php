<?php

// namespace League\HTMLToMarkdown;

include_once('Converter/BlockquoteConverter.php');
include_once('Converter/CommentConverter.php');
include_once('Converter/ConverterInterface.php');
include_once('Converter/DefaultConverter.php');
include_once('Converter/DivConverter.php');
include_once('Converter/EmphasisConverter.php');
include_once('Converter/HardBreakConverter.php');
include_once('Converter/HeaderConverter.php');
include_once('Converter/HorizontalRuleConverter.php');
include_once('Converter/ImageConverter.php');
include_once('Converter/LinkConverter.php');
include_once('Converter/ListBlockConverter.php');
include_once('Converter/ListItemConverter.php');
include_once('Converter/ParagraphConverter.php');
include_once('Converter/PreformattedConverter.php');
include_once('Converter/TextConverter.php');

final class Environment
{
    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var ConverterInterface[]
     */
    protected $converters = array();

    public function __construct(array $config = array())
    {
        $this->config = new Configuration($config);
        $this->addConverter(new DefaultConverter());
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param ConverterInterface $converter
     */
    public function addConverter(ConverterInterface $converter)
    {
        if ($converter instanceof ConfigurationAwareInterface) {
            $converter->setConfig($this->config);
        }

        foreach ($converter->getSupportedTags() as $tag) {
            $this->converters[$tag] = $converter;
        }
    }

    /**
     * @param string $tag
     *
     * @return ConverterInterface
     */
    public function getConverterByTag($tag)
    {
        if (isset($this->converters[$tag])) {
            return $this->converters[$tag];
        }

        return $this->converters[DefaultConverter::DEFAULT_CONVERTER];
    }

    /**
     * @param array $config
     *
     * @return Environment
     */
    public static function createDefaultEnvironment(array $config = array())
    {
        $environment = new static($config);

        // $environment->addConverter(new BlockquoteConverter());
        $environment->addConverter(new CommentConverter());
        $environment->addConverter(new DivConverter());
        $environment->addConverter(new EmphasisConverter());
        $environment->addConverter(new HardBreakConverter());
        $environment->addConverter(new HeaderConverter());
        $environment->addConverter(new HorizontalRuleConverter());
        // $environment->addConverter(new ImageConverter());
        $environment->addConverter(new LinkConverter());
        $environment->addConverter(new ListBlockConverter());
        $environment->addConverter(new ListItemConverter());
        $environment->addConverter(new ParagraphConverter());
        $environment->addConverter(new PreformattedConverter());
        $environment->addConverter(new TextConverter());

        return $environment;
    }
}
