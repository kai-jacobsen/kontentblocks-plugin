<?php

/* _layouts/wp/label.twig */
class __TwigTemplate_dc16b591d4d9de2f8cfebbe30ac12873b12a5608f69997cc8609abf41363b551 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "label"), "method")) {
            // line 2
            echo "    <label class='kb-label heading kb-field--label-heading'
           for='";
            // line 3
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
            echo "'>";
            echo $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "label"), "method");
            echo "</label>
";
        }
    }

    public function getTemplateName()
    {
        return "_layouts/wp/label.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if Field.getArg('label') %}
    <label class='kb-label heading kb-field--label-heading'
           for='{{ Form.getInputFieldId() }}'>{{ Field.getArg('label') }}</label>
{% endif %}", "_layouts/wp/label.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/_layouts/wp/label.twig");
    }
}
