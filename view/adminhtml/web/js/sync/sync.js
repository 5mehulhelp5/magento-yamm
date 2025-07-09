/**
 * sync
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */
define([
    'jquery',
    'Mageserv_Yamm/js/model/sync'
], function ($, Sync) {
    'use strict';

    $.widget('yamm.sync', {
        options: {
            ajaxUrl: '',
            estimateUrl: '',
            prefix: '#yamm-synchronize',
            buttonElement: '#yamm_refunds_api_configuration_install'
        },
        _create: function () {
            var self = this;

            $(this.options.buttonElement).click(function (e) {
                e.preventDefault();
                Sync.process(self.options);
            });
        },
    });

    return $.yamm.sync;
});
