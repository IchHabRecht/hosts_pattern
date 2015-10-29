<?php
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
 * Controller for backend module
 */
class Tx_HostsPattern_Controller_DomainController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_HostsPattern_Domain_Repository_DomainRepository
	 */
	protected $domainRepository;

	/**
	 * @var Tx_HostsPattern_Service_PatternService
	 */
	protected $patternService;

	/**
	 * @param Tx_HostsPattern_Domain_Repository_DomainRepository $domainRepository
	 * @return void
	 */
	public function injectDomainRepository(Tx_HostsPattern_Domain_Repository_DomainRepository $domainRepository) {
		$this->domainRepository = $domainRepository;
	}

	/**
	 * @param Tx_HostsPattern_Service_PatternService $patternService
	 * @return void
	 */
	public function injectPatternService(Tx_HostsPattern_Service_PatternService $patternService) {
		$this->patternService = $patternService;
	}

	/**
	 * @return void
	 */
	public function indexAction() {
		$domains = $this->domainRepository->findAll();
		if (!count($domains)) {
			$domain = $this->objectManager->get('Tx_HostsPattern_Domain_Model_Domain');
			$domain->setDomainName(t3lib_div::getIndpEnv('HTTP_HOST'));
			$domains = array($domain);
		}
		$pattern = $this->patternService->generatePattern($domains);

		if ($this->request->hasArgument('write')) {
			/** @var \TYPO3\CMS\Core\Configuration\ConfigurationManager $configurationManager */
			$configurationManager = $this->objectManager->get('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager');
			$configurationManager->setLocalConfigurationValueByPath('SYS/trustedHostsPattern', $pattern);
			$this->addFlashMessage(
				htmlspecialchars('$GLOBALS[TYPO3_CONF_VARS][SYS][trustedHostsPattern] = ' . $pattern),
				'Trusted Hosts Pattern was changed'
			);
		}

		$this->view->assignMultiple(array(
			'domains' => $domains,
			'pattern' => $pattern,
		));
	}

}
