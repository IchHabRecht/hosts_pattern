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
 * Class Tx_HostsPattern_ViewHelpers_Be_Buttons_IconViewHelper to render sprite icons
 */
class Tx_HostsPattern_ViewHelpers_Be_Buttons_IconViewHelper extends Tx_Fluid_ViewHelpers_Be_Buttons_IconViewHelper {

	/**
	 * Renders an sprite icon
	 *
	 * @param string $uri
	 * @param string $icon
	 * @param string $title
	 * @return string
	 */
	public function render($uri = '', $icon = 'closedok', $title = '') {
		$icon = t3lib_iconWorks::getSpriteIcon($icon, array('title' => $title));
		if (empty($uri)) {
			return $icon;
		} else {
			return '<a href="' . $uri . '">' . $icon . '</a>';
		}
	}
}
