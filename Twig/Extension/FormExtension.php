<?php

namespace Toinou\SummernoteBundle\Twig\Extension;

class FormExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    private $environment;
    private $widgetConfig;

    public function __construct(\Twig_Environment $environment, $widgetConfig)
    {
        $this->environment = $environment;
        $this->widgetConfig = $widgetConfig;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'summernote_form_javascript',
                array($this, 'renderJavascript'),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'summernote_form_stylesheet',
                array($this, 'renderStylesheet'),
                array('is_safe' => array('html'))
            ),
        );
    }

    public function renderJavascript($form = null)
    {
        $this->template = $this->environment->loadTemplate(
            '@ToinouSummernote/Form/summernoteJavascript.html.twig'
        );
        $formOptions = array();
        foreach ($form as $child) {
            if (isset($child->vars['toinou_summernote_form_options'])) {
                $formOptions = $child->vars['toinou_summernote_form_options'];
            }
        }
        return $this->template->renderBlock(
            'summernote_javascript',
            array(
                'toinou_summernote_config_form_options' => $this->generateOptions($formOptions),
                'toinou_summernote_config_path' => $this->widgetConfig['summernote_path'],
            )
        );
    }

    public function renderStylesheet($form = null)
    {
        $this->template = $this->environment->loadTemplate('@ToinouSummernote/Form/summernoteStylesheet.html.twig');
        return $this->template->renderBlock(
            'summernote_stylesheet',
            array(
                'toinou_summernote_config_path' => $this->widgetConfig['summernote_path'],
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'toinousummernote.twig.extension.form';
    }

    private function generateOptions($formOptions)
    {
        //Toolbar
        $toolbar = array();
        foreach ($this->widgetConfig['toolbar'] as $buttonsGroup) {
            $toolbar[] = array($buttonsGroup['name'], $buttonsGroup['buttons']);
        }
        $options = array(
            'width' => $this->widgetConfig['width'],
            'height' => $this->widgetConfig['height'],
            'focus' => ($this->widgetConfig['focus']) ? 'true' : 'false',
            'toolbar' => $toolbar,
            'styleTags' => $this->widgetConfig['styleTags'],
            'fontNames' => $this->widgetConfig['fontNames'],
            'fontSizes' => $this->widgetConfig['fontSizes'],
            'colors' => $this->widgetConfig['colors'],
            'placeholder' => $this->widgetConfig['placeholder'],
        );
        if (isset($formOptions['others'])) {
            $options = array_merge($options, $formOptions['others']);
        }
        $optionsJson = '{';
        $optionsJson .= $this->generateJson($options, $nbElem);
        $optionsJson .= ($nbElem > 0) ? ',' : '';
        $optionsJson .= 'callbacks: {onImageUpload: function (files) {sendFile(files[0], $(this));}}';
        $optionsJson .= '}';
        return $optionsJson;
    }

    private function generateJson($options, &$nbElem)
    {
        $json = '';
        $i = 0;
        $nbElem = 0;
        foreach ($options as $key => $value) {
            if (!empty($value) && $value != "[]" && $value != "false") {
                if ($nbElem > 0) {
                    $json .= ','."\n";
                }
                $json .= $key.': '.json_encode($value);
                $nbElem++;
            }
            $i++;
        }
        return $json;
    }

    /**
     * {@inheritdoc}
     */
    public function getGlobals()
    {
        return array();
    }
}
