<?php

namespace srag\CustomInputGUIs\OnlyOffice\ColorPickerInputGUI;

use ilColorPickerInputGUI;
use srag\CustomInputGUIs\OnlyOffice\Template\Template;
use srag\DIC\OnlyOffice\DICTrait;

/**
 * Class ColorPickerInputGUI
 *
 * @package srag\CustomInputGUIs\OnlyOffice\ColorPickerInputGUI
 */
class ColorPickerInputGUI extends ilColorPickerInputGUI
{

    use DICTrait;

    /**
     * @inheritDoc
     */
    public function render(/*string*/ $a_mode = "") : string
    {
        $tpl = new Template("Services/Form/templates/default/tpl.property_form.html", true, true);

        $this->insert($tpl);

        $html = self::output()->getHTML($tpl);

        $html = preg_replace("/<\/div>\s*<!--/", "<!--", $html);
        $html = preg_replace("/<\/div>\s*<!--/", "<!--", $html);

        return $html;
    }
}
