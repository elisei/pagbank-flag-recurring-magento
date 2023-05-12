define([
    'mage/utils/wrapper'
], function (wrapper) {
    'use strict';

    var ccMixin = {
        getData: function () {
            var data = wrapper.wrap(this._super, function (originalFunction) {
                var originalData = originalFunction(),
                    typeRecurring = window.checkoutConfig.pagbank_flag_recurring_magento.type;

                originalData['additional_data']['recurring_type'] = typeRecurring;

                return originalData;
            });

            return data.call(this);
        }
    };

    return function (target) {
        return target.extend(ccMixin);
    };
});
