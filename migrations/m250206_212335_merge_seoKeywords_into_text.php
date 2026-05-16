<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212335_merge_seoKeywords_into_text migration.
 */
class m250206_212335_merge_seoKeywords_into_text extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'f3c02f46-7585-4f62-85fc-0c26355e8b23';
    public string $outgoingFieldUid = '29c1a5d4-669a-413c-9232-e1e4950ab0bc';
}
