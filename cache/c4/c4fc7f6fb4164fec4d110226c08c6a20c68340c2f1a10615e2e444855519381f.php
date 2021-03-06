<?php

/* flexfields/default.twig */
class __TwigTemplate_29ed3dbea79264ec7fbacd0a33ac7da8ad1fcd7f75c70d27eef64707fd42dc18 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'fieldmarkup' => array($this, 'block_fieldmarkup'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "flexfields/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "<div id='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "' data-fieldkey='";
        echo $this->getAttribute(($context["Field"] ?? null), "getKey", array(), "method");
        echo "'
     data-arraykey='";
        // line 4
        echo $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "arrayKey"), "method");
        echo "' data-module='";
        echo $this->getAttribute(($context["Field"] ?? null), "getFieldId", array(), "method");
        echo "'
     class='flexible-fields--stage'></div>
";
    }

    public function getTemplateName()
    {
        return "flexfields/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 4,  30 => 3,  27 => 2,  18 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends Form.getLayout() %}
{% block fieldmarkup %}
<div id='{{ Form.getInputFieldId() }}' data-fieldkey='{{ Field.getKey() }}'
     data-arraykey='{{ Field.getArg('arrayKey') }}' data-module='{{ Field.getFieldId() }}'
     class='flexible-fields--stage'></div>
{% endblock %}", "flexfields/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/flexfields/default.twig");
    }
}
