<?php

namespace Kontentblocks\Fields\Renderer;


use Kontentblocks\Fields\Field;
use Kontentblocks\Fields\StandardFieldSection;
use Kontentblocks\Templating\CoreView;

/**
 * Class RenderSection
 * @package Kontentblocks\Fields\Renderer
 */
class RenderSection
{

    /**
     * @var StandardFieldSection
     */
    public $section;

    /**
     * @var array
     */
    public $fields;

    /**
     * RenderSection constructor.
     * @param StandardFieldSection $section
     * @param array $fields
     */
    public function __construct(StandardFieldSection $section, $fields = array())
    {
        $this->section = $section;
        if (!empty($fields)) {
            $this->fields = $fields;
        }
    }

    /**
     * @return string
     */
    public function renderFields()
    {
        $out = '';
        $subtabs = apply_filters('kb.fields.subtabs', false);
        if ($this->section->args['subtabs'] === true) {
            $subtabs = true;
        }
        if (!empty($this->fields) && $subtabs) {
            $container = new CoreView(
                'renderer/sections-subtabs.twig', array(
                    'fields' => $this->fields,
                    'section' => $this->section
                )
            );
            $out .= $container->render();
        } else {
            /** @var Field $field */
            foreach ($this->fields as $field) {
                $out .= $field->render();
            }
        }

        return $out;
    }


}