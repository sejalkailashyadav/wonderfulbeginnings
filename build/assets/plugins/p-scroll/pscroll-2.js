(function($) {
    "use strict";

    const content = document.querySelector('.content');
    if (content) {
        new PerfectScrollbar(content, {
            useBothWheelAxes: true,
            suppressScrollX: true,
        });
    }

    const content1 = document.querySelector('.content-1');
    if (content1) {
        new PerfectScrollbar(content1, {
            useBothWheelAxes: true,
            suppressScrollX: true,
        });
    }

})(jQuery);
