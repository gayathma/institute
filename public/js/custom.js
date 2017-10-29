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