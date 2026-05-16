<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212322_merge_address_into_textMehrzeilig migration.
 */
class m250206_212322_merge_address_into_textMehrzeilig extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = '886f070a-cb44-450c-9a19-eb7233bcf001';
    public string $outgoingFieldUid = 'dfdd2912-b5c1-4601-82a2-43be4bd1f902';
}
