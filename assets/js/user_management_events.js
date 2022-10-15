var toupdateid = "";
$("#new_user_form").on("submit", (event) => {
    event.preventDefault()
    var data = $("#new_user_form").serializeArray();
    if (validateEmpty("add_username")) {
        validityCost("add_username", "Username should not be empty.")
    } else if (validateEmpty("add_password")) {
        validityCost("add_password", "Password should not be empty.")
    } else if (validateEmpty("add_first_name")) {
        validityCost("add_first_name", "First name should not be empty.");
    } else if (validateEmpty("add_middle_name")) {
        validityCost("add_middle_name", "Middle name should not be empty.");
    } else if (validateEmpty("add_last_name")) {
        validityCost("add_last_name", "Last name should not be empty.");
    } else if (validateEmpty("add_phone")) {
        validityCost("add_phone", "Phone number should not be empty.");
    } else if (!$("#add_phone").val().includes("+639")) {
        validityCost("add_phone", "Phone formal should begin in +639")
    } else if ($("#add_job").val() == "default") {
        validityCost("add_job", "Select a job description for this user.")
    } else if (validateEmpty("add_email")) {
        validityCost("add_email", "Email should not be empty.")
    } else if (!$("#add_email").val().includes("@")) {
        validityCost("add_email", "Valid email contains \"@\"")
    }
    else {
        $.ajax({
            type: "post",
            url: "/configs/php/new_user.php",
            data: data,
            success: function (response) {
                var responsed = JSON.parse(response)
                if (responsed.code == 200) {

                    success(responsed.message)
                    $("#add_new_user_details").addClass("hidden")
                    display_user();
                } else if (responsed.code == 500) {
                    error(responsed.message)
                } else if (responsed.code == 1062) {
                    validityCost("add_username", responsed.message)
                }
            }
        });
    }
})
function edit_operation_details(id) {


    $.ajax({
        type: "post",
        url: "configs/php/user_data.php",
        data: { "user_id": id },
        success: function (response) {
            var responsed = JSON.parse(response)
            if (responsed.code == 200) {
                toupdateid = id;
                $("#edit_username").val(responsed.username)
                $("#edit_first_name").val(responsed.first_name)
                $("#edit_middle_name").val(responsed.middle_name)
                $("#edit_last_name").val(responsed.last_name)
                $("#edit_phone").val(responsed.phone_number)
                if (responsed.job !== "owner") {
                    $("#edit_job").val(responsed.job)
                } else {
                    $("#edit_job").val(responsed.job)
                    $("#edit_job").attr("disabled", "disabled")

                }
                $("#edit_user_details").removeClass("hidden")
                $("#edit_user_form").scrollTop(0);
            } else if (responsed.code == 500) {
                error(responsed.message)
            }
        }
    });

}
$("#edit_user_form").on("submit", (event) => {
    event.preventDefault()

    if (validateEmpty("edit_username")) {
        validityCost("edit_username", "Username should not be empty.")
    } else if (validateEmpty("edit_first_name")) {
        validityCost("edit_first_name", "First name should not be empty.");
    } else if (validateEmpty("edit_middle_name")) {
        validityCost("edit_middle_name", "Middle name should not be empty.");
    } else if (validateEmpty("edit_last_name")) {
        validityCost("edit_last_name", "Last name should not be empty.");
    } else if (validateEmpty("edit_phone")) {
        validityCost("edit_phone", "Phone number should not be empty.");
    } else if (!$("#edit_phone").val().includes("+639")) {
        validityCost("edit_phone", "Phone formal should begin in +639")
    } else if ($("#edit_job").val() == "default") {
        validityCost("edit_job", "Select a job description for this user.")
    } else {
        $("#edit_job").removeAttr("disabled")
        var data = $("#edit_user_form").serializeArray();
        if (data[1].value == "") {
            //update no password
            data[data.length] = { name: "has_pass", "value": false };
            data[data.length] = { name: "user_id", "value": toupdateid };
            $.ajax({
                type: "post",
                url: "/configs/php/edit_user.php",
                data: data,
                success: function (response) {
                    console.log(response)
                    var responsed = JSON.parse(response)
                    if (responsed.code == 200) {
                        success(responsed.message)
                        $("#edit_user_details").addClass("hidden")
                        display_user()
                    } else if (responsed.code == 500) {
                        error(responsed.message)
                    }
                }
            });
        } else {
            //update with password
            data[data.length] = { name: "has_pass", "value": true };
            data[data.length] = { name: "user_id", "value": toupdateid };
            $.ajax({
                type: "post",
                url: "/configs/php/edit_user.php",
                data: data,
                success: function (response) {

                    var responsed = JSON.parse(response)
                    if (responsed.code == 200) {
                        success(responsed.message)
                        $("#edit_user_details").addClass("hidden")
                        display_user()
                    } else if (responsed.code == 500) {
                        error(responsed.message)
                    }
                }
            });
        }
    }

})
$("#cancel_remove_record_detail").on("click", (event) => {
    $("#remove_user_details").addClass("hidden")
})


