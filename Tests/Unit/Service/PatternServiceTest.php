<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Nicole Cordes <cordes@cps-it.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for Tx_HostsPattern_Service_PatternService
 */
class Tx_HostsPattern_Service_PatternServiceTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * @var Tx_HostsPattern_Service_PatternService
	 */
	protected $fixture;

	/**
	 * @return void
	 */
	public function setUp() {
		$this->fixture = new Tx_HostsPattern_Service_PatternService();
	}

	/**
	 * @param array $domainArray
	 * @return array
	 */
	protected function getDomainObjectsFromArray(array $domainArray) {
		$domainStorageArray = array();
		foreach ($domainArray as $domain) {
			$domainObject = new Tx_HostsPattern_Domain_Model_Domain();
			$domainObject->setDomainName($domain);
			$domainStorageArray[] = $domainObject;
		}
		unset($domain);

		return $domainStorageArray;
	}

	/**
	 * @return array
	 */
	public function generatePatternDataProvider() {
		return array(
			'Simple domain' => array(
				array(
					'example.com',
				),
				'example\\.com',
			),
			'Same domain with different subdomains' => array(
				array(
					'www.example.com',
					'wwwt.example.com',
				),
				'(www|wwwt)\\.example\\.com'
			),
			'Same domain without subdomain' => array(
				array(
					'example.com',
					'www.example.com',
				),
				'(www\\.)?example\\.com'
			),
			'Two different domains' => array(
				array(
					'www.example.com',
					'www.domain.com',
				),
				'(www\\.example\\.com|www\\.domain\\.com)',
			),
			'Two equal domains with extra domain' => array(
				array(
					'www.example.com',
					'subdomain.example.com',
					'www.domain.com',
				),
				'((www|subdomain)\\.example\\.com|www\\.domain\\.com)',
			),
			'Three equal domains without subdomain with extra domain' => array(
				array(
					'www.example.com',
					'subdomain.example.com',
					'example.com',
					'www.domain.com',
				),
				'(((www|subdomain)\\.)?example\\.com|www\\.domain\\.com)',
			),
		);
	}

	/**
	 * @test
	 * @dataProvider generatePatternDataProvider
	 */
	public function generatePatternReturnsPatternForGivenDomains($domainArray, $expectedPattern) {
		$this->assertSame($expectedPattern, $this->fixture->generatePattern($this->getDomainObjectsFromArray($domainArray)));
	}

	/**
	 * @test
	 */
	public function generatePatternReturnsHttpHostWithoutDomain() {
		$_SERVER['HTTP_HOST'] = 'www.foo.bar';

		$this->assertSame('www\\.foo\\.bar', $this->fixture->generatePattern(array()));
	}

}
