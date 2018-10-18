;( function( $, window, document, undefined ) {

    "use strict";

        // Create the defaults once
        var pluginName = "PasswordStrengthManager",
            defaults = {
              password: "",
              confirm_pass : "",
              blackList : [],
              minChars : "",
              maxChars : ""
            };

        // The actual plugin constructor
        function Plugin ( element, options ) {
            this.element = element;
            this.settings = $.extend( {}, defaults, options );
            this._defaults = defaults;
            this._name = pluginName;
            this.init();
            this.info = "";
        }

        // Avoid Plugin.prototype conflicts
        $.extend( Plugin.prototype, {
            init: function() {
                var errors = this.customValidators();
                
                if ("" == this.settings.password) {
                    this.info = "";
                } else if (this.settings.confirm_pass && (this.settings.password != this.settings.confirm_pass)) {
                    this.msg = "비밀번호가 서로 일치하지 않습니다.";
                } else if (errors == 0) {
                    this.msg = "";
                    var strength = zxcvbn(this.settings.password, this.settings.blackList);
                    this.info = 'security_'+strength.score;
                }
                $(this.element).attr('class', this.info);
                $(this.element).find('.security_text').html(this.msg);
            },
            
            minChars: function() {
                if (this.settings.password.length < this.settings.minChars) {
                    this.msg = "비밀번호는 최소 " + this.settings.minChars + "자 이상 입력하셔야 합니다.";
                    return false;
                } else {
                    return true;
                }
            },
            
            maxChars: function() {
                if (this.settings.password.length > this.settings.maxChars) {
                    this.msg = "비밀번호는 최대 " + this.settings.maxChars + "자까지 사용하실 수 있습니다.";
                    return false;
                } else {
                    return true;
                }
            },
            
            customValidators: function() {
                var err = 0;
                
                if (this.settings.minChars != "") {
                    if (!this.minChars()) {
                        err++;
                    }
                }
                if (this.settings.maxChars != "") {
                    if (!this.maxChars()) {
                        err++;
                    }
                }
                return err;
            }
        } );
        
        $.fn[pluginName] = function (options) {
            this.each(function() {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            });
            return this;
        };

} )( jQuery, window, document );
