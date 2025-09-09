(function($) {
    "use strict";

    const selectors = [
        '.app-sidebar',
        '.header-dropdown-list',
        '.notifications-menu',
        '.message-menu-scroll',
        '.tabs-menu-body'
    ];

    selectors.forEach(selector => {
        const el = document.querySelector(selector);
        if (el) {
            new PerfectScrollbar(el, {
                useBothWheelAxes: true,
                suppressScrollX: true,
                suppressScrollY: false,
            });
        }
    });

})(jQuery);
