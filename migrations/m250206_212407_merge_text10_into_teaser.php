<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212407_merge_text10_into_teaser migration.
 */
class m250206_212407_merge_text10_into_teaser extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = '7b1fd445-81ea-436d-8033-89fbc11a6ca2';
    public string $outgoingFieldUid = 'fdfea637-9d9a-4e0d-8e75-3a6217c969d6';
}
