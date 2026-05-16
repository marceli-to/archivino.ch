<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_buttonText_into_text migration.
 */
class m250206_212335_merge_buttonText_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '085e2d53-fb75-46fc-b3c8-c42267dd9aa8';
}
