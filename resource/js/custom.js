// JavaScript Document

$(document).on('click', '[data-toggle="ajaxModal"]', function(e) {
    $('#ajaxModal').remove();
    e.preventDefault();
    var $this = $(this),
        $remote = $this.data('remote') || $this.attr('href'),
        $modal = $('<div class="modal" id="ajaxModal"><div class="modal-body"></div></div>');
    $('body').append($modal);
    $('.loading').show();
    $modal.modal();
    $modal.load($remote,function(e){
        $('.loading').hide();
    });
});


$(document).ready(function(e) {
	 $(".table-click").click(function(){
				$("body").toggleClass("addcls")
		});
});

/////////////// For Number Value Convert in Money type////////////////////

Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};


$("#activejob").click(function() {
    $('html, body').animate({
        scrollTop: $("#activejobs").offset().top
    }, 2000);
});

$("#upcomingjob").click(function() {
    $('html, body').animate({
        scrollTop: $("#upcomingjobs").offset().top
    }, 2000);
});

$('.tiem-slot').on('hidden.bs.modal', function () {
    location.reload(true);
});
