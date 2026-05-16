<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_notes_into_text migration.
 */
class m250206_212335_merge_notes_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '12023467-3ec3-4db1-ae0e-f5de70de3aaa';
}
