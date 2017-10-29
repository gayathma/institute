function message(type, xhr) {

    if (type == 'success') {
        $.jGrowl(xhr, {
            sticky: !1,
            position: "top-right",
            theme: "bg-azure"
        });
    } else {



        var str = xhr.responseText;
        var str_array = str.split(',');

        for (var i = 0; i < str_array.length; i++) {
            // Trim the excess whitespace.
            str_array[i] = str_array[i].replace(/^\s*/, "").replace(/\s*$/, "").replace(/"/g, "").replace(/[{}]/g, "").replace(/[\[\]']+/g, "");
            // Add additional code here, such as:
            $.jGrowl(str_array[i], {
                sticky: !1,
                position: "top-right",
                theme: "bg-red"
            });
        }


    }
}

$(document).on('click', '.table-add-row', function(e) {

    e.preventDefault();

    var row = $(this).parents('.custom-table').find('.table-cloner');
    var newRow = row.clone().removeClass('table-cloner').addClass('table-row');
    row.before(newRow.show()).find('[name]').each(function() {
        var name = $(this).attr('name');
        $(this).prop('name', name.replace('[' + row.data('table-i') + ']', '[' + (parseInt(row.data('table-i')) + 1) + ']'));
    });

    newRow.removeData('table-i');
    newRow.find('.ignore-validate').removeClass('ignore-validate');

    row.data('table-i', parseInt(row.data('table-i')) + 1);


});

$(document).on('click', '.table-del-row', function(e) {
    e.preventDefault();
    var link = $(this);
    if (confirm('Remove row?')) {
        link.parents('.table-row').remove();

    }
});