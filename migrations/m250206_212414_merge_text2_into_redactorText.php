<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212414_merge_text2_into_redactorText migration.
 */
class m250206_212414_merge_text2_into_redactorText extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'b54f2bd0-8d40-4afa-a8cb-0e27ee121596';
    public string $outgoingFieldUid = 'b21cd4fa-97ca-47d9-877c-3c5ac507b5da';
}
