<?php

/* editor/default.twig */
class __TwigTemplate_5952dd48aad675bbdbb918607f3f8974b7b2dc1340d808bc7b9fe2303b6322c7 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "editor/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "    ";
        $context["settings"] = $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "settings"), "method");
        // line 4
        echo "    ";
        echo ($context["editorHTML"] ?? null);
        echo "

    ";
        // line 6
        if ($this->getAttribute(($context["settings"] ?? null), "charlimit", array())) {
            // line 7
            echo "        <span class=\"char-limit\">asd</span>
    ";
        }
    }

    public function getTemplateName()
    {
        return "editor/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 7,  39 => 6,  33 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
    {% set settings = Field.getArg('settings') %}
    {{ editorHTML }}

    {% if settings.charlimit %}
        <span class=\"char-limit\">asd</span>
    {% endif %}
{% endblock %}", "editor/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/editor/default.twig");
    }
}
