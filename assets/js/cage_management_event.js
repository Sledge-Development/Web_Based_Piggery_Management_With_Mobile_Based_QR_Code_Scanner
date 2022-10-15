var pig_uid = ""
$("#new_cage").on("click", () => {
    $("#add_cage").removeClass("hidden")
})

function generate_pig_id() {
    var pig_start = "pig_";
    var data = "abcdefghijklmnopqrstuvwxyz1234567890".split("");
    for (let i = 0; i < 6; i++) {
        let num = Math.floor(Math.random() * data.length)
        pig_start = pig_start + data[num]
    }
    return pig_start
}

$("#add_cage_form").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("cage_name")) {
        validityCost("cage_name", "Cage name should not be empty.")
    } else {
        var data = $("#add_cage_form").serializeArray();
        $.ajax({
            type: "post",
            url: "configs/php/new_cage.php",
            data: data,
            success: function (response) {
                var data = JSON.parse(response)
                if (data.code == 200) {
                    success(data.message)
                    $("#add_cage").addClass("hidden")
                    display_cage();
                } else if (data.code == 500) {
                    error(data.message)
                }
            }
        });
    }
})

$("#cancel_add_batch").on("click", (event) => {
    event.preventDefault()
    $("#add_cage").addClass("hidden")
})


$("#cancel_edit_pigs").on("click", (event) => {
    event.preventDefault()
    $("#edit_cage_details").addClass("hidden")

})

$(document).ready(() => {

})

$("#edit_cage_form").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("edit_cage_name")) {
        validityCost("edit_cage_name", "This input box should not be empty.")
    } else {
        $("#edit_cage_id").removeAttr("disabled")
        var data = $("#edit_cage_form").serializeArray()
        $("#edit_cage_id").attr("disabled", "disabled")
        $.ajax({
            type: "post",
            url: "configs/php/edit_cage.php",
            data: data,
            success: function (response) {
                console.log(response)
                var parsed = JSON.parse(response)
                if (parsed.code == 200) {
                    success(parsed.message)
                    display_cage()
                    $("#edit_cage_details").addClass("hidden")
                    $("#edit_cage_form").trigger("reset")
                } else if (parsed.code == 500) {
                    error(parsed.message)
                }
            }
        });
    }
})
function edit_pig_details(cage_id, cage_name) {
    $("#edit_cage_details").removeClass("hidden")
    $("#edit_cage_id").val(cage_id)
    $("#edit_cage_name").val(cage_name)
}

$("#confirm_remove_pig_detail").on("click", () => {
    success("Cage was removed successfully")
    $("#remove_pig_details").addClass("hidden")
})

$(".cage-data").on("click", (event) => {
    event.preventDefault()
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    var data = event.delegateTarget.cells
    console.log(data)
    $("#view_cage_id").text(data[0].textContent)
    $("#view_cage_name").text(data[1].textContent)
    $("#view_cage_total").text(data[2].textContent)
    $("#view_cage_detail").removeClass("hidden")
})

function display_cage() {
    $(".cage-data").remove()
    $.ajax({
        type: "post",
        url: "configs/php/display_cage.php",
        data: {},
        success: function (response) {
            $("#cage-data-table").append(response)
        }
    });
}


$("#confirm_view_cage").on("click", (event) => {
    event.preventDefault()
    $("#view_cage_detail").addClass("hidden")
})