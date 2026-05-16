<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_bild2_into_text migration.
 */
class m250206_212335_merge_bild2_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '7f91b341-6f35-4ce9-8cd1-7ab5c5b9b7e6';
}
