var data = { "pig_id": [] }
var containerArray = []
var edit_data = { "pig_id": [] }
var edit_containerArray = []
$("#new_schedule").on("click", () => {
    $("#add_schedule_details").removeClass("hidden")
})
$("#confirm_add_schedule").on("click", () => {
    success("New schedule has been added.")
    $("#add_schedule_details").addClass("hidden")
})
$("#cancel_add_schedule").on("click", () => {
    $("#add_schedule_details").addClass("hidden")
})
$("#add_button_list").on("click", () => {
    let currentListNum = data.pig_id.length
    data.pig_id[currentListNum] = $("#pig_id").val()
    view_pig_list(data)
})

function view_pig_list(data) {
    $(".piglist").remove()
    for (let i = 0; i < data.pig_id.length; i++) {
        $("#legends").append('<div  class="piglist flex mt-2 mb-2 flex-row"><li class="w-5/6">' + data.pig_id[i] + '</li><img onclick="remove_list(' + i + ');" class="w-6 h-6" src="/assets/svg/delete.png" alt=""></div>')
    }
}
function remove_list(id) {
    delete data.pig_id[id]
    for (let i = 0; i < data.pig_id.length; i++) {
        if (data.pig_id[i] != undefined) {
            containerArray.push(data.pig_id[i])
        } else {
            console.log(data.pig_id[i + "Undifined"])
        }
    }
    data = { "pig_id": [] }
    for (let c = 0; c < containerArray.length; c++) {
        data.pig_id[c] = containerArray[c];
    }
    containerArray = []
    view_pig_list(data)
}
function edit_schedule_details(schedule_id) {
    $("#edit_schedule_details").removeClass("hidden")
}
//Edit code
$("#add_update_button_list").on("click", () => {
    let currentListNum = edit_data.pig_id.length
    edit_data.pig_id[currentListNum] = $("#pig_id_edit").val()
    edit_view_pig_list(edit_data)
})

function edit_view_pig_list(data) {
    $(".piglist").remove()
    for (let i = 0; i < edit_data.pig_id.length; i++) {
        $("#legend_edit").append('<div  class="piglist flex mt-2 mb-2 flex-row"><li class="w-5/6">' + edit_data.pig_id[i] + '</li><img onclick="edit_remove_list(' + i + ');" class="w-6 h-6" src="/assets/svg/delete.png" alt=""></div>')
    }
}
function edit_remove_list(id) {
    delete edit_data.pig_id[id]
    for (let i = 0; i < edit_data.pig_id.length; i++) {
        if (edit_data.pig_id[i] != undefined) {
            edit_containerArray.push(data.pig_id[i])
        }
    }
    edit_data = { "pig_id": [] }
    for (let c = 0; c < edit_containerArray.length; c++) {
        edit_data.pig_id[c] = edit_containerArray[c];
    }
    edit_containerArray = []
    edit_view_pig_list(data)
}
function edit_schedule_details(schedule_id) {
    $("#edit_schedule_details").removeClass("hidden")
}
$("#confirm_edit_schedule").on("click", () => {
    success("Successfully modified details.")
    $("#edit_schedule_details").addClass("hidden")
})
$("#cancel_edit_schedule").on("click", () => {
    $("#edit_schedule_details").addClass("hidden")
})
$("#confirm_view_schedule").on("click", () => {
    $("#view_schedule_detail").addClass("hidden")
})
$(".table_row_record_details").on("click", (event) => {
    event.preventDefault()
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    $("#view_schedule_detail").removeClass("hidden")
})

function remove_schedule_details(schedule_id) {
    $("#remove_schedule_details").removeClass("hidden")
}
$("#confirm_remove_schedule_detail").on("click", () => {
    success("Schedule has been removed successfully.")
    $("#remove_schedule_details").addClass("hidden")
})
$("#cancel_remove_schedule_detail").on("click", () => {
    $("#remove_schedule_details").addClass("hidden")
})