$("#cancel_add_user_details").on("click", (event) => {
    event.preventDefault()
    $("#add_user_form").trigger("reset");
    $("#add_new_user_details").addClass("hidden")
})
$("#cancel_edit_user_details").on("click", (event) => {
    event.preventDefault()
    $("#edit_user_form").trigger("reset");
    $("#edit_user_details").addClass("hidden")
    $("#edit_job").removeAttr("disabled")
})

$("#new_user").on("click", () => {
    $("#add_new_user_details").removeClass("hidden")
})
function remove_operation_details(id) {
    toupdateid = id;
    $.ajax({
        type: "post",
        url: "configs/php/user_data.php",
        data: { "user_id": id },
        success: function (response) {

            var responsed = JSON.parse(response)
            if (responsed.code == 200) {
                $("#remove_username").text(responsed.username)
                $("#remove_user_details").removeClass("hidden")
            }
        }
    });
}

$("#confirm_remove_user_detail").on("click", () => {
    $.ajax({
        type: "post",
        url: "configs/php/delete_user.php",
        data: { "user_id": toupdateid },
        success: function (response) {
            console.log(response)
            var responsed = JSON.parse(response)
            if (responsed.code == 200) {
                success(responsed.message)
                $("#remove_user_details").addClass("hidden")
                $("#remove_username").text("")
                display_user()
            } else if (responsed.code == 201) {
                error(responsed.message)
            } else if (responsed.code == 204) {
                error(responsed.message)
            }
        }
    });
})

function display_user() {
    $(".user-data").remove();
    $.ajax({
        type: "post",
        url: "configs/php/display_user.php",
        data: {},
        success: function (response) {
            $("#tbl_user").append(response)
        }
    });
}

$("#user_management_search").on("input", (event) => {
    $(".user-data").remove()
    $.ajax({
        type: "post",
        url: "configs/php/search_user.php",
        data: {
            "search": $("#user_management_search").val()
        },
        success: function (response) {
            $("#tbl_user").append(response)
        }
    });
})

$(".table_row_record_details").on("click", (event) => {
    event.preventDefault()
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    var id = event.currentTarget.attributes.item(0).value;
    $.ajax({
        type: "post",
        url: "configs/php/view_user_data.php",
        data: {
            "id": id
        },
        success: function (response) {
            var data = JSON.parse(response)
            if (data.code == 200) {
                $("#username").text(data.result_set.username)
                $("#first_name").text(data.result_set.first_name)
                $("#middle_name").text(data.result_set.middle_name)
                $("#last_name").text(data.result_set.last_name)
                $("#phone_number").text(data.result_set.phone_number)
                $("#job").text(data.result_set.job)
            }
        }
    });
    $("#view_record_details").removeClass("hidden")
})
$("#close_user_detail").on("click", (event) => {
    $("#view_record_details").addClass("hidden")
})