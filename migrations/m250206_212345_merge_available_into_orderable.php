<?php

namespace craft\contentmigrations;

use Craft;
use craft\migrations\BaseFieldMergeMigration;

/**
 * m250206_212345_merge_available_into_orderable migration.
 */
class m250206_212345_merge_available_into_orderable extends BaseFieldMergeMigration
{
    public string $persistingFieldUid = 'fcbbcf9e-42d1-49b9-bc7a-18cbdf656153';
    public string $outgoingFieldUid = '5007155b-c7af-449c-b76e-4044401d750a';
}
