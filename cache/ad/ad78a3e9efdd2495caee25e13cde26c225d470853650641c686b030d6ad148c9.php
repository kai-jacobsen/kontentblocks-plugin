<?php

/* link/default.twig */
class __TwigTemplate_889e346bd6f7ca01e45492849f0c21c4be378c1888048cb7418875ae26020d2d extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "link/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "    <label for='";
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => "link"), "method");
        echo "'>";
        echo $this->getAttribute(($context["i18n"] ?? null), "linklabel", array());
        echo "</label><br>
    <input type='text' data-kbf-link-url class='kb-js-link-input regular' id='";
        // line 4
        echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(), "method");
        echo "'
           name='";
        // line 5
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "link"), "method");
        echo "' placeholder='";
        echo $this->getAttribute(($context["Form"] ?? null), "getPlaceholder", array(), "method");
        echo "'
           value='";
        // line 6
        echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(0 => "link"), "method");
        echo "'/>
    <a class='button kb-js-add-link'>";
        // line 7
        echo $this->getAttribute(($context["i18n"] ?? null), "addLink", array());
        echo "</a>

    ";
        // line 9
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "linktext", 1 => true), "method")) {
            // line 10
            echo "        <div class='kb-field--link-meta'><label for='";
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => "linktext"), "method");
            echo "'>";
            echo $this->getAttribute(($context["i18n"] ?? null), "linktext", array());
            echo "</label><br>
            <input type='text' data-kbf-link-linktext class='kb-field--link-linktext'
                   id='";
            // line 12
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => "linktext"), "method");
            echo "'
                   value='";
            // line 13
            echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(0 => "linktext"), "method");
            echo "' name='";
            echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "linktext"), "method");
            echo "'>
        </div>
    ";
        }
        // line 16
        echo "
    ";
        // line 17
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "linktitle"), "method")) {
            // line 18
            echo "        <div class='kb-field--link-meta'><label
                    for='";
            // line 19
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => "linktitle"), "method");
            echo "'>";
            echo $this->getAttribute(($context["i18n"] ?? null), "linktitle", array());
            echo "</label><br>
            <input type='text' class='kb-field--link-linktitle' id='";
            // line 20
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => "linktitle"), "method");
            echo "'
                   value='";
            // line 21
            echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(0 => "linktitle"), "method");
            echo "' name='";
            echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "linktitle"), "method");
            echo "'>
        </div>
    ";
        }
        // line 24
        echo "
    ";
        // line 25
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "showtarget"), "method")) {
            // line 26
            echo "        <div class='kb-field--link-meta'>
            <label for='";
            // line 27
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => false, 1 => "target"), "method");
            echo "'>
                <input data-kbf-link-target type='checkbox' class='kb-field--link-target'
                       id='";
            // line 29
            echo $this->getAttribute(($context["Form"] ?? null), "getInputFieldId", array(0 => false, 1 => "target"), "method");
            echo "'
                        ";
            // line 30
            echo call_user_func_array($this->env->getFunction('checked')->getCallable(), array($this->getAttribute(($context["Field"] ?? null), "getValue", array(0 => "target"), "method"), true));
            echo "
                       value='";
            // line 31
            echo $this->getAttribute(($context["Field"] ?? null), "getValue", array(0 => "target"), "method");
            echo "' name='";
            echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "target"), "method");
            echo "'>
                ";
            // line 32
            echo $this->getAttribute(($context["i18n"] ?? null), "linktarget", array());
            echo " </label>
        </div>
    ";
        }
    }

    public function getTemplateName()
    {
        return "link/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  131 => 32,  125 => 31,  121 => 30,  117 => 29,  112 => 27,  109 => 26,  107 => 25,  104 => 24,  96 => 21,  92 => 20,  86 => 19,  83 => 18,  81 => 17,  78 => 16,  70 => 13,  66 => 12,  58 => 10,  56 => 9,  51 => 7,  47 => 6,  41 => 5,  37 => 4,  30 => 3,  27 => 2,  18 => 1,);
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
    <label for='{{ Form.getInputFieldId('link') }}'>{{ i18n.linklabel }}</label><br>
    <input type='text' data-kbf-link-url class='kb-js-link-input regular' id='{{ Form.getInputFieldId() }}'
           name='{{ Form.getFieldName('link') }}' placeholder='{{ Form.getPlaceholder() }}'
           value='{{ Field.getValue('link') }}'/>
    <a class='button kb-js-add-link'>{{ i18n.addLink }}</a>

    {% if Field.getArg('linktext', true) %}
        <div class='kb-field--link-meta'><label for='{{ Form.getInputFieldId('linktext') }}'>{{ i18n.linktext }}</label><br>
            <input type='text' data-kbf-link-linktext class='kb-field--link-linktext'
                   id='{{ Form.getInputFieldId('linktext') }}'
                   value='{{ Field.getValue('linktext') }}' name='{{ Form.getFieldName('linktext') }}'>
        </div>
    {% endif %}

    {% if Field.getArg('linktitle') %}
        <div class='kb-field--link-meta'><label
                    for='{{ Form.getInputFieldId('linktitle') }}'>{{ i18n.linktitle }}</label><br>
            <input type='text' class='kb-field--link-linktitle' id='{{ Form.getInputFieldId('linktitle') }}'
                   value='{{ Field.getValue('linktitle') }}' name='{{ Form.getFieldName('linktitle') }}'>
        </div>
    {% endif %}

    {% if Field.getArg('showtarget') %}
        <div class='kb-field--link-meta'>
            <label for='{{ Form.getInputFieldId(false,'target') }}'>
                <input data-kbf-link-target type='checkbox' class='kb-field--link-target'
                       id='{{ Form.getInputFieldId(false,'target') }}'
                        {{ checked(Field.getValue('target'), true) }}
                       value='{{ Field.getValue('target') }}' name='{{ Form.getFieldName('target') }}'>
                {{ i18n.linktarget }} </label>
        </div>
    {% endif %}
{% endblock %}", "link/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/link/default.twig");
    }
}
