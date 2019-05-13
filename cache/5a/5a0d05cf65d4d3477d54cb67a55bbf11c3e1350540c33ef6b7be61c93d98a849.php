<?php

/* image/default.twig */
class __TwigTemplate_87ceb63ce64161ea7e61c7ff1c6257334e2fa059e7f73b7a05f1f1f3e89bc201 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute(($context["Form"] ?? null), "getLayout", array(), "method"), "image/default.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_fieldmarkup($context, array $blocks = array())
    {
        // line 3
        echo "    <div class='kb-field-image-wrapper' data-kbfield=\"image\">
        <div class='kb-js-add-image kb-field-image-container'>
            ";
        // line 5
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "width"), "method")) {
            // line 6
            echo "                <img src='";
            echo $this->getAttribute($this->getAttribute(($context["image"] ?? null), "size", array(0 => $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "width"), "method"), 1 => $this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "height"), "method")), "method"), "src", array(), "method");
            echo "'>
            ";
        } else {
            // line 8
            echo "                <img src='";
            echo $this->getAttribute($this->getAttribute(($context["image"] ?? null), "size", array(0 => "thumbnail"), "method"), "src", array(), "method");
            echo "'>
            ";
        }
        // line 10
        echo "        </div>
        <div class=\"kb-field-image-meta ";
        // line 11
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "hideMeta"), "method")) {
            echo " kb-hide ";
        }
        echo "\">
            <div class=\"kb-field-image-title\">
                <label>";
        // line 13
        echo $this->getAttribute(($context["i18n"] ?? null), "title", array());
        echo "</label>
                <input class='kb-js-image-title kb-observe' type=\"text\"
                       name='";
        // line 15
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "title"), "method");
        echo "'
                       value='";
        // line 16
        echo $this->getAttribute(($context["value"] ?? null), "title", array());
        echo "'>
            </div>
            <div class=\"kb-field-image-description\">
                <label>";
        // line 19
        echo $this->getAttribute(($context["i18n"] ?? null), "description", array());
        echo "</label>

                <textarea class='kb-js-image-description kb-observe' type=\"text\"
                          name='";
        // line 22
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "caption"), "method");
        echo "'>";
        echo $this->getAttribute(($context["value"] ?? null), "caption", array());
        echo "</textarea>
            </div>
        </div>
        <input class='kb-js-image-id' type='hidden' name='";
        // line 25
        echo $this->getAttribute(($context["Form"] ?? null), "getFieldName", array(0 => "id"), "method");
        echo "' value='";
        echo $this->getAttribute(($context["value"] ?? null), "id", array());
        echo "'>
        ";
        // line 27
        echo "        ";
        // line 28
        echo "    </div>

    <div class=\"kb-field-image--footer\">
        <a class=\"button kb-js-reset-image\">Reset</a>
        ";
        // line 32
        if ($this->getAttribute(($context["Field"] ?? null), "getArg", array(0 => "showcrop", 1 => false), "method")) {
            // line 33
            echo "            ";
            $this->loadTemplate("image/_cropselect.twig", "image/default.twig", 33)->display($context);
            // line 34
            echo "        ";
        }
        // line 35
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "image/default.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 35,  106 => 34,  103 => 33,  101 => 32,  95 => 28,  93 => 27,  87 => 25,  79 => 22,  73 => 19,  67 => 16,  63 => 15,  58 => 13,  51 => 11,  48 => 10,  42 => 8,  36 => 6,  34 => 5,  30 => 3,  27 => 2,  18 => 1,);
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
    <div class='kb-field-image-wrapper' data-kbfield=\"image\">
        <div class='kb-js-add-image kb-field-image-container'>
            {% if (Field.getArg('width')) %}
                <img src='{{ image.size(Field.getArg('width'),Field.getArg('height')).src() }}'>
            {% else %}
                <img src='{{ image.size('thumbnail').src() }}'>
            {% endif %}
        </div>
        <div class=\"kb-field-image-meta {% if Field.getArg('hideMeta') %} kb-hide {% endif %}\">
            <div class=\"kb-field-image-title\">
                <label>{{ i18n.title }}</label>
                <input class='kb-js-image-title kb-observe' type=\"text\"
                       name='{{ Form.getFieldName( 'title') }}'
                       value='{{ value.title }}'>
            </div>
            <div class=\"kb-field-image-description\">
                <label>{{ i18n.description }}</label>

                <textarea class='kb-js-image-description kb-observe' type=\"text\"
                          name='{{ Form.getFieldName( 'caption') }}'>{{ value.caption }}</textarea>
            </div>
        </div>
        <input class='kb-js-image-id' type='hidden' name='{{ Form.getFieldName('id') }}' value='{{ value.id }}'>
        {#<input class='kb-js-image-alt' type='hidden' name='{{ Form.getFieldName( 'details', 'id' ) }}'#}
        {#value='{{ value.details.alt }}'>#}
    </div>

    <div class=\"kb-field-image--footer\">
        <a class=\"button kb-js-reset-image\">Reset</a>
        {% if Field.getArg('showcrop', false) %}
            {% include 'image/_cropselect.twig' %}
        {% endif %}
    </div>
{% endblock %}", "image/default.twig", "/mnt/web301/e0/27/58554227/htdocs/wwwlive/ottojust.de/content/plugins/kontentblocks-plugin/core/Fields/Definitions/templates/image/default.twig");
    }
}
