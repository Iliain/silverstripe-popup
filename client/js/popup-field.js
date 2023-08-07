window.ss = window.ss || {};

!(function () {
    "use strict";

    jQuery(function(){
        jQuery.noConflict();

        jQuery.entwine('ss', ($) => {
            $('.popup-field-button').each(function () {
                const field = $('#' + $(this).attr('id'));
                field.entwine({
                    Loading: null,
                    Dialog: null,
                    URL: null,
                    onmatch() {
                        const self = this;
                        const selector = '#' + self.attr('id');

                        // Set URL to load dialog content from
                        $URLCode
                        
                        // Configure Dialog
                        this.setDialog(self.siblings(selector + '-dialog'));
                        this.getDialog().data('field', this).dialog({
                            autoOpen: false,
                            width: $(window).width() * (50 / 100),
                            height: $(window).height() * (50 / 100),
                            modal: true,
                            position: { my: 'center', at: 'center', of: window }
                        });
                        
                        // Do custom code
                        $customCode
                    },
                    onclick() {
                        this.showDialog();
                        return false;
                    },
                    showDialog() {
                        const dlg = this.getDialog();
                        dlg.empty().dialog('open').parent().addClass('loading');
                        dlg.load(this.getURL(), () => {
                            dlg.parent().removeClass('loading');
                        });
                    }
                });
            })
        });
    });
})();
