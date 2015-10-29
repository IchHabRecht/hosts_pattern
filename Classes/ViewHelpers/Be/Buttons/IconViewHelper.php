<?php
namespace IchHabRecht\HostsPattern\ViewHelpers\Be\Buttons;

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

use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Type\Icon\IconState;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

/**
 * Class Tx_HostsPattern_ViewHelpers_Be_Buttons_IconViewHelper to render sprite icons
 */
class IconViewHelper extends AbstractViewHelper implements CompilableInterface {

	/**
	 * Renders an sprite icon
	 *
	 * @param string $uri
	 * @param string $identifier
	 * @param string $title
	 * @param string $size
	 * @param string $overlay
	 * @param string $state
	 * @return string
	 */
	public function render($uri = '', $identifier = 'closedok', $title = '', $size = Icon::SIZE_SMALL, $overlay = null, $state = IconState::STATE_DEFAULT) {
		return static::renderStatic(
			array(
				'uri' => $uri,
				'identifier' => $identifier,
				'title' => $title,
				'size' => $size,
				'overlay' => $overlay,
				'state' => $state,
			),
			$this->buildRenderChildrenClosure(),
			$this->renderingContext
		);
	}

	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param RenderingContextInterface $renderingContext
	 * @return string
	 */
	static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$identifier = $arguments['identifier'];
		$size = $arguments['size'];
		$overlay = $arguments['overlay'];
		$state = IconState::cast($arguments['state']);

		/** @var IconFactory $iconFactory */
		$iconFactory = GeneralUtility::makeInstance(IconFactory::class);
		$icon = $iconFactory->getIcon($identifier, $size, $overlay, $state)->render();

		$title = $arguments['title'];
		if (!empty($title)) {
			$icon = '<span title="' . htmlspecialchars($title) . '">' . $icon . '</span>';
		}

		$uri = $arguments['uri'];
		if (empty($uri)) {
			return $icon;
		} else {
			return '<a href="' . htmlspecialchars($uri) . '">' . $icon . '</a>';
		}
	}
}
