<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "hosts_pattern".
 *
 * Auto generated 31-01-2018 23:02
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Trusted Hosts Pattern',
  'description' => 'Set TYPO3_CONF_VARS[\'SYS\'][\'trustedHostsPattern\'] depending on available sys_domain records',
  'category' => 'module',
  'author' => 'Nicole Cordes',
  'author_email' => 'typo3@cordes.co',
  'author_company' => 'CPS-IT GmbH',
  'state' => 'stable',
  'uploadfolder' => 0,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '2.3.1',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '7.6.0-9.1.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  '_md5_values_when_last_written' => 'a:19:{s:9:"ChangeLog";s:4:"d60e";s:9:"README.md";s:4:"0315";s:13:"composer.json";s:4:"dc52";s:12:"ext_icon.png";s:4:"dc44";s:14:"ext_tables.php";s:4:"e34e";s:24:"sonar-project.properties";s:4:"3687";s:39:"Classes/Controller/DomainController.php";s:4:"b8d5";s:31:"Classes/Domain/Model/Domain.php";s:4:"9191";s:46:"Classes/Domain/Repository/DomainRepository.php";s:4:"61d9";s:34:"Classes/Service/PatternService.php";s:4:"a6ba";s:49:"Classes/ViewHelpers/Be/Buttons/IconViewHelper.php";s:4:"4b78";s:34:"Configuration/TypoScript/setup.txt";s:4:"7901";s:33:"Migrations/Code/ClassAliasMap.php";s:4:"e1b8";s:44:"Resources/Private/Language/locallang_mod.xlf";s:4:"1b6e";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"58bc";s:38:"Resources/Private/Layouts/Default.html";s:4:"7847";s:45:"Resources/Private/Templates/Domain/Index.html";s:4:"1855";s:46:"Resources/Public/Icons/module-hostspattern.svg";s:4:"dc49";s:41:"Tests/Unit/Service/PatternServiceTest.php";s:4:"e085";}',
);

