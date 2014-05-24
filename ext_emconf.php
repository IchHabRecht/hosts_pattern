<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "hosts_pattern".
 *
 * Auto generated 24-05-2014 12:06
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Trusted Hosts Pattern',
	'description' => 'Generate trustedHostsPattern from existing domain records',
	'category' => 'plugin',
	'author' => 'Nicole Cordes',
	'author_email' => 'cordes@cps-it.de',
	'author_company' => 'CPS-IT GmbH',
	'shy' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'extbase' => '1.3.0-6.2.99',
			'fluid' => '1.3.0-6.2.99',
			'typo3' => '4.5.0-6.2.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:12:{s:12:"ext_icon.gif";s:4:"e477";s:14:"ext_tables.php";s:4:"dd34";s:24:"ext_typoscript_setup.txt";s:4:"ce74";s:39:"Classes/Controller/DomainController.php";s:4:"2296";s:31:"Classes/Domain/Model/Domain.php";s:4:"74b7";s:46:"Classes/Domain/Repository/DomainRepository.php";s:4:"f5d5";s:34:"Classes/Service/PatternService.php";s:4:"d89f";s:34:"Configuration/TypoScript/setup.txt";s:4:"2ed5";s:44:"Resources/Private/Language/locallang_mod.xlf";s:4:"1b6e";s:38:"Resources/Private/Layouts/Default.html";s:4:"b1cf";s:45:"Resources/Private/Templates/Domain/Index.html";s:4:"f196";s:41:"Tests/Unit/Service/PatternServiceTest.php";s:4:"7281";}',
);

?>