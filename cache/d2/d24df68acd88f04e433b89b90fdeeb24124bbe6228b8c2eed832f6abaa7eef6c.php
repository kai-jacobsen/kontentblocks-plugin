<?php

/* renderer/tabs.twig */
class __TwigTemplate_ad3ca342564e9dc8652b0ee27188526ffa7cb546220045c66743a31c37ea2c52 extends Twig_Template
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
        echo "<div class='kb-field--tabs'>
    <ul>
        ";
        // line 4
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["structure"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["renderSection"]) {
            // line 5
            echo "            ";
            if (($this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getNumberOfVisibleFields", array(), "method") > 0)) {
                // line 6
                echo "                <li><a href='#tab-";
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getSectionId", array(), "method");
                echo "'>";
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getLabel", array(), "method");
                echo "</a></li>
            ";
            }
            // line 8
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['renderSection'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 9
        echo "    </ul>
        ";
        // line 11
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["structure"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["renderSection"]) {
            // line 12
            echo "            ";
            if (($this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getNumberOfVisibleFields", array(), "method") > 0)) {
                // line 13
                echo "                <div id='tab-";
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getSectionId", array(), "method");
                echo "'>
                    ";
                // line 14
                echo $this->getAttribute($context["renderSection"], "renderFields", array(), "method");
                echo "
                </div>
            ";
            } else {
                // line 17
                echo "                ";
                echo $this->getAttribute($context["renderSection"], "renderFields", array(), "method");
                echo "
            ";
            }
            // line 19
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['renderSection'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "renderer/tabs.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 20,  73 => 19,  67 => 17,  61 => 14,  56 => 13,  53 => 12,  48 => 11,  45 => 9,  39 => 8,  31 => 6,  28 => 5,  23 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class='kb-field--tabs'>
    <ul>
        {# navigation #}
        {% for renderSection in structure %}
            {% if (renderSection.section.getNumberOfVisibleFields() > 0) %}
                <li><a href='#tab-{{ renderSection.section.getSectionId() }}'>{{ renderSection.section.getLabel() }}</a></li>
            {% endif %}
        {% endfor %}
    </ul>
        {# container #}
        {% for renderSection in structure %}
            {% if (renderSection.section.getNumberOfVisibleFields() > 0) %}
                <div id='tab-{{ renderSection.section.getSectionId() }}'>
                    {{ renderSection.renderFields( ) }}
                </div>
            {% else %}
                {{ renderSection.renderFields() }}
            {% endif %}
        {% endfor %}
</div>
", "renderer/tabs.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/renderer/tabs.twig");
    }
}
