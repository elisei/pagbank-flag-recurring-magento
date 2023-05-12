<?php
/**
 * O2TI Flag Recurring Module.
 *
 * Copyright © 2023 O2TI. All rights reserved.
 *
 * @author    Bruno Elisei <brunoelisei@o2ti.com>
 * @license   See LICENSE for license details.
 */

namespace O2TI\FlagRecurringMagento\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Quote\Api\Data\CartInterface;

/**
 * Class Flag Recurring Config Provider - Add Type for Recurring.
 */
class FlagRecurringConfigProvider implements ConfigProviderInterface
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $cart;

    /**
     * Construct.
     *
     * @param ScopeConfigInterface  $scopeConfig
     * @param CartInterface         $cart
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CartInterface  $cart
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->cart = $cart;
    }

    /**
     * Retrieve assoc array of checkout configuration
     *
     * @return array
     */
    public function getConfig()
    {
        $storeId = $this->cart->getStoreId();

        // Adicionar a sua lógica aqui
        // Você pode por exemplo usar os atributos do cart para analisar os produtos e fazer essa verificação.
        // Os valores possíveis são:
        // INITIAL - usado na primeira compra
        // SUBSEQUENT - usado para os demais ciclos
        // ou ainda nulo, caso não seja um pedido recorrente.

        // Aqui nesse exemplo usamos a configuração via config do painel admin para esse processo.
        $typeRecurring = $this->scopeConfig->getValue(
            'pagbank/flag_recurring_magento/type',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        return [
            'pagbank_flag_recurring_magento' => [
                'type' => $typeRecurring,
            ],
        ];
    }
}