<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_vornameName_into_text migration.
 */
class m250206_212335_merge_vornameName_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = 'caa10602-6f6f-4e6b-be96-1b74923ffc6a';
}
