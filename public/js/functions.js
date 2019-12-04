$( document ).ready(function() {
    $(".this_more").click(function (a) {
        $(".suggest_search").fadeOut("fast")
        a.stopPropagation();
        if ($(".iconmenu").hasClass("active")) {
            $(".iconmenu").removeClass("active");
            $(".iconmenu .material-icons").text("more_horiz");
            $(".menu-expand-wrapper").fadeOut("fast")
        } else {
            $(".iconmenu").addClass("active");
            $(".iconmenu .material-icons").text("close");
            $(".menu-expand-wrapper").fadeIn("fast")
        }
    });
    var b;
    $(".this_more").on("mouseenter", function (a) {
        $(".suggest_search").fadeOut("fast")
        b = setTimeout(function () {
            a.stopPropagation();
            $(".iconmenu").addClass("active");
            $(".iconmenu .material-icons").text("close");
            $(".menu-expand-wrapper").fadeIn("fast")
        }, 300)
    }).on("mouseleave", function (a) {
        clearTimeout(b);
        a.stopPropagation();
        $(".iconmenu").removeClass("hidden")
    });
    $(".ghw-bottom-header").hover(function () {
    }, function (a) {
        a.stopPropagation();
        $(".iconmenu").removeClass("active");
        $(".iconmenu .material-icons").text("more_horiz");
        $(".menu-expand-wrapper").fadeOut("fast")
    });

    $('#header .top .form-group .form-control').click(function(a){
		a.stopPropagation();
		$(".suggest").fadeIn("fast")
    });
    $('#music_search').click(function(a){
        a.stopPropagation();
        $(".suggest_search").fadeOut("fast")
        $(".search_layout_upload_music").fadeIn("fast")
    });
    $('#album_search').click(function(a){
        a.stopPropagation();
        $(".suggest_search").fadeOut("fast")
        $(".search_layout_upload_album").fadeIn("fast")
    });
    $('body').click(function(){
        $(".suggest").fadeOut("fast")
        $(".suggest_search").fadeOut("fast")
    });
    $('.fb-share-link').click(function(e) {
        shareFbLink(e, $(this).attr('href'))
    });

});
function shareFbLink(event, href) {
    event.preventDefault();
    href = findOfStringParameter(href, 'href', href).replace("localhost//", "localhost/").replace("com//", "com/").replace("vn//", "vn/");
    FB.ui({
        method: 'share',
        href: href,
        caption: $('meta[name=title]').attr("content"),
    }, function(response){
        if (response && !response.error_message) {
            Cookies.set("share_down_lossless", JSON.stringify({
                timestamp: new Date(),
                content: 'share_down_lossless'
            }));
        }
    });
    return false;
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
//
// $(function() {
//     // Initializes and creates emoji set from sprite sheet
//     window.emojiPicker = new EmojiPicker({
//       emojiable_selector: '[data-emojiable=true]',
//       assetsPath: 'assets/emoji-picker-master/lib/img/',
//       popupButtonClasses: 'fa fa-smile-o'
//     });
//     // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
//     // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
//     // It can be called as many times as necessary; previously converted input fields will not be converted again
//     window.emojiPicker.discover();
// });

// var upvote_position = $('#answer-12878316').position();
// $('body').mousemove(function (event) {
//     $(this).css({
//         position: 'relative',
//         left: (event.pageX - upvote_position.left - 22) + 'px',
//         top: (event.pageY - upvote_position.top - 35) + 'px'
//     });
// });
function alertModal(content = 'Lỗi, không thực hiện được.') {
    if(!content)
        content = 'Lỗi, không thực hiện được'
    $("#myModal .modal-body").html('<i class="material-icons modal_icon_csn">error_outline</i><div class="modal_content_csn">' + content + '</div>');
    $("#myModal").modal();

}
function confirmModal(content = 'Lỗi, không thực hiện được.', title = '', modal_size = 'modal-lg') {
    if(!content)
        content = 'Lỗi, không thực hiện được';
    $("#myConfirmModal .modal-header").addClass('hidden');
    if(title) {
        $("#myConfirmModal .modal-header").removeClass('hidden');
        $("#myConfirmModal .modal-title").html(title);
    }
    $("#myConfirmModal .modal-dialog").removeClass('modal-lg').addClass(modal_size);
    $("#myConfirmModal .modal-body").html('<div class="modal_content_csn">' + content + '</div>');
    $("#myConfirmModal").modal();
    $('#myConfirmModal').on('hidden.bs.modal', function () {
        $('#myConfirmModal').find('.btn-ok').html('Đồng ý');
    });
}

function successModal(content = 'Lỗi, không thực hiện được') {
    if(!content)
        content = 'Lỗi, không thực hiện được.'
    clearTimeout(setTimeOutModal);
    $("#myModal .modal-body").html('<i class="material-icons modal_icon_csn">check_circle_outline</i><div class="modal_content_csn">' + content + '</div>');
    $("#myModal").modal();
}
$(document).keydown(function(e) {
    if (e.keyCode == 27) {
        $("#myModal").fadeOut(200);
        $('.modal').find('.close').click();
    }
});
String.prototype.replaceArray = function(find, replace) {
    var replaceString = this;
    var regex;
    for (var i = 0; i < find.length; i++) {
        regex = new RegExp(find[i], "g");
        replaceString = replaceString.replace(regex, replace);
    }
    return replaceString;
};
// String.prototype.replaceArray = function(str, replace) {
//     var replaceString = this;
//     for (var i = 0; i < find.length; i++) {
//         replaceString = replaceString.replace(find[i], replace[i]);
//     }
//     return replaceString;
// };
function xoa_dau(str) {
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
        str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
        str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
        str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
        str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
        str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
        str = str.replace(/Đ/g, "D");
    return str;
}
function searchHighlight(key, string, boolean = false) {
    if(string) {
        var keyReplace = xoa_dau(key).toLowerCase();
        var stringReplace = xoa_dau(string).toLowerCase();
        n = stringReplace.indexOf(keyReplace);
        var stringPos = string.substring(n, n + key.length);
        if(n === -1) {
            // console.log(key);
            // console.log(string);
            // searchHighlight(key.substring(0, key.length - 1), string);
            return boolean ? false : string;
        }
        return string.replace(stringPos, '<span class="search_highlight">' + stringPos + '</span>');
    }
    return boolean ? false : string;

}
var waitingDialog = waitingDialog || (function ($) {
    'use strict';

    // Creating modal dialog's DOM
    var $dialog = $(
        '<div class="modal fade modal-loading-waiting" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;z-index: 9999999999999">' +
        '<div class="modal-dialog modal-m" style="text-align: center; margin-top: -50px;width: auto!important;; z-index: 9999999999">' +
        '<img src="/images/loader.gif"></div>' +
        '</div>' +
        '</div></div></div>');

    return {
        /**
         * Opens our dialog
         * @param message Custom message
         * @param options Custom options:
         * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
         * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
         */
        show: function (message, options) {
            // Assigning defaults
            if (typeof options === 'undefined') {
                options = {};
            }
            if (typeof message === 'undefined') {
                message = 'Loading';
            }
            var settings = $.extend({
                dialogSize: 'm',
                progressType: '',
                onHide: null // This callback runs after the dialog was hidden
            }, options);

            // Configuring dialog
            $dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
            $dialog.find('.progress-bar').attr('class', 'progress-bar');
            if (settings.progressType) {
                $dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
            }
            $dialog.find('h3').text(message);
            // Adding callbacks
            if (typeof settings.onHide === 'function') {
                $dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
                    settings.onHide.call($dialog);
                });
            }
            // Opening dialog
            $dialog.modal();
        },
        /**
         * Closes dialog
         */
        hide: function () {
            $dialog.modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-loading-waiting').remove();
            $('.modal-backdrop').remove();
        }
    };

})(jQuery);
function convertDateTime(timestamp) {
    date = new Date(timestamp * 1000),
        datevalues = [
            date.getFullYear(),
            date.getMonth()+1,
            date.getDate(),
            date.getHours(),
            date.getMinutes(),
            date.getSeconds(),
        ];
    return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
}
function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
function findGetParameter(parameterName, def = null) {
    var result = def,
        tmp = [];
    location.search
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}
function findOfStringParameter(string, parameterName, def = null) {
    var result = def,
        tmp = [];
    string
        .substr(1)
        .split("&")
        .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
    return result;
}