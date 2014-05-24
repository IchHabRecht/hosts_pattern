<?php
namespace CPSIT\HostsPattern\Service;

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

/**
 * Service to generate regular expression pattern for trustedHostsPattern
 */
class PatternService {

	/**
	 * @param \CPSIT\HostsPattern\Domain\Model\Domain[] $domainArray
	 * @return string
	 */
	public function generatePattern($domainArray) {
		if (empty($domainArray)) {
			$domain = new \CPSIT\HostsPattern\Domain\Model\Domain();
			$domain->setDomainName(\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_HOST'));
			$domainArray = array($domain);
		}

		$patternArray = array();
		$extractedDomainsArray = $this->extractDomains($domainArray);
		foreach ($extractedDomainsArray as $domainName => $subdomainArray) {
			$patternArray[] = $this->getPatternForDomain($domainName, $subdomainArray);
		}
		unset($domain);

		return count($patternArray) > 1 ? '(' . implode('|', $patternArray) . ')' : $patternArray[0];
	}

	/**
	 * @param \CPSIT\HostsPattern\Domain\Model\Domain[] $domainArray
	 * @return array
	 */
	protected function extractDomains($domainArray) {
		$extractedDomainArray = array();

		/** @var \CPSIT\HostsPattern\Domain\Model\Domain $domain */
		foreach ($domainArray as $domain) {
			$reverseHost = array_reverse(explode('.', $domain->getDomainName()));
			$domainName = preg_quote($reverseHost[1] . '.' . $reverseHost[0]);
			unset($reverseHost[0], $reverseHost[1]);
			$subdomain = '';
			if (!empty($reverseHost)) {
				$subdomain = implode('.', $reverseHost);
			}
			if (!is_array($extractedDomainArray[$domainName])) {
				$extractedDomainArray[$domainName] = array();
			}
			$extractedDomainArray[$domainName][] = preg_quote($subdomain);
		}
		unset($domain);

		return $extractedDomainArray;
	}

	/**
	 * @param string $domainName
	 * @param array $subdomainArray
	 * @return string
	 */
	protected function getPatternForDomain($domainName, $subdomainArray) {
		$hasDomainWithoutSubdomain = FALSE;
		if (in_array('', $subdomainArray)) {
			$hasDomainWithoutSubdomain = TRUE;
			$subdomainArray = array_filter($subdomainArray, 'strlen');
		}
		$hasMultipleSubdomains = count($subdomainArray) > 1 ? : FALSE;
		$pattern = ($hasMultipleSubdomains ? '(' : '') . implode('|', $subdomainArray) . ($hasMultipleSubdomains ? ')' : '');
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
