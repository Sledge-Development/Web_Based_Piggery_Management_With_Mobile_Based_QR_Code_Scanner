$("#close_record_detail").on("click",(event)=>{
    event.preventDefault()
    $("#view_record_details").addClass("hidden")
})
$(".table_row_record_details").on("click",(event)=>{
    event.preventDefault()
    $("#view_record_details").removeClass("hidden")
})
$("#new_operation").on("click",()=>{

})
$("#operationdate").on("click",()=>{
    $("#operation_date").showPicker();
})