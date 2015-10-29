<?php
namespace IchHabRecht\HostsPattern\Controller;

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

use IchHabRecht\HostsPattern\Domain\Repository\DomainRepository;
use IchHabRecht\HostsPattern\Service\PatternService;
use TYPO3\CMS\Backend\View\BackendTemplateView;
use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Controller for backend module
 */
class DomainController extends ActionController
{

    /**
     * @var DomainRepository;
     */
    protected $domainRepository;

    /**
     * @var PatternService
     */
    protected $patternService;

    /**
     * View object name
     *
     * @var string
     */
    protected $defaultViewObjectName = BackendTemplateView::class;

    /**
     * @param DomainRepository $domainRepository
     */
    public function injectDomainRepository(DomainRepository $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    /**
     * @param PatternService $patternService
     * @return void
     */
    public function injectPatternService(PatternService $patternService)
    {
        $this->patternService = $patternService;
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $domains = $this->domainRepository->findAll();
        if (!count($domains)) {
            $domain = $this->objectManager->get(Domain::class);
            $domain->setDomainName(GeneralUtility::getIndpEnv('HTTP_HOST'));
            $domains = array($domain);
        }
        $pattern = $this->patternService->generatePattern($domains);

        if ($this->request->hasArgument('write')) {
            /** @var ConfigurationManager $configurationManager */
            $configurationManager = $this->objectManager->get(ConfigurationManager::class);
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
