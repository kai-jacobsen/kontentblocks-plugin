<?php

/* edit-screen/area-header.twig */
class __TwigTemplate_4fe19743030153dbafd5f2f1113c69fdf9ccdd03d445ca03561c3982f9e3a5b2 extends Twig_Template
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
        echo "<div class='kb-area__head klearfix ";
        echo $this->getAttribute(($context["area"] ?? null), "get", array(0 => "context"), "method");
        echo " ";
        echo ($context["headerClass"] ?? null);
        echo "'>
    <div class='kb-area__title-text'>
        <span class='title'>";
        // line 3
        echo $this->getAttribute(($context["area"] ?? null), "get", array(0 => "name"), "method");
        echo "</span>
        ";
        // line 5
        echo "        <input type='hidden' name='areas[]' value='";
        echo $this->getAttribute(($context["area"] ?? null), "get", array(0 => "id"), "method");
        echo "'>
        <input type=\"hidden\" name=\"kbcontext[";
        // line 6
        echo $this->getAttribute(($context["area"] ?? null), "get", array(0 => "context"), "method");
        echo "][";
        echo $this->getAttribute(($context["area"] ?? null), "get", array(0 => "id"), "method");
        echo "]\">
    </div>
    <div class='kb-ajax-status-dark'></div>
</div>";
    }

    public function getTemplateName()
    {
        return "edit-screen/area-header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 6,  31 => 5,  27 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class='kb-area__head klearfix {{ area.get('context') }} {{ headerClass }}'>
    <div class='kb-area__title-text'>
        <span class='title'>{{ area.get('name') }}</span>
        {#<span class='description'>{{area.get('description')}}</span>#}
        <input type='hidden' name='areas[]' value='{{ area.get('id') }}'>
        <input type=\"hidden\" name=\"kbcontext[{{ area.get('context') }}][{{ area.get('id') }}]\">
    </div>
    <div class='kb-ajax-status-dark'></div>
</div>", "edit-screen/area-header.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/edit-screen/area-header.twig");
    }
}
