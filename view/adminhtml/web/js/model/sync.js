/**
 * sync
 *
 * @copyright Copyright © 2024 Magerserv LTD.. All rights reserved.
 * @author    mageserv.ltd@gmail.com
 */
define([
    'jquery',
    'underscore',
    'mage/translate'
], function ($, _, $t) {
    "use strict";

    return {
        options: {},
        currentResult: {},
        totalSync: 0,

        /**
         * @param classCss
         * @param message
         */
        showMessage: function (classCss, message) {
            var messageElement = this.getElement(".message");

            messageElement.removeClass('message-error message-success message-notice');
            this.getElement(".message-text strong").text(message);
            messageElement.addClass(classCss).show();
        },

        /**
         * @param value
         * @returns {*|n.fn.init|r.fn.init|jQuery.fn.init|jQuery|HTMLElement}
         */
        getElement: function (value) {
            return $(this.options.prefix + ' ' + value);
        },

        /**
         * @param start
         * @param type
         */
        syncData: function (start, type) {
            var end         = start + 100,
                ids         = this.currentResult[type].ids.slice(start, end),
                self        = this,
                percent, percentText;

            $.ajax({
                url: this.options.ajaxUrl,
                type: 'post',
                dataType: 'json',
                data: {
                    type: type,
                    ids: ids
                },
                success: function (result) {
                    var inputLog = self.getElement('#yamm-log-data').val();

                    inputLog += JSON.stringify(result.log) + '|';
                    console.log(result);
                    if (result.success) {
                        percent = ids.length / self.currentResult[type].total * 100;
                        self.currentResult[type].totalSync += result.total;
                        percent = percent.toFixed(2);

                        self.currentResult[type].percent += parseFloat(percent);
                        if (self.currentResult[type].percent > 100) {
                            self.currentResult[type].percent = 100;
                        }
                        self.getElement('#yamm-log-data').val(inputLog);
                        self.getElement('#yamm-console-log').val(inputLog);
                        percentText = self.currentResult[type].percent.toFixed(2) + '%';
                        if (percentText === '100.00%' || self.currentResult[type].totalSync === self.currentResult[type].total) {
                            percentText = '100%';
                            $(self.options.buttonElement).removeClass('disabled');
                        }

                        self.getElement('.progress-bar').css('width', percentText);
                        self.getElement('#sync-percent').text(
                            percentText + ' (' + self.currentResult[type].totalSync + '/' + self.currentResult[type].total + ')'
                        );
                        self.getElement('.progress-bar-' + type).css('width', percentText);
                        console.log('bar', '.progress-bar-' + type);
                        console.log('bar', '#sync-percent-' + type);
                        console.log('bar', self.getElement('#sync-percent-' + type));
                        self.getElement('#sync-percent-' + type).text(
                            percentText + ' (' + self.currentResult[type].totalSync + '/' + self.currentResult[type].total + ')'
                        );

                        if (end < self.currentResult[type].total) {
                            self.syncData(end, type);
                        } else {
                            //self.getElement('.syncing').hide();
                            self.showMessage('message-success', self.options.successMessage[type]);
                        }
                    } else {
                        self.getElement('#yamm-console-log').val(inputLog);
                        self.getElement('#yamm-log-data').val(inputLog);
                        self.showMultiMessages('message message-error', result.message);
                        $(self.options.buttonElement).removeClass('disabled');
                    }
                }
            });
        },

        formatLog: function (log, self) {
            var rs = self.getElement('#yamm-console-log').val();

            rs += log.message + '\n';

            _.each(log.data, function (item, index) {
                if (index === 'success') {
                    rs += ($t('Success: ') + item + '\n')
                }

                if (index === 'error') {
                    rs += ($t('Error: ') + item + '\n')
                }

                if (index === 'error_details') {
                    _.each(item, function (detail) {
                        rs += ($t('Item ID: ' + detail.id + '\n'))
                        rs += ($t('Error: ' + detail.message + '\n\n'))
                    })
                }
            });

            return rs;
        },

        /**
         * @param options
         */
        process: function (options) {
            var self        = this;

            options.buttonElement = '#yamm_refunds_api_configuration_install';
            this.options          = options;
            this.currentResult    = {};

            self.getElement('.progress-content').hide();
            self.getElement('#yamm-console-log').val('');
            self.getElement('#yamm-log-data').val('');

            self.estimateSyncAll();
        },
        estimateSyncAll: function () {
            var self = this;
            self.getElement('.multi-messages').html('');
            $.get({
                url: this.options.estimateUrl,
                dataType: 'json',
                showLoader: true,
                method: 'GET',
                success: function (result) {
                    window.onbeforeunload = (e) => {
                        e.preventDefault();
                        e.returnValue = $t('Changes you made may not be saved.');
                    };

                    if (result.status) {
                        self.currentResult = result.data;
                        self.getElement('.message').hide();
                        self.getElement('.multi-messages').show();
                        self.getElement('.multi-messages .message').show();
                        var syncCount = 0;
                        for(const key in self.currentResult){
                            let item = self.currentResult[key];
                            if (item.total > 0) {
                                self.getElement('#console-log').show();
                            }

                            if (item.total > 0) {
                                self.getElement('#sync-percent-' + key).text('0%');
                                self.getElement('.progress-bar-' + key).removeAttr('style');
                                self.currentResult[key].percent = 0;
                                self.getElement('#progress-content-' + key).show();
                                self.currentResult[key].totalSync = 0;
                                //self.getElement('.syncing').hide();
                                //self.getElement('#syncing-' + key).show();
                                syncCount++;
                                self.syncData(0, key);
                            } else {
                                self.showMultiMessages('message message-notice', result.message);
                                self.getElement('#progress-content-' + key).hide();
                            }
                        }
                        if(syncCount){
                            $(self.options.buttonElement).addClass('disabled');
                        }else{
                            $(self.options.buttonElement).removeClass('disabled');
                        }
                    } else {
                        self.showMultiMessages('message message-error', result.message);
                        $(self.options.buttonElement).removeClass('disabled');
                    }
                }
            });
        },

        showMultiMessages: function (classCss, message) {
            var messageElement = this.getElement('.multi-messages'),
                html           = '<div class="' + classCss + '"><span class="message-text"><strong>'
                    + message + '</strong></span><br></div>';

            messageElement.append(html);
            messageElement.find('.message').show();
        }
    };
});
