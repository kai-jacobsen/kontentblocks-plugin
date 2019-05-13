<?php

/* no-areas.twig */
class __TwigTemplate_0ead6c847065a99385afa2e25d45716cd9c8b57933475c69ea73f9e17b72cdc6 extends Twig_Template
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
        echo "<div class=\"postbox\">
    <h3 style=\"cursor: initial;\">Kontentblocks</h3>
    <div class=\"inside\">
        <p>";
        // line 4
        echo $this->getAttribute($this->getAttribute(($context["strings"] ?? null), "ui", array()), "noAreas", array());
        echo "</p>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "no-areas.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"postbox\">
    <h3 style=\"cursor: initial;\">Kontentblocks</h3>
    <div class=\"inside\">
        <p>{{ strings.ui.noAreas }}</p>
    </div>
</div>", "no-areas.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/no-areas.twig");
    }
}
