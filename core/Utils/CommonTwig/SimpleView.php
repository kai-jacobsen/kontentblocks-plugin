<?php

namespace Kontentblocks\Utils\CommonTwig;

use Kontentblocks\Backend\Environment\Save\ConcatContent;
use Kontentblocks\Templating\Twig;


/**
 * View
 */
class SimpleView
{
    public $concat;
    /**
     * Template data
     * @var array
     */
    protected $data;

    /**
     * Template file
     * @var string
     */
    protected $tplFile;

    /**
     * @var SimpleTwig
     */
    protected $engine;

    /**
     * Absolute path to templates
     * @var string
     */
    protected $path;

    /**
     * @param bool $tpl
     * @param array $data
     * @param bool $concat
     */
    public function __construct($tpl = null, $data = array(), $concat = false, $path = null)
    {
        $this->data = apply_filters('kb.module.view.data',$data);
        $this->tplFile = $tpl;
        $this->concat = $concat;
        $this->engine = Kontentblocks()->getService('templating.twig.common');
        $this->path = $path;
    }

    public function addData($data)
    {
        if (!is_array($data)) {
            return null;
        }

        $this->data = wp_parse_args($data, $this->data);
    }

    /**
     *
     * @param bool $echo
     * @return bool
     */
    public function render($echo = false)
    {
        $concater = ConcatContent::getInstance();

        if (!is_null($this->path)) {
            if (!empty($this->path) && is_dir($this->path)) {
                Twig::setPath($this->path);
            }
        }

        $out = $this->engine->render($this->tplFile, $this->data);

        if (current_theme_supports('kb.area.concat') && filter_input(
                INPUT_GET,
                'concat',
                FILTER_SANITIZE_STRING
            )
        ) {
            if ($this->concat) {
                $concater->addString(wp_kses_post($out));
            }
        }

        if ($echo) {
            echo $out;
        } else {
            return $out;
        }

        return false;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

}
