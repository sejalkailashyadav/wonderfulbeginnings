(function($) {
    "use strict";

    const sidebarRight = document.querySelector('.sidebar-right');
    if (sidebarRight) {
        new PerfectScrollbar(sidebarRight, {
            useBothWheelAxes: true,
            suppressScrollX: true,
        });
    }

})(jQuery);
