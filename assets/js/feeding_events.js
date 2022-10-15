$("#close_record_detail").on("click", (event) => {
    event.preventDefault()
    $("#view_feeding_details").addClass("hidden")
})
$(".table_row_record_details").on("click", (event) => {
    event.preventDefault()
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    $("#view_feeding_details").removeClass("hidden")
})
$("#cancel_add_record_detail").on("click", () => {
    $("#add_record_details").addClass("hidden")
})
$("#new_feeding_detail").on("click", () => {
    $("#add_feeding_details").removeClass("hidden")
})
function edit_operation_details(id) {
    $("#edit_feeding_details").removeClass("hidden")
}
$("#confirm_add_feeding_details").on("click", (event) => {
    success("New operation details has been stored.")
    $("#add_feeding_details").addClass("hidden")
})
$("#cancel_add_feeding_details").on("click", (event) => {
    $("#add_feeding_details").addClass("hidden")
})
//edit form
$("#cancel_edit_feeding_details").on("click", () => {
    $("#edit_feeding_details").addClass("hidden")
})
$("#confirm_edit_feeding_details").on("click", () => {
    success("Record was modified successfully.")
    $("#edit_feeding_details").addClass("hidden")
})

$("#record_management_search").on("click", (event) => {
    event.preventDefault()

})