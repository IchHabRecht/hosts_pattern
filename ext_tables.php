<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'IchHabRecht.hosts_pattern',
        'tools',
        'HostsPattern',
        '',
        array(
            'Domain' => 'index',
        ),
        array(
            'access' => 'admin',
            'icon' => 'EXT:hosts_pattern/Resources/Public/Icons/module-hostspattern.svg',
            'labels' => 'LLL:EXT:hosts_pattern/Resources/Private/Language/locallang_mod.xml',
        )
    );

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
        'hosts_pattern',
        'setup',
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:hosts_pattern/Configuration/TypoScript/setup.txt">'
    );
}
