$("#close_record_detail").on("click", (event) => {
    event.preventDefault()
    $("#view_medicine_administration_details").addClass("hidden")
})
$(".table_row_record_details").on("click", (event) => {
    event.preventDefault()
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    $("#view_medicine_administration_details").removeClass("hidden")
})
$("#cancel_add_record_detail").on("click", () => {
    $("#add_record_details").addClass("hidden")
})
$("#new_medicine_administration_detail").on("click", () => {
    $("#add_medicine_administration_details").removeClass("hidden")
})
function edit_operation_details(id) {
    $("#edit_medicine_administration_details").removeClass("hidden")
}
$("#confirm_add_medicine_administration_details").on("click", (event) => {
    success("New operation details has been stored.")
    $("#add_medicine_administration_details").addClass("hidden")
})
$("#cancel_add_medicine_administration_details").on("click", (event) => {
    $("#add_medicine_administration_details").addClass("hidden")
})
//edit form
$("#cancel_edit_medicine_administration_details").on("click", () => {
    $("#edit_medicine_administration_details").addClass("hidden")
})
$("#confirm_edit_medicine_administration_details").on("click", () => {
    success("Record was modified successfully.")
    $("#edit_medicine_administration_details").addClass("hidden")
})

$("#record_management_search").on("click", (event) => {
    event.preventDefault()

})