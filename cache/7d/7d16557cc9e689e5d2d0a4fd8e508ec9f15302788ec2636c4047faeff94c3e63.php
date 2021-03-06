<?php

/* textarea/default.twig */
class __TwigTemplate_aad7e1859ccfc840a1ecb948ee625dbe88df5000d89ecbb1df3474835742b311 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "textarea/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "<textarea id='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "' name='";
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(), "method");
        echo "'
          placeholder='";
        // line 4
        echo $this->getAttribute(($context["Form"] ?? null), "getPlaceholder", array(), "method");
        echo "'
        ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "attributes", 1 => array()), "method"));
        foreach ($context['_seq'] as $context["attr"] => $context["value"]) {
            // line 6
            echo "            ";
            echo $context["attr"];
            echo "=\"";
            echo call_user_func_array($this->env->getFilter('esc_attr')->getCallable(), array($context["value"]));
            echo "\"
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attr'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo ">";
        echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(), "method");
        echo "</textarea>
";
    }

    public function getTemplateName()
    {
        return "textarea/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 7,  45 => 6,  41 => 5,  37 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
<textarea id='{{ Form.getInputFieldId() }}' name='{{ Form.getFieldName() }}'
          placeholder='{{ Form.getPlaceholder() }}'
        {% for attr, value in Field.getArg('attributes', []) %}
            {{ attr }}=\"{{ value|esc_attr }}\"
        {% endfor %}>{{ Field.getValue() }}</textarea>
{% endblock %}", "textarea/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/textarea/default.twig");
    }
}
