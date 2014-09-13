var countdown;
var Pademobile = new Class.create();
Pademobile.prototype = {
    initialize: function() {
        this.startCountdown();
        Event.observe('pademobile', 'submit', this.stopCountdown.bind(this));//click en el boton "Submit"
    },

    stopCountdown: function(event) {
        clearInterval(countdown);
    },

    startCountdown: function() {
        countdown = setInterval(this.updateSeconds, 1000);
    },

    updateSeconds: function() {
        var $actual = parseInt($('redirect_seconds').innerHTML);
        $('redirect_seconds').update($actual-1);

        if ($actual == 1) {
            clearInterval(countdown);
            $('pademobile').submit();
        }
    }
}