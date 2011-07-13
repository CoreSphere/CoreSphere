(function(window) {
    "use strict";

    var $             = window.jQuery,
        event_handler = function(event) {
            var $this = $(this)

            if (!confirm($this.data('confirm'))) {
                event.preventDefault();
                event.stopPropagation();
            }

        };

    $(window.document.body)

        .delegate('[data-confirm]', 'click.coresphere', event_handler);

}(window));