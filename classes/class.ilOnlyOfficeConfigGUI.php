<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\Plugins\OnlyOffice\Utils\OnlyOfficeTrait;
use srag\DIC\OnlyOffice\DICTrait;

/**
 * Class ilOnlyOfficeConfigGUI
 *
 * Generated by SrPluginGenerator v1.3.4
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilOnlyOfficeConfigGUI extends ilPluginConfigGUI
{

    use DICTrait;
    use OnlyOfficeTrait;
    const PLUGIN_CLASS_NAME = ilOnlyOfficePlugin::class;
    const CMD_CONFIGURE = "configure";
    const CMD_UPDATE_CONFIGURE = "updateConfigure";
    const LANG_MODULE = "config";
    const TAB_CONFIGURATION = "configuration";


    /**
     * ilOnlyOfficeConfigGUI constructor
     */
    public function __construct()
    {

    }


    /**
     * @inheritDoc
     */
    public function performCommand(/*string*/ $cmd)/*:void*/
    {
        $this->setTabs();

        $next_class = self::dic()->ctrl()->getNextClass($this);

        switch (strtolower($next_class)) {
            default:
                $cmd = self::dic()->ctrl()->getCmd();

                switch ($cmd) {
                    case self::CMD_CONFIGURE:
                    case self::CMD_UPDATE_CONFIGURE:
                        $this->{$cmd}();
                        break;

                    default:
                        break;
                }
                break;
        }
    }


    /**
     *
     */
    protected function setTabs()/*: void*/
    {
        self::dic()->tabs()->addTab(self::TAB_CONFIGURATION, self::plugin()->translate("configuration", self::LANG_MODULE), self::dic()->ctrl()
            ->getLinkTargetByClass(self::class, self::CMD_CONFIGURE));

        self::dic()->locator()->addItem(ilOnlyOfficePlugin::PLUGIN_NAME, self::dic()->ctrl()->getLinkTarget($this, self::CMD_CONFIGURE));
    }


    /**
     *
     */
    protected function configure()/*: void*/
    {
        self::dic()->tabs()->activateTab(self::TAB_CONFIGURATION);

        $form = self::onlyOffice()->config()->factory()->newFormInstance($this);

        self::output()->output($form);
    }


    /**
     *
     */
    protected function updateConfigure()/*: void*/
    {
        self::dic()->tabs()->activateTab(self::TAB_CONFIGURATION);

        $form = self::onlyOffice()->config()->factory()->newFormInstance($this);

        if (!$form->storeForm()) {
            self::output()->output($form);

            return;
        }

        ilUtil::sendSuccess(self::plugin()->translate("configuration_saved", self::LANG_MODULE), true);

        self::dic()->ctrl()->redirect($this, self::CMD_CONFIGURE);
    }
}