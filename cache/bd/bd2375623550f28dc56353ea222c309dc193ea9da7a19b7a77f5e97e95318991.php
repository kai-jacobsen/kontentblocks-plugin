<?php

/* _layouts/default/base.twig */
class __TwigTemplate_f6538b2b6025a0a7ace2eeb03a4c4616864eb82e4f59637b221e390f56b2e425 extends Twig_Template
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
        echo "<div class=\"";
        echo $this->getAttribute(($context["Form"] ?? null), "getClass", array(0 => "main-wrap"), "method");
        echo " ";
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "description"), "method")) {
            echo " field-has-description ";
        }
        echo "\"
     data-kbfuid=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute(($context["Field"] ?? null), "uniqueId", array()), "html_attr");
        echo "\"
     id='";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute(($context["Field"] ?? null), "uniqueId", array()), "html_attr");
        echo "'>
    <div class=\"";
        // line 4
        echo $this->getAttribute(($context["Form"] ?? null), "getClass", array(0 => "type-label"), "method");
        echo "\">";
        echo $this->getAttribute(($context["Field"] ?? null), "getSetting", array(0 => "type"), "method");
        echo "</div>
    <div class=\"";
        // line 5
        echo $this->getAttribute(($context["Form"] ?? null), "getClass", array(0 => "field-header"), "method");
        echo "\">
        ";
        // line 6
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "title"), "method")) {
            // line 7
            echo "            <h4>";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "title"), "method"));
            echo "</h4>
        ";
        }
        // line 9
        echo "    </div>
    <div ";
        // line 10
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
        // line 11
        echo $this->getAttribute(($context["Form"] ?? null), "getLabel", array(), "method");
        echo "

    ";
        // line 13
        $this->displayBlock('fieldmarkup', $context, $blocks);
        // line 16
        echo "
    ";
        // line 17
        echo $this->getAttribute(($context["Form"] ?? null), "getDescription", array(), "method");
        echo "
    </div>
</div>";
    }

    // line 13
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 14
        echo "        ";
        // line 15
        echo "    ";
    }

    public function getTemplateName()
    {
        return "_layouts/default/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 15,  93 => 14,  90 => 13,  83 => 17,  80 => 16,  78 => 13,  73 => 11,  58 => 10,  55 => 9,  49 => 7,  47 => 6,  43 => 5,  37 => 4,  33 => 3,  29 => 2,  20 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"{{ Form.getClass('main-wrap') }} {% if Field.getArg('description') %} field-has-description {% endif %}\"
     data-kbfuid=\"{{ Field.uniqueId|escape('html_attr') }}\"
     id='{{ Field.uniqueId|escape('html_attr') }}'>
    <div class=\"{{ Form.getClass('type-label') }}\">{{ Field.getSetting('type') }}</div>
    <div class=\"{{ Form.getClass('field-header') }}\">
        {% if (Field.getArg('title')) %}
            <h4>{{ Field.getArg('title')|escape }}</h4>
        {% endif %}
    </div>
    <div {% for attr,value in Form.fieldWrapAttributes %} {{ attr }}='{{ value|esc_attr }}' {% endfor %} >
    {{ Form.getLabel() }}

    {% block fieldmarkup %}
        {#goes here#}
    {% endblock %}

    {{ Form.getDescription() }}
    </div>
</div>", "_layouts/default/base.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/_layouts/default/base.twig");
    }
}
