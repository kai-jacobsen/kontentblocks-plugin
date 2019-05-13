<?php

/* /edit-screen/user-interface.twig */
class __TwigTemplate_21b0ecbf75ce0f49e150fa22dff753308dd01118ca9b3f050a0d2af17ae9a8fb extends Twig_Template
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
        echo "<div class='klearfix' id='kontentblocks-core-ui'>
    <div class='kb-whiteout' style='display: none;'></div>
    <div class='fullscreen--title-wrapper' style='display: none;'></div>
    <div class='fullscreen--description-wrapper' style='display: none;'></div>
    ";
        // line 5
        echo $this->getAttribute(($context["nonces"] ?? null), "save", array());
        echo "
    ";
        // line 6
        echo $this->getAttribute(($context["nonces"] ?? null), "ajax", array());
        echo "
    <input type='hidden' name='blog_id' value='";
        // line 7
        echo ($context["blogId"] ?? null);
        echo "'>
    <input type=\"hidden\" name=\"kb_preview\" value=\"kb_preview\">

    ";
        // line 10
        if ((($context["hasAreas"] ?? null) == false)) {
            // line 11
            echo "        ";
            echo ($context["noAreas"] ?? null);
            echo "
    ";
        }
        // line 13
        echo "
    ";
        // line 14
        echo $this->getAttribute(($context["ScreenManager"] ?? null), "render", array(), "method");
        echo "
</div> <!--end ks -->
";
    }

    public function getTemplateName()
    {
        return "/edit-screen/user-interface.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 14,  47 => 13,  41 => 11,  39 => 10,  33 => 7,  29 => 6,  25 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class='klearfix' id='kontentblocks-core-ui'>
    <div class='kb-whiteout' style='display: none;'></div>
    <div class='fullscreen--title-wrapper' style='display: none;'></div>
    <div class='fullscreen--description-wrapper' style='display: none;'></div>
    {{ nonces.save | raw }}
    {{ nonces.ajax | raw }}
    <input type='hidden' name='blog_id' value='{{ blogId }}'>
    <input type=\"hidden\" name=\"kb_preview\" value=\"kb_preview\">

    {% if hasAreas == false %}
        {{ noAreas | raw }}
    {% endif %}

    {{ ScreenManager.render() | raw }}
</div> <!--end ks -->
", "/edit-screen/user-interface.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/edit-screen/user-interface.twig");
    }
}
