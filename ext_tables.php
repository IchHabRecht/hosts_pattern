<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	Tx_Extbase_Utility_Extension::registerModule(
		'hosts_pattern',
		'tools',
		'HostsPattern',
		'',
		array(
			'Domain' => 'index',
		),
		array(
			'access' => 'admin',
			'icon' => 'EXT:hosts_pattern/ext_icon.gif',
			'labels' => 'LLL:EXT:hosts_pattern/Resources/Private/Language/locallang_mod.xml',
		)
	);
}
