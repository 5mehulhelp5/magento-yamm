define([
    'jquery',
    'Magento_Ui/js/grid/columns/actions',
    'Magento_Ui/js/modal/modal'
], function ($, Column) {
    'use strict';

    return Column.extend({
        modal: {},

        /**
         * @inheritDoc
         */
        defaultCallback: function (actionIndex, recordId, action) {
            if (actionIndex !== 'view') {
                return this._super();
            }

            if (typeof this.modal[action.rowIndex] === 'undefined') {
                var row = this.rows[action.rowIndex],
                    modalHtml = '<iframe srcdoc="' + row['error_message'] + '" style="width: 100%; height: 100%"></iframe>';
                this.modal[action.rowIndex] = $('<div/>')
                    .html(modalHtml)
                    .modal({
                        type: 'slide',
                        title: row['entity_type'] + " " + row['entity_id'],
                        modalClass: 'mpsmtp-modal-email',
                        innerScroll: true,
                        buttons: []
                    });
            }

            this.modal[action.rowIndex].trigger('openModal');
        }
    });
});
