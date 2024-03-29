/**
 * @author    Supercool Ltd <naveed@supercooldesign.co.uk>
 * @copyright Copyright (c) 2018, Supercool Ltd
 * @see       http://supercooldesign.co.uk
 */

(function($) {

  if (typeof Functions == 'undefined')
  {
    Functions = {}
  }

    /**
     * Clear Caches
     */
    Functions.ClearCachesUtility = Garnish.Base.extend(
    {
        $trigger: null,
        $form: null,

        init: function(formId) {
            this.$form = $('#' + formId);
            this.$trigger = $('input.submit', this.$form);
            this.$status = $('.utility-status', this.$form);

            this.addListener(this.$form, 'submit', 'onSubmit');
        },

        onSubmit: function(ev) {
            ev.preventDefault();

            if (!this.$trigger.hasClass('disabled')) {
                if (!this.progressBar) {
                    this.progressBar = new Craft.ProgressBar(this.$status);
                }
                else {
                    this.progressBar.resetProgressBar();
                }

                this.progressBar.$progressBar.removeClass('hidden');

                this.progressBar.$progressBar.velocity('stop').velocity(
                    {
                        opacity: 1
                    },
                    {
                        complete: $.proxy(function() {
                            var postData = Garnish.getPostData(this.$form),
                                params = Craft.expandPostArray(postData);

                            var data = {
                                caches: params.caches
                            };

                            Craft.postActionRequest(params.action, data, $.proxy(function(response, textStatus) {
                                    if (response && response.error) {
                                        alert(response.error);
                                    }

                                    this.updateProgressBar();

                                    setTimeout($.proxy(this, 'onComplete'), 300);

                                }, this),
                                {
                                    complete: $.noop
                                });

                        }, this)
                    });

                if (this.$allDone) {
                    this.$allDone.css('opacity', 0);
                }

                this.$trigger.addClass('disabled');
                this.$trigger.trigger('blur');
            }
        },

        updateProgressBar: function() {
            var width = 100;
            this.progressBar.setProgressPercentage(width);
        },

        onComplete: function() {
            if (!this.$allDone) {
                this.$allDone = $('<div class="alldone" data-icon="done" />').appendTo(this.$status);
                this.$allDone.css('opacity', 0);
            }

            this.progressBar.$progressBar.velocity({opacity: 0}, {
                duration: 'fast', complete: $.proxy(function() {
                    this.$allDone.velocity({opacity: 1}, {duration: 'fast'});
                    this.$trigger.removeClass('disabled');
                    this.$trigger.trigger('focus');
                }, this)
            });
        }
    });


    /**
     * Clear Queues
     */
    Functions.ClearQueuesUtility = Garnish.Base.extend(
    {
        $trigger: null,
        $form: null,

        init: function(formId) {
            this.$form = $('#' + formId);
            this.$trigger = $('input.submit', this.$form);
            this.$status = $('.utility-status', this.$form);

            this.addListener(this.$form, 'submit', 'onSubmit');
        },

        onSubmit: function(ev) {
            ev.preventDefault();

            if (!this.$trigger.hasClass('disabled')) {
                if (!this.progressBar) {
                    this.progressBar = new Craft.ProgressBar(this.$status);
                }
                else {
                    this.progressBar.resetProgressBar();
                }

                this.progressBar.$progressBar.removeClass('hidden');

                this.progressBar.$progressBar.velocity('stop').velocity(
                    {
                        opacity: 1
                    },
                    {
                        complete: $.proxy(function() {
                            var postData = Garnish.getPostData(this.$form),
                                params = Craft.expandPostArray(postData);

                            var data = {
                                caches: params.caches
                            };

                            Craft.postActionRequest(params.action, data, $.proxy(function(response, textStatus) {
                                    if (response && response.error) {
                                        alert(response.error);
                                    }

                                    this.updateProgressBar();

                                    setTimeout($.proxy(this, 'onComplete'), 300);

                                }, this),
                                {
                                    complete: $.noop
                                });

                        }, this)
                    });

                if (this.$allDone) {
                    this.$allDone.css('opacity', 0);
                }

                this.$trigger.addClass('disabled');
                this.$trigger.trigger('blur');
            }
        },

        updateProgressBar: function() {
            var width = 100;
            this.progressBar.setProgressPercentage(width);
        },

        onComplete: function() {
            if (!this.$allDone) {
                this.$allDone = $('<div class="alldone" data-icon="done" />').appendTo(this.$status);
                this.$allDone.css('opacity', 0);
            }

            this.progressBar.$progressBar.velocity({opacity: 0}, {
                duration: 'fast', complete: $.proxy(function() {
                    this.$allDone.velocity({opacity: 1}, {duration: 'fast'});
                    this.$trigger.removeClass('disabled');
                    this.$trigger.trigger('focus');
                }, this)
            });
        }
    });


    /**
     * Opens a modal with the Zendesk widget in it
     */
    Functions.Zendesk = Garnish.Base.extend(
    {

        modal: null,
        handle: null,

        init: function()
        {
            this.addListener($('#nav-functions-zendesk a'), 'click', 'showModal');

            window.zEmbed||(function(){
              var queue = [];

              window.zEmbed = function() {
                queue.push(arguments);
              }
              window.zE = window.zE || window.zEmbed;
              document.zEQueue = queue;
            }());

            zE(function() {
                zE.hide();
            });
        },

        showModal: function(ev)
        {
            ev.preventDefault();

            zE.activate({hideOnClose: true});
        }
    });

})(jQuery);
