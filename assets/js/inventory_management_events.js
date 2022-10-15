var item_uid = "";
$("#add_item").on("click", (event) => {
    $("#add_item_details").removeClass("hidden")
    $("#add_item_form").scrollTop(0);
})

$("#deduct_item").on("click", (event) => {

})
$("#add_item_form").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("add_item_tag")) {
        validityCost("add_item_tag", "Item tag is empty.")
    } else if (validateEmpty("add_item_name")) {
        validityCost("add_item_name", "Item name is empty.")
    } else if (validateEmpty("add_item_description")) {
        validityCost("add_item_description", "Item description is empty.")
    } else if (validateEmpty("add_item_netweight")) {
        validityCost("add_item_netweight", "Item net weight is empty.")
    } else if ($("#add_item_unit").val() == "default") {
        validityCost("add_item_unit", "Please select item unit.")
    } else if (validateEmpty("add_item_quantity")) {
        validityCost("add_item_quantity", "Item quantity is empty.")
    } else {
        var data = $("#add_item_form").serializeArray();
        $.ajax({
            type: "post",
            url: "configs/php/add_item.php",
            data: data,
            success: function (response) {
                var parsed = JSON.parse(response)
                if (parsed.code == 200) {
                    success(parsed.message)
                    $("#add_item_form").trigger("reset")
                    $("#add_item_details").addClass("hidden")
                    display_item()
                } else if (parsed.code == 500) {
                    error(parsed.message)
                }
            }
        });
    }
})

$("#cancel_add_item").on("click", (event) => {
    event.preventDefault()
    $("#add_item_form").trigger("reset")
    $("#add_item_details").addClass("hidden")
})

function edit_item_detail(id) {
    $("#edit_item_details").removeClass("hidden")

    $.ajax({
        type: "post",
        url: "configs/php/edit_item.php",
        data: {
            "id": id
        },
        success: function (response) {
            var parsed = JSON.parse(response)
            if (parsed.code == 200) {
                $("#edit_item_tag").val(parsed.message.item_tag)
                $("#edit_item_name").val(parsed.message.item_name)
                $("#edit_item_description").val(parsed.message.item_description)
                $("#edit_item_quantity").val(parsed.message.item_quantity)
                $("#edit_item_netweight").val(parsed.message.item_net_weight)
                $("#edit_item_unit").val(parsed.message.item_unit)
                $("#edit_item_unit").attr("disabled", "disabled")
                $("#edit_item_netweight").attr("disabled", "disabled")
                $("#edit_item_quantity").attr("disabled", "disabled")
                $("#edit_item_tag").attr("disabled", "disabled")
            }
        }
    });
}


$("#edit_item_form").on("submit", (event) => {
    event.preventDefault()
    $("#edit_item_tag").removeAttr("disabled")
    var data = $("#edit_item_form").serializeArray()
    $("#edit_item_tag").attr("disabled", "disabled")
    $.ajax({
        type: "post",
        url: "configs/php/update_item.php",
        data: data,
        success: function (response) {
            var parsed = JSON.parse(response)
            if (parsed.code == 200) {
                success(parsed.message)
                display_item()
                $("#edit_item_details").addClass("hidden")
                $("#edit_item_form").trigger("reset")
            } else {
                error(parsed.message)
            }
        }
    });
})

$("#item-data").on("click", (event) => {
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }if(event.target.outerText().includes("No data can be loaded .")){
        return 0;
    }
    var id = event.target.parentNode.attributes[0].nodeValue
    $.ajax({
        type: "get",
        url: "configs/php/view_item.php",
        data: {
            "id": id
        },
        success: function (response) {
            var parsed = JSON.parse(response)
            console.log(parsed.message)
            if (parsed.code == 200) {
                $("#view_item_tag").text(parsed.message.item_tag)
                $("#view_item_name").text(parsed.message.item_name)
                $("#view_item_description").text(parsed.message.item_description)
                $("#view_item_quantity").text(parsed.message.item_quantity)
                $("#view_item_net_weight").text(parsed.message.item_net_weight + " " + parsed.message.item_unit)
            }

        }
    });
    $("#view_item_details").removeClass("hidden")
    $("#view_item_form").scrollTop(0)
})
$("#close_item_details").on("click", (event) => {
    $("#view_item_details").addClass("hidden")
})
$("#cancel_edit_item").on("click", (event) => {
    event.preventDefault()
    $("#edit_item_details").addClass("hidden")
})
function remove_item_detail(id) {
    $("#remove_item_details").removeClass("hidden")
    item_uid = id;
    $("#remove_item_tag").html("<b>" + id + "</b>")
}
$("#close_remove_item_details").on("click", () => {
    $("#remove_item_details").addClass("hidden")
})
$("#confirm_remove_item_details").on("click", () => {
    $.ajax({
        type: "post",
        url: "configs/php/delete_item.php",
        data: {
            "item_tag": item_uid
        },
        success: function (response) {
            var parsed = JSON.parse(response)
            if (parsed.code == 200) {
                success(parsed.message)
                display_item()
                $("#remove_item_details").addClass("hidden")
            } else if (parsed.code == 500) {
                error(parsed.messages)
            }
        }
    });
})

function display_item() {
    $(".table_row_record_details").remove()
    $.ajax({
        type: "post",
        url: "configs/php/display_item.php",
        data: {},
        success: function (response) {
            $("#item-data").append(response)
        }
    });
}