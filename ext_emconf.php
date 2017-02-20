<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "hosts_pattern".
 *
 * Auto generated 22-12-2016 08:43
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
  'author_email' => 'typo3@cordes.co',
  'author_company' => 'CPS-IT GmbH',
  'state' => 'stable',
  'uploadfolder' => 0,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '2.1.2',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '7.5.0-8.6.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  '_md5_values_when_last_written' => 'a:17:{s:9:"ChangeLog";s:4:"00ed";s:13:"composer.json";s:4:"9932";s:12:"ext_icon.png";s:4:"dc44";s:14:"ext_tables.php";s:4:"5766";s:39:"Classes/Controller/DomainController.php";s:4:"4694";s:31:"Classes/Domain/Model/Domain.php";s:4:"95a4";s:46:"Classes/Domain/Repository/DomainRepository.php";s:4:"5e82";s:34:"Classes/Service/PatternService.php";s:4:"0860";s:49:"Classes/ViewHelpers/Be/Buttons/IconViewHelper.php";s:4:"1862";s:34:"Configuration/TypoScript/setup.txt";s:4:"7901";s:33:"Migrations/Code/ClassAliasMap.php";s:4:"66dd";s:44:"Resources/Private/Language/locallang_mod.xlf";s:4:"1b6e";s:44:"Resources/Private/Language/locallang_mod.xml";s:4:"58bc";s:38:"Resources/Private/Layouts/Default.html";s:4:"7847";s:45:"Resources/Private/Templates/Domain/Index.html";s:4:"1855";s:46:"Resources/Public/Icons/module-hostspattern.svg";s:4:"7c7d";s:41:"Tests/Unit/Service/PatternServiceTest.php";s:4:"6902";}',
);

