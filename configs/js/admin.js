$("#admin-new").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("username")) {
        validityCost("username", "Username should not be empty.")
    } else if (validateEmpty("password")) {
        validityCost("password", "Password should not be empty.")
    } else if (validateEmpty("first_name")) {
        validityCost("first_name", "First name should not be empty.");
    } else if (validateEmpty("middle_name")) {
        validityCost("middle_name", "Middle name should not be empty.");
    } else if (validateEmpty("last_name")) {
        validityCost("last_name", "Last name should not be empty.");
    } else if (validateEmpty("phone")) {
        validityCost("phone", "Phone number should not be empty.");
    } else if (!$("#phone").val().includes("+639")) {
        validityCost("phone", "Phone formal should begin in +639")
    } else {
        var form = $("#admin-new").serializeArray()
        $.ajax({
            type: "post",
            url: "/configs/php/admin.php",
            data: form,
            success: function (response) {
                var data = JSON.parse(response)
                if (data.code == 200) {
                    success(data.message)
                    setTimeout(() => {
                        open("index.php", "_self")
                    }, 2000)
                } else if (data.code == 500) {
                    error(data.message)
                } else if (data.code == 1062) {
                    validityCost("username", data.message)
                }
            }
        });
    }
})