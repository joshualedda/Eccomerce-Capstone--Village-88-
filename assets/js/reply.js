$(document).ready(function () {
    $("#createReplyForm").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $("#message").html(response.message);
                    $("#liveToast").removeClass("hide");
                    $(".toast").toast("show");
                    console.log(response.message);
                    $('#repliesData').html(response.partialView);
					$("#createReplyForm")[0].reset();

                } else {
                    $("#message").html(response.message);
                    $("#liveToast").removeClass("hide");
                    $(".toast").toast("show");
                    console.log(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error adding. Please Try Again.");
            },
        });
    });
});