<?php

namespace IchHabRecht\HostsPattern\Service;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Service to generate regular expression pattern for trustedHostsPattern
 */
class PatternService
{
    /**
     * @param Domain[] $domainArray
     * @return string
     */
    public function generatePattern($domainArray): string
    {
        if (empty($domainArray)) {
            $domain = new Domain();
            $domain->setDomainName(GeneralUtility::getIndpEnv('HTTP_HOST'));
            $domainArray = [$domain];
        }

        $patternArray = [];
        $extractedDomainsArray = $this->extractDomains($domainArray);
        foreach ($extractedDomainsArray as $domainName => $subdomainArray) {
            $patternArray[] = $this->getPatternForDomain($domainName, $subdomainArray);
        }
        unset($domain);

        return count($patternArray) > 1 ? '(' . implode('|', $patternArray) . ')' : $patternArray[0];
    }

    /**
     * @param Domain[] $domainArray
     * @return array
     */
    protected function extractDomains($domainArray): array
    {
        $extractedDomainArray = [];

        foreach ($domainArray as $domain) {
            $reverseHost = array_reverse(explode('.', $domain->getDomainName()));
            $domainName = preg_quote($reverseHost[1] . '.' . $reverseHost[0]);
            unset($reverseHost[0], $reverseHost[1]);
            $subdomain = '';
            if (!empty($reverseHost)) {
                $subdomain = implode('.', array_reverse($reverseHost));
            }
            if (!is_array($extractedDomainArray[$domainName])) {
                $extractedDomainArray[$domainName] = [];
            }
            $extractedDomainArray[$domainName][] = preg_quote($subdomain);
        }
        unset($domain);

        return $extractedDomainArray;
    }

    protected function getPatternForDomain(string $domainName, array $subdomainArray): string
    {
        $hasDomainWithoutSubdomain = false;
        if (in_array('', $subdomainArray)) {
            $hasDomainWithoutSubdomain = true;
            $subdomainArray = array_filter($subdomainArray, 'strlen');
        }
        $hasMultipleSubdomains = count($subdomainArray) > 1;
        $pattern = ($hasMultipleSubdomains ? '(' : '') . implode(
            '|',
            $subdomainArray
        ) . ($hasMultipleSubdomains ? ')' : '');
        if (!empty($subdomainArray)) {
            $pattern .= '\\.';
        }
        if ($hasDomainWithoutSubdomain && !empty($subdomainArray)) {
            $pattern = '(' . $pattern . ')?';
        }
        $pattern .= $domainName;

        return $pattern;
    }
}
