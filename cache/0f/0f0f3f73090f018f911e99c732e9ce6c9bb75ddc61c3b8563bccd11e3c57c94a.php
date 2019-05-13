<?php

/* checkbox/default.twig */
class __TwigTemplate_45be4347b395d41094bcddcea78429603e13e4acf01c6c308743f759d34abe6d extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "checkbox/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "    <label><input type='checkbox' id='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "'
                  name='";
        // line 4
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(), "method");
        echo "' ";
        echo call_user_func_array($this->env->getFunction('checked')->getCallable(), array($this->getAttribute(($context["Field"] ?? null), "getValue", array(), "method"), true, false));
        echo " /> ";
        echo $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "text", 1 => "Please label this checkbox"), "method");
        echo "
    </label>
";
    }

    public function getTemplateName()
    {
        return "checkbox/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
    <label><input type='checkbox' id='{{ Form.getInputFieldId() }}'
                  name='{{ Form.getFieldName() }}' {{ checked(Field.getValue(), true, false) }} /> {{ Field.getArg( 'text', 'Please label this checkbox' ) }}
    </label>
{% endblock %}", "checkbox/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/checkbox/default.twig");
    }
}
