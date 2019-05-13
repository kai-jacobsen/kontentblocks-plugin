<?php

/* select/default.twig */
class __TwigTemplate_40c89998a1bd2838c3d0555a9f694af7788e44b00bea9c8ac84c7c16b812243d extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "select/default.twig", 1);
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
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "options"), "method")) {
            // line 4
            echo "
    ";
        } else {
            // line 6
            echo "        <p>Please set options to show</p>
    ";
        }
        // line 8
        echo "    <select id='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "'
            ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "attributes", 1 => array()), "method"));
        foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
            // line 10
            echo "                ";
            echo $context["attr"];
            echo "=\"";
            echo call_user_func_array($this->env->getFilter('esc_attr')->getCallable(), array($context["value"]));
            echo "\"
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "            ";
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "select2", 1 => false), "method")) {
            echo " data-kbselect2=\"true\" ";
        }
        // line 13
        echo "            ";
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "multiple", 1 => false), "method")) {
            echo " multiple=\"multiple\" ";
        }
        // line 14
        echo "            ";
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "multiple"), "method")) {
            // line 15
            echo "                name='";
            echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => true), "method");
            echo "'
            ";
        } else {
            // line 17
            echo "                name='";
            echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(), "method");
            echo "'
            ";
        }
        // line 19
        echo "            style=\"width: ";
        echo $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "width", 1 => "280px"), "method");
        echo "\">
        ";
        // line 20
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "empty", 1 => true), "method")) {
            // line 21
            echo "            <option value='' name=''>Bitte wählen</option>
        ";
        }
        // line 23
        echo "
        ";
        // line 24
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "multiple"), "method")) {
            // line 25
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "options"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
                // line 26
                echo "                <option ";
                if (twig_in_filter($this->getAttribute($context["o"], "value", array()), $this->getAttribute(($context["Field"] ?? null), "getValue", array(), "method"))) {
                    echo " selected=\"selected\" ";
                }
                // line 27
                echo "                        value='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["o"], "value", array()), "html_attr");
                echo "'>";
                echo $this->getAttribute($context["o"], "name", array());
                echo "</option>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
            echo "        ";
        } else {
            // line 30
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "options"), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["o"]) {
                // line 31
                echo "                <option ";
                if (($this->getAttribute(($context["Field"] ?? null), "getValue", array()) == $this->getAttribute($context["o"], "value", array()))) {
                    echo " selected=\"selected\" ";
                }
                // line 32
                echo "                        value='";
                echo twig_escape_filter($this->env, $this->getAttribute($context["o"], "value", array()), "html_attr");
                echo "'>";
                echo $this->getAttribute($context["o"], "name", array());
                echo "</option>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['o'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 34
            echo "        ";
        }
        // line 35
        echo "

    </select>
";
    }

    public function getTemplateName()
    {
        return "select/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 35,  147 => 34,  136 => 32,  131 => 31,  126 => 30,  123 => 29,  112 => 27,  107 => 26,  102 => 25,  100 => 24,  97 => 23,  93 => 21,  91 => 20,  86 => 19,  80 => 17,  74 => 15,  71 => 14,  66 => 13,  61 => 12,  50 => 10,  46 => 9,  41 => 8,  37 => 6,  33 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
    {% if (Field.getArg('options')) %}

    {% else %}
        <p>Please set options to show</p>
    {% endif %}
    <select id='{{ Form.getInputFieldId() }}'
            {% for attr, value in Field.getArg('attributes', []) %}
                {{ attr }}=\"{{ value|esc_attr }}\"
            {% endfor %}
            {% if Field.getArg('select2', false) %} data-kbselect2=\"true\" {% endif %}
            {% if Field.getArg('multiple', false) %} multiple=\"multiple\" {% endif %}
            {% if Field.getArg('multiple') %}
                name='{{ Form.getFieldName(true) }}'
            {% else %}
                name='{{ Form.getFieldName() }}'
            {% endif %}
            style=\"width: {{ Field.getArg('width', '280px') }}\">
        {% if (Field.getArg('empty', true)) %}
            <option value='' name=''>Bitte wählen</option>
        {% endif %}

        {% if Field.getArg('multiple') %}
            {% for o in Field.getArg('options') %}
                <option {% if ( o.value in Field.getValue()) %} selected=\"selected\" {% endif %}
                        value='{{ o.value|escape('html_attr') }}'>{{ o.name }}</option>
            {% endfor %}
        {% else %}
            {% for o in Field.getArg('options') %}
                <option {% if (Field.getValue == o.value) %} selected=\"selected\" {% endif %}
                        value='{{ o.value|escape('html_attr') }}'>{{ o.name }}</option>
            {% endfor %}
        {% endif %}


    </select>
{% endblock %}", "select/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/select/default.twig");
    }
}
