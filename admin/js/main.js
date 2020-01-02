;(function ($) {
    $(document).ready(function () {
        //alert("jQuery Loaded");
        $("#task").change(function () {
            if($(this).val()){
                $(this).addClass("is-valid");
            }else {
                $(this).removeClass("is-valid");
            }
        });
        $("#date").change(function () {
            if($(this).val()){
                $(this).addClass("is-valid");
            }else {
                $(this).removeClass("is-valid");
            }
        });
    });
})(jQuery);