<?php

/* color/default.twig */
class __TwigTemplate_a3ffd3f37b265618269fa542806bb66ffd59006dec1be883b1463a063d50f308 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "color/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "    <input class='kb-color-picker' data-alpha=\"true\" type='text' name='";
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(), "method");
        echo "' id='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "'
           value='";
        // line 4
        echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(), "method");
        echo "' size='7'/>
    ";
        // line 5
        echo ($context["error"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "color/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 5,  37 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
    <input class='kb-color-picker' data-alpha=\"true\" type='text' name='{{ Form.getFieldName() }}' id='{{ Form.getInputFieldId() }}'
           value='{{ Field.getValue() }}' size='7'/>
    {{ error }}
{% endblock %}", "color/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/color/default.twig");
    }
}
