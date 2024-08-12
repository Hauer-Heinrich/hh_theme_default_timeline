<?php
declare(strict_types=1);
defined('TYPO3') or die();

call_user_func(function(string $extensionKey) {
    // Adds the content element to the "Type" dropdown
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            // title
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_timeline.xlf:{{EXTENSION_NAME}}_timeline.title',
            // plugin signature: extkey_identifier
            'value' => '{{EXTENSION_NAME}}_timeline',
            // icon identifier
            'icon' => 'content-text',
            // group
            'group' => 'default',
            // description
            'description' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_timeline.xlf:{{EXTENSION_NAME}}_timeline.description',
        ],
        'textmedia',
        'after',
    );

    // Adds the content element icon to TCA typeicon_classes
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['{{EXTENSION_NAME}}_timeline'] = 'content-text';

    // Adds custom fields
    $temporaryColumn = [
        '{{EXTENSION_NAME}}_timeline_content' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_timeline.xlf:{{EXTENSION_NAME}}_timeline_content.label',
            'description' => 'LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_timeline.xlf:{{EXTENSION_NAME}}_timeline_content.description',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_{{EXTENSION_NAME}}_timeline_content',
                'foreign_field' => 'parentid',
                'foreign_table_field' => 'parenttable',
                'foreign_sortby' => 'sorting',
                'minitems' => 0,
                'maxitems' => 999,
                'appearance' => [
                    'collapseAll' => true,
                    'enabledControls' => [
                        'dragdrop' => true,
                    ],
                    'expandSingle' => true,
                    'levelLinksPosition' => 'both',
                    'showAllLocalizationLink' => true,
                    'showPossibleLocalizationRecords' => true,
                    'showSynchronizationLink' => true,
                    'useSortable' => true,
                    'enabledControls' => [
                        'info' => false,
                    ],
                    'behaviour' => [
                        'allowLanguageSynchronization' => true,
                    ],
                ],
            ],
        ],
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumn);


    // Configure the default backend fields for the content element
    $GLOBALS['TCA']['tt_content']['types']['{{EXTENSION_NAME}}_timeline'] = [
        'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;;general,
                    --palette--;;headers,
                    bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
                --div--;LLL:EXT:'.$extensionKey.'/Resources/Private/Language/locallang_timeline.xlf:{{EXTENSION_NAME}}_timeline.tabs.content,
                    {{EXTENSION_NAME}}_timeline_content,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;;frames,
                    --palette--;;appearanceLinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                    rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
        'columnsOverrides' => [
            'bodytext' => [
                'config' => [
                    'enableRichtext' => true,
                    'richtextConfiguration' => 'default',
                ],
            ],
        ],
    ];

}, '{{EXTENSION_KEY}}');
