<?php

/* _layouts/wp/description.twig */
class __TwigTemplate_d4a6ba1b695cf434bd777e58e8229ce82ca0aa5cc61e1699d046b0581992b6b8 extends Twig_Template
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
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "description"), "method")) {
            // line 2
            echo "    <p class='description kb-field--description'>";
            echo $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "description"), "method");
            echo "</p>
";
        }
    }

    public function getTemplateName()
    {
        return "_layouts/wp/description.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if Field.getArg('description') %}
    <p class='description kb-field--description'>{{ Field.getArg('description') }}</p>
{% endif %}", "_layouts/wp/description.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/_layouts/wp/description.twig");
    }
}
