window.ss = window.ss || {};

!(function () {
    "use strict";

    jQuery(function(){
        jQuery.noConflict();

        jQuery.entwine('ss', ($) => {
            $(`$buttonID`).entwine({
                Loading: null,
                Dialog: null,
                URL: null,
                onmatch() {                    
                    // Set URL to load dialog content from
                    this.setURL(`$URL`);
                    
                    // Configure Dialog
                    this.setDialog(this.siblings(this.attr('id') + '-dialog'));
                    this.getDialog().data('field', this).dialog({
                        autoOpen: false,
                        width: $(window).width() * (50 / 100),
                        height: $(window).height() * (60 / 100),
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
        });
    });
})();
