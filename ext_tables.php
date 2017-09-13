<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}
call_user_func(
    function ($extKey) {
        if (TYPO3_MODE === 'BE') {

            \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
                'IchHabRecht.hosts_pattern',
                'tools',
                'HostsPattern',
                '',
                [
                    'Domain' => 'index',
                ],
                [
                    'access' => 'admin',
                    'icon' => 'EXT:' . $extKey . '/Resources/Public/Icons/module-hostspattern.svg',
                    'labels' => 'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_mod.xml',
                ]
            );

            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
                'hosts_pattern',
                'setup',
                '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $extKey . '/Configuration/TypoScript/setup.txt">'
            );
        }
    },
    $_EXTKEY
);