<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "hosts_pattern".
 *
 * Auto generated 29-10-2015 23:09
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Trusted Hosts Pattern',
  'description' => 'Generate trustedHostsPattern from existing domain records',
  'category' => 'plugin',
  'author' => 'Nicole Cordes',
  'author_email' => 'cordes@cps-it.de',
  'author_company' => 'CPS-IT GmbH',
  'state' => 'stable',
  'uploadfolder' => 0,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '2.0.0',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '7.5.0-7.99.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  '_md5_values_when_last_written' => 'a:15:{s:9:"ChangeLog";s:4:"d0c6";s:12:"ext_icon.gif";s:4:"e477";s:14:"ext_tables.php";s:4:"b45d";s:39:"Classes/Controller/DomainController.php";s:4:"fc57";s:31:"Classes/Domain/Model/Domain.php";s:4:"95a4";s:46:"Classes/Domain/Repository/DomainRepository.php";s:4:"5e82";s:34:"Classes/Service/PatternService.php";s:4:"0860";s:49:"Classes/ViewHelpers/Be/Buttons/IconViewHelper.php";s:4:"a7e2";s:34:"Configuration/TypoScript/setup.txt";s:4:"7901";s:33:"Migrations/Code/ClassAliasMap.php";s:4:"66dd";s:44:"Resources/Private/Language/locallang_mod.xlf";s:4:"1b6e";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"58bc";s:38:"Resources/Private/Layouts/Default.html";s:4:"7847";s:45:"Resources/Private/Templates/Domain/Index.html";s:4:"1855";s:41:"Tests/Unit/Service/PatternServiceTest.php";s:4:"6902";}',
);

