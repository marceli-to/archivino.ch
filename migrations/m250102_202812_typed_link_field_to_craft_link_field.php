<?php

namespace craft\contentmigrations;

use Craft;
use craft\base\ElementInterface;
use craft\base\FieldInterface;
use craft\db\Migration;
use craft\db\Query;
use craft\fields\Link;
use craft\helpers\Db;
use craft\helpers\Json;
use craft\helpers\App;

/**
 * m250102_202812_typed_link_field_to_craft_link_field migration.
 */
class m250102_202812_typed_link_field_to_craft_link_field extends Migration
{
    public array $allowedTypes = [
        'asset',
        'email',
        'entry',
        'url',
    ];

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // O7
        App::maxPowerCaptain();

        // Get all Lenz LinkField fields
        $fields = (new Query())
            ->from('{{%fields}}')
            ->where(['type' => 'lenz\linkfield\fields\LinkField'])
            ->all();

        foreach ($fields as $field) {
            echo "Preparing to migrate field “{$field['handle']}” ({$field['uid']}) settings.\n";

            $lenzFieldSettings = json_decode($field['settings']);
            $nativeFieldSettings = [
                'maxLength' => 255, // Can use $lenzFieldSettings['customTextMaxLength'], but that's not the same, so default
                'showLabelField' => $lenzFieldSettings->allowCustomText,
                'typeSettings' => [
                    'entry' => [
                        'sources' => $lenzFieldSettings->typeSettings->entry->sources
                    ],
                    'url' => [
                        'allowRootRelativeUrls' => '1', // Default, no Lenz equivalent?
                        'allowAnchors' => '1' // Default, no Lenz equivalent?
                    ],
                    'asset' => [
                        'sources' => $lenzFieldSettings->typeSettings->asset->sources,
                        'allowedKinds' => '*', // Default, no Lenz equivalent?
                        'showUnpermittedVolumes' => '1', // Default, no Lenz equivalent?
                        'showUnpermittedFiles' => '1' // Default, no Lenz equivalent?
                    ],
                    'category' => [
                        'sources' => $lenzFieldSettings->typeSettings->category->sources
                    ]
                ],
                'types' => [
                ],
            ];

            // Detect any equivalent advanced settings
            if ($lenzFieldSettings->allowTarget) {
                $nativeFieldSettings['advancedFields'] = ['target'];
            }

            // Test to see if each type setting is enabled
            if ($lenzFieldSettings->typeSettings->entry->enabled) {
                array_push($nativeFieldSettings['types'], 'entry');
            }
            if ($lenzFieldSettings->typeSettings->url->enabled) {
                array_push($nativeFieldSettings['types'], 'url');
            }
            if ($lenzFieldSettings->typeSettings->asset->enabled) {
                array_push($nativeFieldSettings['types'], 'asset');
            }
            if ($lenzFieldSettings->typeSettings->category->enabled) {
                array_push($nativeFieldSettings['types'], 'category');
            }
            if ($lenzFieldSettings->typeSettings->email->enabled) {
                array_push($nativeFieldSettings['types'], 'email');
            }
            if ($lenzFieldSettings->typeSettings->tel->enabled) {
                array_push($nativeFieldSettings['types'], 'tel');
            }

            // Update the type and settings for Lenz linked fields to native Craft Link field equivalents
            $this->update(
                '{{%fields}}',
                [
                    'type' => Link::class,
                    'settings' => json_encode($nativeFieldSettings)
                ],
                ['uid' => $field['uid']]
            );

            // Migrate content
            echo "Preparing to migrate field “{$field['handle']}” ({$field['uid']}) content.\n";
            $fieldModel = Craft::$app->getFields()->getFieldById($field['id']);

            if ($fieldModel) {
                // Get content from the lenz_linkfield table
                $contentRows = (new Query())
                    ->select(['*'])
                    ->from('{{%lenz_linkfield}}')
                    ->where(['fieldId' => $fieldModel['id']])
                    ->all();

                if ($fieldModel->context === 'global') {
                    foreach ($contentRows as $row) {
                        $settings = $this->convertLinkContent($fieldModel, $row);

                        $element = Craft::$app->getElements()->getElementById($row['elementId'], null, $row['siteId']);
                        if ($element) {
                            if ($settings) {
                                $newContent = $this->getElementContentForField($element, $fieldModel, $settings);

                                Db::update('{{%elements_sites}}', ['content' => $newContent], ['elementId' => $row['elementId'], 'siteId' => $row['siteId']]);

                                echo "    > Migrated content for element #{$row['elementId']}\n";
                            } else {
                                if ($settings !== null) {
                                    echo "    > Unable to convert content for element #{$row['elementId']}\n";
                                }
                            }
                        } else {
                            echo "    > Unable to find element #{$row['elementId']} and site #{$row['siteId']}\n";
                        }
                    }
                }
            }
            echo "> Field “{$field['handle']}” content migrated.\n\n";
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m250102_202812_typed_link_field_to_craft_link_field cannot be reverted.\n";
        return false;
    }

    public function convertLinkContent($field, array $settings): bool|array|null
    {
        $linkType = $settings['type'] ?? null;

        if (!$linkType) {
            return null;
        }

        if (!in_array($linkType, $this->allowedTypes)) {
            return false;
        }

        $advanced = Json::decode($settings['payload']);
        $linkValue = $settings['linkedUrl'] ?? null;
        $linkText = $advanced['customText'] ?? null;
        $linkSiteId = $settings['siteId'] ?? null;
        $linkId = $settings['linkedId'] ?? null;

        if (($linkType === 'entry' || $linkType === 'asset') && (!$linkId || !$linkSiteId)) {
            return false;
        }

        if ($linkType === 'entry') {
            $linkValue = "{entry:{$linkId}@{$linkSiteId}:url}";
        } elseif ($linkType === 'asset') {
            $linkValue = "{asset:{$linkId}@{$linkSiteId}:url}";
        } elseif ($linkType === 'email') {
            $linkValue = 'mailto:' . $linkValue;
        }

        return [
            'value' => $linkValue,
            'type' => $linkType,
            'label' => $linkText,
            'target' => null,
        ];
    }

    // From:
    // https://github.com/verbb/hyper/blob/craft-5/src/migrations/PluginContentMigration.php#L141
    protected function getElementContentForField(ElementInterface $element, FieldInterface $field, array $fieldValue): array
    {
        $fieldContent = [];

        // Get the field content as JSON, indexed by field layout element UID
        if ($fieldLayout = $element->getFieldLayout()) {
            foreach ($fieldLayout->getCustomFields() as $fieldLayoutField) {
                $sourceHandle = $fieldLayoutField->layoutElement?->getOriginalHandle() ?? $fieldLayoutField->handle;

                if ($field->handle === $sourceHandle) {
                    $fieldContent[$fieldLayoutField->layoutElement->uid] = $fieldValue;
                }
            }
        }

        // Fetch the current JSON content so we can merge in the new field content
        $oldContent = Json::decode((new Query())
            ->select(['content'])
            ->from('{{%elements_sites}}')
            ->where(['elementId' => $element->id, 'siteId' => $element->siteId])
            ->scalar() ?? '') ?? [];

        // Another sanity check just in cases where content is double encoded
        if (is_string($oldContent) && Json::isJsonObject($oldContent)) {
            $oldContent = Json::decode($oldContent);
        }

        return array_merge($oldContent, $fieldContent);
    }
}