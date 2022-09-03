$("#close_record_detail").on("click", (event) => {
    event.preventDefault()
    $("#view_record_details").addClass("hidden")
})
$(".table_row_record_details").on("click", (event) => {
    event.preventDefault()
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    $("#view_record_details").removeClass("hidden")
})
$("#cancel_add_record_detail").on("click", () => {
    $("#add_record_details").addClass("hidden")
})
$("#new_operation").on("click", () => {
    $("#add_record_details").removeClass("hidden")
})

function edit_operation_details(id) {
    $("#edit_record_details").removeClass("hidden")
}
$("#cancel_edit_record_detail").on("click", () => {
    $("#edit_record_details").addClass("hidden")
})
function remove_operation_details(id) {
    $("#remove_record_details").removeClass("hidden")
}
$("#cancel_remove_record_detail").on("click", () => {
    $("#remove_record_details").addClass("hidden")
})
$("#confirm_add_record_details").on("click", (event) => {
    success("New operation details has been stored.")
    $("#add_record_details").addClass("hidden")

})