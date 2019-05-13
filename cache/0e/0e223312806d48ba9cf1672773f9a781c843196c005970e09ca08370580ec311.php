<?php

/* renderer/sections.twig */
class __TwigTemplate_4c4d093f43f27be7b69b5713469b66593dfa6d7f41656b083aeefb93b396c5db extends Twig_Template
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
        echo "<div class=\"kbf-fieldrenderer-sections--nav\">
    <div class=\"kb-context__header kb-field-section kb-field-section--quicknav\">
        <h2>Quicknav</h2>
        <ul class=\"kbf-sections-quicknav\">
            ";
        // line 6
        echo "                ";
        // line 7
        echo "                    ";
        // line 8
        echo "                ";
        // line 9
        echo "            ";
        // line 10
        echo "        </ul>
    </div>
</div>
<div class='kbf-fieldrenderer-sections kbf-field-sections' data-kb-field-renderer=\"sections\">
    ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["structure"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["renderSection"]) {
            // line 15
            echo "    ";
            if (($this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getNumberOfVisibleFields", array(), "method") > 0)) {
                // line 16
                echo "    <div id='section-";
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getSectionId", array(), "method");
                echo "'
         class=\"kbf-section-wrap\"
    ";
                // line 18
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "args", array()), "attributes", array()));
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 19
                    echo "        ";
                    echo $context["key"];
                    echo "='";
                    echo $context["value"];
                    echo "'
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 21
                echo "    >
    <div class=\"kb-context__header kb-field-section\" data-kb-toggle-trigger=\"";
                // line 22
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "uid", array());
                echo "\">
        <div class=\"kb-field-section-actions\">
            <div class=\"kb-toggle\"></div>
        </div>
        <h2>";
                // line 26
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "getTitle", array(), "method");
                echo "</h2>
    </div>
    <div class=\"kb-field-section--container\" data-kb-toggle-container=\"";
                // line 28
                echo $this->getAttribute($this->getAttribute($context["renderSection"], "section", array()), "uid", array());
                echo "\">
        ";
                // line 29
                echo $this->getAttribute($context["renderSection"], "renderFields", array(), "method");
                echo "
    </div>
</div>
";
            }
            // line 33
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['renderSection'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "renderer/sections.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 34,  93 => 33,  86 => 29,  82 => 28,  77 => 26,  70 => 22,  67 => 21,  56 => 19,  52 => 18,  46 => 16,  43 => 15,  39 => 14,  33 => 10,  31 => 9,  29 => 8,  27 => 7,  25 => 6,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"kbf-fieldrenderer-sections--nav\">
    <div class=\"kb-context__header kb-field-section kb-field-section--quicknav\">
        <h2>Quicknav</h2>
        <ul class=\"kbf-sections-quicknav\">
            {#{% for renderSection in structure %}#}
                {#<li>#}
                    {#<a href=\"#section-{{ renderSection.section.getSectionId() }}\">{{ renderSection.section.args.title }}</a>#}
                {#</li>#}
            {#{% endfor %}#}
        </ul>
    </div>
</div>
<div class='kbf-fieldrenderer-sections kbf-field-sections' data-kb-field-renderer=\"sections\">
    {% for renderSection in structure %}
    {% if (renderSection.section.getNumberOfVisibleFields() > 0) %}
    <div id='section-{{ renderSection.section.getSectionId() }}'
         class=\"kbf-section-wrap\"
    {% for key,value in renderSection.section.args.attributes %}
        {{ key }}='{{ value }}'
    {% endfor %}
    >
    <div class=\"kb-context__header kb-field-section\" data-kb-toggle-trigger=\"{{ renderSection.section.uid }}\">
        <div class=\"kb-field-section-actions\">
            <div class=\"kb-toggle\"></div>
        </div>
        <h2>{{ renderSection.section.getTitle() }}</h2>
    </div>
    <div class=\"kb-field-section--container\" data-kb-toggle-container=\"{{ renderSection.section.uid }}\">
        {{ renderSection.renderFields() }}
    </div>
</div>
{% endif %}
    {% endfor %}
</div>
", "renderer/sections.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Templating/templates/renderer/sections.twig");
    }
}
