// Shared helpers for every page: JSON AJAX calls and on-page notifications.
var App = (function ($) {
    "use strict";

    // POSTs to a handler and always resolves with {ok, message, ...}.
    function post(url, data) {
        var done = $.Deferred();
        $.ajax({ type: 'POST', url: url, data: data, dataType: 'json' })
            .done(function (response) {
                done.resolve(response || { ok: false, message: 'Something went wrong...' });
            })
            .fail(function (xhr) {
                var response = xhr.responseJSON;
                done.resolve(response && response.message ? response : { ok: false, message: 'Something went wrong...' });
            });
        return done.promise();
    }

    // Shows a message in the top-right corner. type: 'success' | 'error' | 'info'.
    function notify(message, type) {
        var stack = $('#app-toasts');
        if (!stack.length) {
            stack = $('<div id="app-toasts" class="app-toasts" aria-live="polite"></div>').appendTo('body');
        }
        var toast = $('<div class="app-toast" role="status"></div>')
            .addClass('app-toast--' + (type || 'info'))
            .text(message)
            .appendTo(stack);
        setTimeout(function () {
            toast.addClass('app-toast--leaving');
            setTimeout(function () { toast.remove(); }, 300);
        }, 4000);
    }

    // Shows a success message, then moves to another page.
    function notifyThenGo(message, url) {
        notify(message, 'success');
        setTimeout(function () { window.location.href = url; }, 1200);
    }

    // Today's date as YYYY-MM-DD in the browser's own timezone.
    function today() {
        var now = new Date();
        return now.getFullYear() + '-' + pad(now.getMonth() + 1) + '-' + pad(now.getDate());
    }

    // Current time as HH:MM in the browser's own timezone.
    function now() {
        var date = new Date();
        return pad(date.getHours()) + ':' + pad(date.getMinutes());
    }

    function pad(number) {
        return (number < 10 ? '0' : '') + number;
    }

    return { post: post, notify: notify, notifyThenGo: notifyThenGo, today: today, now: now };
})(jQuery);
