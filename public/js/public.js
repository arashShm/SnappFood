$(document).on('click', '.manage-cart', function () {
    //Reaction to user's action
    var element = $(this);
    var type = element.attr('value');
    var form = element.parents('form');
    var url = form.attr('action');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: url,
        method: "POST",
        data: {
            type: type
        },

        success: function (response) {
            

            var alertBox = form.siblings('.alert');
            if (response.error) {
                alertBox.text(response.error);
                alertBox.show();
            } else {
                alertBox.hide();

                var inCartDiv = form.children('.in-cart');
                var notInCartDiv = form.children('.not-in-cart');

                if (response.count == 0) {
                    inCartDiv.hide();
                    notInCartDiv.show();
                } else {
                    inCartDiv.show();
                    notInCartDiv.hide();
                }
                form.find('.count-item').text(response.count);
                $('#cart > span').text(response.totalCount);
            }
        }
    });
});


