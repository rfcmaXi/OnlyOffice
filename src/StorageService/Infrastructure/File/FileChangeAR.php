<?php

namespace srag\Plugins\OnlyOffice\StorageService\Infrastructure\File;

use ActiveRecord;
use srag\Plugins\OnlyOffice\StorageService\Infrastructure\Common\UUID;

/**
 * Class FileChangeAR
 *
 * Stores the changes between file versions
 * such that they can easily be passed back
 * to the OnlyOffice Server
 *
 * @package srag\Plugins\OnlyOffice\StorageService\Infrastructure\File
 * @author Sophie Pfister <sophie@fluxlabs.ch>
 */
class FileChangeAR extends ActiveRecord
{
    const TABLE_NAME = 'xono_file_change';


    /**
     * @return string
     */
    public function getConnectorContainerName()
    {
        return self::TABLE_NAME;
    }

    /**
     * @var int
     * @con_has_field    true
     * @con_fieldtype    integer
     * @con_is_primary   true
     */
    protected $change_id;

    /**
     * @var UUID
     * @con_has_field true
     * @con_fieldtype text
     * @con_length    256
     */
    protected $file_uuid;
    /**
     * @var int
     * @con_has_field    true
     * @con_fieldtype    integer
     */
    protected $version;

    /**
     * @var string
     * @con_has_field true
     * @con_fieldtype text
     * @con_length    1024
     */
    protected $changesObjectString;
    /**
     * @var string
     * @con_has_field true
     * @con_fieldtype text
     * @con_length    64
     */
    protected $serverVersion;
    /**
     * @var string
     * @con_has_field true
     * @con_fieldtype text
     * @con_length    256
     */
    protected $changesUrl;

    public function setChangeId(int $change_id)
    {
        $this->change_id = $change_id;
    }

    public function getChangeId() : int
    {
        return $this->change_id;
    }

    public function setFileUuid(UUID $file_uuid)
    {
        $this->file_uuid = $file_uuid;
    }

    public function getFileUuid() : UUID
    {
        return $this->file_uuid;
    }

    public function setVersion(int $version)
    {
        $this->version = $version;
    }

    public function getVersion() : int
    {
        return $this->version;
    }

    public function setChangesObjectString(string $changesObjectString)
    {
        $this->changesObjectString = $changesObjectString;
    }

    public function getChanges() : string
    {
        return $this->changesObjectString;
    }

    public function setServerVersion(string $serverVersion)
    {
        $this->serverVersion = $serverVersion;
    }

    public function getServerVersion() : string
    {
        return $this->serverVersion;
    }

    public function setChangesUrl(string $changesUrl)
    {
        $this->changesUrl = $changesUrl;
    }

    public function getChangesUrl() : string
    {
        return $this->changesUrl;
    }

    /**
     * @param $field_name
     * @return mixed
     */
    public function sleep($field_name)
    {
        switch ($field_name) {
            case 'uuid':
                return $this->uuid->asString();
            default:
                return parent::sleep($field_name);
        }
    }

    /**
     * @param $field_name
     * @param $field_value
     * @return mixed
     */
    public function wakeUp($field_name, $field_value)
    {
        switch ($field_name) {
            case 'uuid':
                return new UUID($field_value);
            default:
                return parent::wakeUp($field_name, $field_value);
        }
    }


}