(function ($) {
    $.zAutocomplte = function (options) {
        console.log('hello');
        var defaults = {
            'keyword' : '#keywords',
            'results' : '.results',
            'mID'     : '#mID',
            'text'    : 'Enter keyword here...',
            'minChar' : 2,
            'records' : 5,
            'linkType': false
        };
        var options = $.extend(defaults, options);
        var txtKeyword = $(options.keyword);
        var results = $(options.results);
        var txtMID = $(options.mID);

        // Gọi các hàm chạy mặc định trong Plugin 
        addValue();

        txtKeyword.on('focus click', function(e){
            if ($(this).val() === options.text) {
                $(this).val('').css({'color': '', 'font-style': ''});
            }
        });

        txtKeyword.on('blur', function(e){
            addValue();
            // results.delay(200).slideUp(300);
        });

        txtKeyword.on('keyup', function(e){
            if ($(this).val().length >= options.minChar) {
                $.ajax({
                    url: 'files/getdata.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        'keywords': $(this).val(),
                        'limit': options.records
                    }
                }).done(function(data){
                    setResultPosition();
                    var list = listItem(data);
                    results.html(list);

                    var selector = options.results + ' ul li';
                    $(selector).on('mouseenter mouseleave', function(e){
                        $(this).toggleClass('bg02');
                    });

                    if (!options.linkType) {
                        $(selector).on('click', function(e){
                            txtKeyword.val($(this).text());
                            txtMID.val($(this).attr('item-id'));
                            results.slideUp(300);
                        })
                    }

                });
            }
        })

        function listItem(data) {
            var str = '';
            str = '<ul>';
            if (data.length > 0) {
                $.each(data, function(i, val){
                    var pTitle = val.name;
                    var pId    = val.id;
                    var pLink  = 'product.php?id=' + pId;
                    if (options.linkType) {
                        str += '<li title="' + pTitle + '">' 
                                + '<a href="'+ pLink +'">' + pTitle + '</a>'
                                + '</li>';
                    } else {
                        str += '<li item-id="'+ pId +'" title="' + pTitle + '">' + pTitle + '</li>';
                    }
                });
            } else {
                str += '<li>No records</li>';
            }

            str += '</ul>';
            return str;
        }

        function setResultPosition() {
            results.css({
                'left'    : txtKeyword.offset().left, 
                'top'     : txtKeyword.offset().top + txtKeyword.outerHeight(),
                'width'   : txtKeyword.innerWidth(),
                'position': 'absolute',
                'display' : 'block'
            });
        }

        function addValue() {
            if (!txtKeyword.val()) {
                txtKeyword.val(options.text).css({'color': '#999', 'font-style': 'italic'});
            }
        }
    }
})(jQuery);

$(document).ready(function(e) {
    var obj = {
        'linkType': false
    };
    $.zAutocomplte(obj);
})