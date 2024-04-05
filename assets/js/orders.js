function updateOrderStatus(orderId, newStatus) {
    $.ajax({
        type: "POST",
        url: "orders/updateStatus",
        data: {
            orderId: orderId,
            newStatus: newStatus
        },
        dataType: 'json', 
        success: function(response) {
            if (response.success) {
                $("#message").html(response.message);
                $("#liveToast").removeClass("hide");
                $(".toast").toast("show");
                console.log(response.message);
            } else {
                $("#message").html(response.message);
                $("#liveToast").removeClass("hide");
                $(".toast").toast("show");
                console.log(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
