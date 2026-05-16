<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212519_merge_punktMusterTextVorBild_into_kreisText migration.
 */
class m250206_212519_merge_punktMusterTextVorBild_into_kreisText extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = '8aaaef42-cec6-45d0-8b19-a6e91588f3ac';
    public string $outgoingFieldUid = '23a4f146-62bc-4be6-8249-25578a0c7f39';
}
