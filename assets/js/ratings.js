$(document).ready(function () {
    $("#rateProductForm").submit(function (e) {
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
                    $('#ratingsReviews').html(response.partialView);
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
