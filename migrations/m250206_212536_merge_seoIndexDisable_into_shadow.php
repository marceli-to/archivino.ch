<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212536_merge_seoIndexDisable_into_shadow migration.
 */
class m250206_212536_merge_seoIndexDisable_into_shadow extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'e5c29b20-b727-4470-b986-c1e8f0b72894';
    public string $outgoingFieldUid = 'b9e91a70-6b6d-425d-a869-238d3c1d0608';
}
