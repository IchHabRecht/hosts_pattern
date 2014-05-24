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
	 * @test
	 */
	public function generatePatternReturnsPatternForSimpleDomain() {
		$domain = new Tx_HostsPattern_Domain_Model_Domain();
		$domain->setDomainName('example.com');

		$this->assertSame('example\\.com', $this->fixture->generatePattern(array($domain)));
	}

	/**
	 * @test
	 */
	public function generatePatternReturnsPatternForSameDomainsWithDifferentSubdomains() {
		$domain1 = new Tx_HostsPattern_Domain_Model_Domain();
		$domain1->setDomainName('www.example.com');
		$domain2 = new Tx_HostsPattern_Domain_Model_Domain();
		$domain2->setDomainName('wwwt.example.com');
		$domainArray = array(
			$domain1,
			$domain2,
		);

		$this->assertSame('(www|wwwt)\\.example\\.com', $this->fixture->generatePattern($domainArray));
	}

	/**
	 * @test
	 */
	public function generatePatternReturnsPatternForSameDomainsIncludingEmptySubdomain() {
		$domain1 = new Tx_HostsPattern_Domain_Model_Domain();
		$domain1->setDomainName('example.com');
		$domain2 = new Tx_HostsPattern_Domain_Model_Domain();
		$domain2->setDomainName('www.example.com');
		$domainArray = array(
			$domain1,
			$domain2,
		);

		$this->assertSame('(www\\.)?example\\.com', $this->fixture->generatePattern($domainArray));
	}

	/**
	 * @test
	 */
	public function generatePatternReturnsPatternForDifferentDomains() {
		$domain1 = new Tx_HostsPattern_Domain_Model_Domain();
		$domain1->setDomainName('www.example.com');
		$domain2 = new Tx_HostsPattern_Domain_Model_Domain();
		$domain2->setDomainName('www.domain.com');
		$domainArray = array(
			$domain1,
			$domain2,
		);

		$this->assertSame('(www\\.example\\.com|www\\.domain\\.com)', $this->fixture->generatePattern($domainArray));
	}

}
