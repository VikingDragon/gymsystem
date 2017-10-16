$(function(){
      $(document).on('click', '.showModalButton', function(){
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
            document.getElementById('modalHeaderTitle').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });

    $(document).on('hide.bs.modal','#modal', function () {
        $("#modal-footer").html('');
        $("#modal-footer").removeClass("modal-footer");
        $('#modal').find('#modalContent').html("<div style='text-align:center'><img src='../images/load.gif' /></div>");
    });

    $(document).on('hide.bs.modal','#modal2', function () {
        $("#modal-footer2").html('');
        $("#modal-footer2").removeClass("modal-footer");
        $('#modal2').find('#modalContent2').html("<div style='text-align:center'><img src='../images/load.gif' /></div>");
    });

    $("body").on("beforeSubmit", ".form-ajax", function () {
                var form = $(this);
                // return false if form still have some validation errors
                if (form.find(".has-error").length) {
                    return false;
                }
                // submit form
                $.ajax({
                    url    : form.attr("action"),
                    type   : "post",
                    data   : form.serialize(),
                    success: function (response) {
                        $('#modal').modal('hide');
                        //$("#modal").modal("toggle");
                        //$.pjax.reload({container:"#lessons-grid-container-id"}); //for pjax update
                    },
                    error  : function () {
                        console.log("internal server error");
                    }
                });
                return false;
    });
});