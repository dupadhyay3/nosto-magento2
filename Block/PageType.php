<?php
/**
 * Copyright (c) 2017, Nosto Solutions Ltd
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @author Nosto Solutions Ltd <contact@nosto.com>
 * @copyright 2017 Nosto Solutions Ltd
 * @license http://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 *
 */

namespace Nosto\Tagging\Block;

use Magento\Framework\View\Element\Template;
use Nosto\Tagging\Helper\Account as NostoHelperAccount;

/**
 * Page type block used for outputting page-type on the different pages.
 */
class PageType extends Template
{
    private $nostoHelperAccount;
    /**
     * Default type assigned to the page if none is set in the layout xml.
     */
    const DEFAULT_TYPE = 'unknown';

    /**
     * Constructor.
     *
     * @param Template\Context $context
     * @param NostoHelperAccount $nostoHelperAccount
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        NostoHelperAccount $nostoHelperAccount,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->nostoHelperAccount = $nostoHelperAccount;
    }

    /**
     * Return the page-type of the current page. If none is defined in the layout xml,
     * then set a default one.
     *
     * @return string
     */
    public function getPageTypeName()
    {
        return $this->getData('page_type') ? $this->getData('page_type') : self::DEFAULT_TYPE;
    }

    /**
     * Overridden method that only outputs any markup if the extension is enabled and an account
     * exists for the current store view.
     *
     * @return string the markup or an empty string (if an account doesn't exist)
     */
    protected function _toHtml()
    {
        if ($this->nostoHelperAccount->nostoInstalledAndEnabled($this->_storeManager->getStore())) {
            return parent::_toHtml();
        } else {
            return '';
        }
    }
}
