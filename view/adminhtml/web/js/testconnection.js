/**
 * testconnection.js
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */
define([
    "jquery",
    "Magento_Ui/js/modal/alert",
    "mage/translate",
    "jquery/ui"
], function ($, alert, $t) {
    "use strict";

    $.widget('yamm.testconnection', {
        options: {
            ajaxUrl: '',
            testConnection: '#yamm_refunds_api_configuration_test_connection',
            api_environment: '#yamm_refunds_api_configuration_api_environment',
            apiKey: '#yamm_refunds_api_configuration_api_token',
            installBtn: '#yamm_refunds_api_configuration_install'
        },
        _create: function () {
            var self = this;
            $(this.options.installBtn).attr('disabled', 'disabled');
            $(this.options.installBtn).hide();
            $(this.options.testConnection).click(function (e) {
                e.preventDefault();
                self._ajaxSubmit();
            });
        },

        _ajaxSubmit: function () {
            var self = this;
            $.ajax({
                url: this.options.ajaxUrl,
                data: {
                    apiKey: $(this.options.apiKey).val(),
                    apiEnvironment: $(this.options.api_environment).val()
                },
                dataType: 'json',
                showLoader: true,
                success: function (result) {
                    alert({
                        title: result.status ? $t('Success') : $t('Error'),
                        content: result.content
                    });
                    if(result.status){
                        $(self.options.installBtn).removeAttr('disabled');
                        $(self.options.installBtn).show();
                    }
                }
            });
        }
    });

    return $.yamm.testconnection;
});
