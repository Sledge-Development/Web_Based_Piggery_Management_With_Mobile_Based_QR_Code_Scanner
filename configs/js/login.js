$("#login").on("submit", (event) => {
    event.preventDefault();
    var data = $("#login").serializeArray();
    $.ajax({
        type: "get",
        url: "configs/php/login.php",
        data: data,
        success: function (response) {
            var responsed = JSON.parse(response);
            if (responsed["code"] == 200) {
                success(responsed["message"])
                setTimeout(() => {
                    open("/dashboard.php", "_self")
                }, 2000)
            } else if (responsed["code"] == 404) {
                error(responsed["message"])
            }
        }
    });
})


$(document).ready(() => {
    if (window.location.search.includes("error")) {
        var data = window.location.search.split("error=");
        if (data[1] == 401) {
            error("Unauthorized access ! Login")
        } if (data[1] == 409) {
            error("This system was already done setting up.Login using your account.")
        }
    }
})