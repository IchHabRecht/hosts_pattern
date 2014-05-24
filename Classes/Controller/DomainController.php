<?php
namespace CPSIT\HostsPattern\Controller;

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
class DomainController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \CPSIT\HostsPattern\Domain\Repository\DomainRepository
	 * @inject
	 */
	protected $domainRepository;

	/**
	 * @var \CPSIT\HostsPattern\Service\PatternService
	 * @inject
	 */
	protected $patternService;

	/**
	 * @return void
	 */
	public function indexAction() {
		$domains = $this->domainRepository->findAll();
		if (!count($domains)) {
			$domain = $this->objectManager->get('CPSIT\\HostsPattern\\Domain\\Model\\Domain');
			$domain->setDomainName(\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_HOST'));
			$domains = array($domain);
		}
		$pattern = $this->patternService->generatePattern($domains);

		if ($this->request->hasArgument('write')) {
			$configurationPathValuePairs = array(
				'SYS' => array(
					'trustedHostsPattern' => $pattern,
				),
			);
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
