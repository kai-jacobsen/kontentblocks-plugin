<?php

/* renderer/wp.twig */
class __TwigTemplate_ff1fe97f7f789d8bcc614299292746756c04d7fb8b1545827dead7adf83d556f extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["structure"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["section"]) {
            // line 2
            echo "    ";
            if (($this->getAttribute($this->getAttribute($context["section"], "section", array()), "getNumberOfVisibleFields", array(), "method") > 0)) {
                // line 3
                echo "        ";
                echo $this->getAttribute($context["section"], "renderFields", array(), "method");
                echo "
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['section'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "renderer/wp.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 3,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% for section in structure %}
    {% if (section.section.getNumberOfVisibleFields() > 0) %}
        {{ section.renderFields( ) }}
    {% endif %}
{% endfor %}", "renderer/wp.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/renderer/wp.twig");
    }
}
