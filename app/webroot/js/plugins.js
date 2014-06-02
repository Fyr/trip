// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function noop() {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

/*** [3.0] IE PLACEHOLDRE FALLBACK ***/
var _debug = false;var _placeholderSupport = function() {var t = document.createElement("input");t.type = "text";return (typeof t.placeholder !== "undefined");}();window.onload = function() {var arrInputs = document.getElementsByTagName("input");for (var i = 0; i < arrInputs.length; i++) {var curInput = arrInputs[i];if (!curInput.type || curInput.type == "" || curInput.type == "text")HandlePlaceholder(curInput);}};function HandlePlaceholder(oTextbox) {if (!_placeholderSupport) {var curPlaceholder = oTextbox.getAttribute("placeholder");if (curPlaceholder && curPlaceholder.length > 0) {Debug("Placeholder found for input box '" + oTextbox.name + "': " + curPlaceholder);oTextbox.value = curPlaceholder;oTextbox.setAttribute("old_color", oTextbox.style.color);oTextbox.style.color = "#c0c0c0";oTextbox.onfocus = function() {Debug("input box '" + this.name + "' focus");this.style.color = this.getAttribute("old_color");if (this.value === curPlaceholder)this.value = "";};oTextbox.onblur = function() {Debug("input box '" + this.name + "' blur");if (this.value === "") {this.style.color = "#c0c0c0";this.value = curPlaceholder;}};}else {Debug("input box '" + oTextbox.name + "' does not have placeholder attribute");}}else {Debug("browser has native support for placeholder");}}function Debug(msg) {if (typeof _debug !== "undefined" && _debug) {var oConsole = document.getElementById("Console");if (!oConsole) {oConsole = document.createElement("div");oConsole.id = "Console";document.body.appendChild(oConsole);}oConsole.innerHTML += msg + "<br />";}}