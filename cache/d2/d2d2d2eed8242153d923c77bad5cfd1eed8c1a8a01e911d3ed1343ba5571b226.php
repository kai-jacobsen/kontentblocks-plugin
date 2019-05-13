<?php

/* text/default.twig */
class __TwigTemplate_e7c4abf063ee149ff4f13837b4c53af3f43d9ef22ee91494e825e5c086e1af5f extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "text/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "<input
        type=\"";
        // line 4
        echo $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "type", 1 => "text"), "method");
        echo "\"
    ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "attributes", 1 => array()), "method"));
        foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
            // line 6
            echo "        ";
            echo $context["attr"];
            echo "=\"";
            echo call_user_func_array($this->env->getFilter('esc_attr')->getCallable(), array($context["value"]));
            echo "\"
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "    id='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "'
    name='";
        // line 9
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array());
        echo "'
    placeholder='";
        // line 10
        echo $this->getAttribute(($context["Form"] ?? null), "getPlaceholder", array(), "method");
        echo "'
    value='";
        // line 11
        echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(), "method");
        echo "' />
";
    }

    public function getTemplateName()
    {
        return "text/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 11,  61 => 10,  57 => 9,  52 => 8,  41 => 6,  37 => 5,  33 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
<input
        type=\"{{ Field.getArg('type', 'text') }}\"
    {% for attr, value in Field.getArg('attributes', []) %}
        {{ attr }}=\"{{ value|esc_attr }}\"
    {% endfor %}
    id='{{ Form.getInputFieldId() }}'
    name='{{ Form.getFieldName }}'
    placeholder='{{ Form.getPlaceholder() }}'
    value='{{ Field.getValue()|raw }}' />
{% endblock %}", "text/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/text/default.twig");
    }
}
