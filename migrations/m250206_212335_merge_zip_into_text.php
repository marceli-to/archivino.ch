<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_zip_into_text migration.
 */
class m250206_212335_merge_zip_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '275d7d80-4d75-49cf-aa8b-9c1b4be69e81';
}
