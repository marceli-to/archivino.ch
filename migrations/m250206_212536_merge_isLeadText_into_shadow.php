<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212536_merge_isLeadText_into_shadow migration.
 */
class m250206_212536_merge_isLeadText_into_shadow extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'e5c29b20-b727-4470-b986-c1e8f0b72894';
    public string $outgoingFieldUid = 'ef58b43c-e5e3-40b4-8f2e-fae3fa3a7a3a';
}
