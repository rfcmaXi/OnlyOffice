<?php

namespace srag\Plugins\OnlyOffice\Config;

use srag\Plugins\OnlyOffice\Utils\OnlyOfficeTrait;
use ilOnlyOfficeConfigGUI;
use ilOnlyOfficePlugin;
use srag\ActiveRecordConfig\OnlyOffice\Config\AbstractFactory;

/**
 * Class Factory
 *
 * Generated by SrPluginGenerator v1.3.4
 *
 * @package srag\Plugins\OnlyOffice\Config
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Factory extends AbstractFactory
{

    use OnlyOfficeTrait;
    const PLUGIN_CLASS_NAME = ilOnlyOfficePlugin::class;
    /**
     * @var self
     */
    protected static $instance = null;


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * Factory constructor
     */
    protected function __construct()
    {
        parent::__construct();
    }


    /**
     * @param ilOnlyOfficeConfigGUI $parent
     *
     * @return ConfigFormGUI
     */
    public function newFormInstance(ilOnlyOfficeConfigGUI $parent) : ConfigFormGUI
    {
        $form = new ConfigFormGUI($parent);

        return $form;
    }
}