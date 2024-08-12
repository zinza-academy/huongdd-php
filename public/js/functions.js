function sure() {
    return confirm('Are you sure to delete this record?');
}

function deleteMany(target, targetUrl) {
    $(`#select_all_${target}`).click(function() {
        $('.checkbox_ids').prop('checked', $(this).prop('checked'));
    });

    $(`#delete_selected_${target}`).click(function (event) {
        event.preventDefault();
        let all_ids = [];
        $('.checkbox_ids:checked').each(function () {
            all_ids.push($(this).val());
        });
        const confirmed = confirm('Are you sure to delete these records?');

        if (all_ids.length > 0 && confirmed) {
            $.ajax({
            type : 'DELETE',
            url : targetUrl,
            data : {
                ids: all_ids,
            },
            success: function(respone) {
                $.each(all_ids, function(key, value) {
                    $('.checkbox-' + value).remove();
                });
            },
        });
        }
    });
}
