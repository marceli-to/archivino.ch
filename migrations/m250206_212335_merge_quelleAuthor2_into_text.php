<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_quelleAuthor2_into_text migration.
 */
class m250206_212335_merge_quelleAuthor2_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '40f09193-87cb-4bd1-9930-76c625d38f47';
}
