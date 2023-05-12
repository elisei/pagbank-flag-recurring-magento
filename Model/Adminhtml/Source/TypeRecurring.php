<?php
/**
 * O2TI Flag Recurring Module.
 *
 * Copyright © 2023 O2TI. All rights reserved.
 *
 * @author    Bruno Elisei <brunoelisei@o2ti.com>
 * @license   See LICENSE for license details.
 */

namespace O2TI\FlagRecurringMagento\Model\Adminhtml\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Type Recurring - Defines the types of recurring flag.
 */
class TypeRecurring implements ArrayInterface
{
    /**
     * Returns Options.
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            null            => __('Not Recurring'),
            'INITIAL'       => __('Inittial'),
            'SUBSEQUENT'    => __('Subsequent'),
        ];
    }
}
