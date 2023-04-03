<?php

namespace IchHabRecht\HostsPattern\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Nicole Cordes <cordes@cps-it.de>, CPS-IT GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use IchHabRecht\HostsPattern\Domain\Model\Domain;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Repository;

class DomainRepository extends Repository
{
    public function findAll(): array
    {
        $domains = [];
        $siteFinder = GeneralUtility::makeInstance(SiteFinder::class);
        $sites = $siteFinder->getAllSites(false);
        foreach ($sites as $site) {
            $siteConfiguration = $site->getConfiguration();
            if (array_key_exists('baseVariants', $siteConfiguration)) {
                foreach ($siteConfiguration['baseVariants'] as $baseVariant) {
                    $domain = GeneralUtility::makeInstance(Domain::class);
                    $domain->setDomainName($baseVariant['base']);
                    $domains[] = $domain;
                }
            } else {
                $domain = GeneralUtility::makeInstance(Domain::class);
                $domain->setDomainName($siteConfiguration['base']);
                $domains[] = $domain;
            }
        }

        return $domains;
    }
}
