<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'CPSIT.hosts_pattern',
		'system',
		'HostsPattern',
		'after:InstallInstall',
		array(
			'Domain' => 'index',
		),
		array(
			'access' => 'admin',
			'icon' => 'EXT:hosts_pattern/ext_icon.gif',
			'labels' => 'LLL:EXT:hosts_pattern/Resources/Private/Language/locallang_mod.xlf',
		)
	);
}
