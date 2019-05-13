<?php

/* no-module-options.twig */
class __TwigTemplate_b91c496d464d1584395732d70a459ed778530c3590e646a51188d21f66137a08 extends Twig_Template
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
        echo "<div class=\"kb-field-wrapper kb-fields-no-options\">
    <p>No configuration options available</p>
</div>";
    }

    public function getTemplateName()
    {
        return "no-module-options.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"kb-field-wrapper kb-fields-no-options\">
    <p>No configuration options available</p>
</div>", "no-module-options.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/no-module-options.twig");
    }
}
