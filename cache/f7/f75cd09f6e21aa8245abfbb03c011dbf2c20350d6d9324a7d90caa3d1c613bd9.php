<?php

/* edit-screen/default-ui-boxes.twig */
class __TwigTemplate_ea0a56e910ba33a75bd78cc05989ccd61783154eb81692dc0cc177a15700e0da extends Twig_Template
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
        echo $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "top", array()), "render", array(), "method");
        echo "
";
        // line 2
        $context["side2hasAreas"] = $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "side2", array()), "hasAreas", array(), "method");
        // line 3
        echo "    ";
        if ($this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "side", array()), "hasAreas", array(), "method")) {
            // line 4
            echo "        <div class=\"kb-context-row grid\">
            ";
            // line 5
            if (($context["side2hasAreas"] ?? null)) {
                // line 6
                echo "                <div data-kbcolname=\"Left\" class=\"grid__col grid__col--4-of-12 kb-context-col\">
                    ";
                // line 7
                echo $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "side2", array()), "render", array(), "method");
                echo "
                </div>
            ";
            }
            // line 10
            echo "
            <div data-kbcolname=\"Normal\"
                 class=\"grid__col ";
            // line 12
            if (($context["side2hasAreas"] ?? null)) {
                echo "grid__col--4-of-12 ";
            } else {
                echo " grid__col--6-of-12 ";
            }
            echo " kb-context-col\">
                ";
            // line 13
            echo $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "normal", array()), "render", array(), "method");
            echo "
            </div>
            <div data-kbcolname=\"Side\"
                 class=\"grid__col ";
            // line 16
            if (($context["side2hasAreas"] ?? null)) {
                echo "grid__col--4-of-12 ";
            } else {
                echo " grid__col--6-of-12 ";
            }
            echo " kb-context-col\">
                ";
            // line 17
            echo $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "side", array()), "render", array(), "method");
            echo "
            </div>
        </div>
    ";
        } else {
            // line 21
            echo "        ";
            echo $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "normal", array()), "render", array(), "method");
            echo "
    ";
        }
        // line 23
        echo $this->getAttribute($this->getAttribute(($context["contexts"] ?? null), "bottom", array()), "render", array(), "method");
    }

    public function getTemplateName()
    {
        return "edit-screen/default-ui-boxes.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 23,  75 => 21,  68 => 17,  60 => 16,  54 => 13,  46 => 12,  42 => 10,  36 => 7,  33 => 6,  31 => 5,  28 => 4,  25 => 3,  23 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{{ contexts.top.render() }}
{% set side2hasAreas = contexts.side2.hasAreas() %}
    {% if contexts.side.hasAreas() %}
        <div class=\"kb-context-row grid\">
            {% if side2hasAreas %}
                <div data-kbcolname=\"Left\" class=\"grid__col grid__col--4-of-12 kb-context-col\">
                    {{ contexts.side2.render() }}
                </div>
            {% endif %}

            <div data-kbcolname=\"Normal\"
                 class=\"grid__col {% if side2hasAreas %}grid__col--4-of-12 {% else %} grid__col--6-of-12 {% endif %} kb-context-col\">
                {{ contexts.normal.render() }}
            </div>
            <div data-kbcolname=\"Side\"
                 class=\"grid__col {% if side2hasAreas %}grid__col--4-of-12 {% else %} grid__col--6-of-12 {% endif %} kb-context-col\">
                {{ contexts.side.render() }}
            </div>
        </div>
    {% else %}
        {{ contexts.normal.render() }}
    {% endif %}
{{ contexts.bottom.render() }}", "edit-screen/default-ui-boxes.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/edit-screen/default-ui-boxes.twig");
    }
}
