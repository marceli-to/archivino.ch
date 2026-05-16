<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_leadText_into_text migration.
 */
class m250206_212335_merge_leadText_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '8a4f4bfd-6801-4e54-bde4-69eac186d83d';
}
