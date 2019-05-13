<?php

/* _layouts/wp/base.twig */
class __TwigTemplate_e51964b1bcd34d74c0bb05fa1b7d3bf74cf0ebc351fd46c60c785a0e24ef7e2a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'fieldmarkup' => array($this, 'block_fieldmarkup'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<tr class=\"";
        echo $this->getAttribute(($context["Form"] ?? null), "getClass", array(0 => "main-wrap"), "method");
        echo "  ";
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "description"), "method")) {
            echo " field-has-description ";
        }
        echo "\"
    data-kbfuid=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute(($context["Field"] ?? null), "uniqueId", array()), "html_attr");
        echo "\"
    data-kbfield=\"";
        // line 3
        echo $this->getAttribute(($context["Field"] ?? null), "type", array());
        echo "\"
    id='";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute(($context["Field"] ?? null), "uniqueId", array()), "html_attr");
        echo "'>
    <th scope=\"row\">";
        // line 5
        echo $this->getAttribute(($context["Form"] ?? null), "getLabel", array(), "method");
        echo "</th>
    <td>
        ";
        // line 7
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "title"), "method")) {
            // line 8
            echo "            <div class=\"kb-field-header\">
                <h4>";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "title"), "method"));
            echo "</h4>
            </div>
        ";
        }
        // line 12
        echo "        <div ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["Form"] ?? null), "fieldWrapAttributes", array()));
        foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
            echo " ";
            echo $context["attr"];
            echo "='";
            echo call_user_func_array($this->env->getFilter('esc_attr')->getCallable(), array($context["value"]));
            echo "' ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " >

        ";
        // line 14
        $this->displayBlock('fieldmarkup', $context, $blocks);
        // line 17
        echo "
        </div>
        ";
        // line 19
        echo $this->getAttribute(($context["Form"] ?? null), "getDescription", array(), "method");
        echo "

    </td>
</tr>";
    }

    // line 14
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 15
        echo "            ";
        // line 16
        echo "        ";
    }

    public function getTemplateName()
    {
        return "_layouts/wp/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 16,  91 => 15,  88 => 14,  80 => 19,  76 => 17,  74 => 14,  57 => 12,  51 => 9,  48 => 8,  46 => 7,  41 => 5,  37 => 4,  33 => 3,  29 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<tr class=\"{{ Form.getClass('main-wrap') }}  {% if Field.getArg('description') %} field-has-description {% endif %}\"
    data-kbfuid=\"{{ Field.uniqueId|escape('html_attr') }}\"
    data-kbfield=\"{{ Field.type }}\"
    id='{{ Field.uniqueId|escape('html_attr') }}'>
    <th scope=\"row\">{{ Form.getLabel() }}</th>
    <td>
        {% if (Field.getArg('title')) %}
            <div class=\"kb-field-header\">
                <h4>{{ Field.getArg('title')|escape }}</h4>
            </div>
        {% endif %}
        <div {% for attr,value in Form.fieldWrapAttributes %} {{ attr }}='{{ value|esc_attr }}' {% endfor %} >

        {% block fieldmarkup %}
            {#goes here#}
        {% endblock %}

        </div>
        {{ Form.getDescription() }}

    </td>
</tr>", "_layouts/wp/base.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/_layouts/wp/base.twig");
    }
}
