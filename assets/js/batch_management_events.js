var pig_uid = ""
var currentBatch = 0;
$("#new_batch").on("click", () => {
    $("#add_new_batch").removeClass("hidden")
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

$("#confirm_add_batch").on("click", () => {
    success("New batch has been added successfully")
    $("#add_batch").addClass("hidden")
})
$("#confirm_edit_pigs").on("click", () => {
    success("Batch was modified successfully")
    $("#edit_pig_details").addClass("hidden")
})

$("#cancel_edit_batch").on("click", (event) => {
    event.preventDefault()
    $("#edit_batch_details").addClass("hidden")
})

$(document).ready(() => {

})

function edit_pig_details(pig_id, sow_id, boar_id) {
    pig_uid = pig_id
    $("#edit_sow").val(sow_id)
    $("#edit_boar").val(boar_id)
    $("#edit_batch_details").removeClass("hidden")
}

$("#confirm_remove_pig_detail").on("click", () => {
    success("Batch was removed successfully")
    $("#remove_pig_details").addClass("hidden")
})

$("#cancel_remove_pig_detail").on("click", () => {
    $("#remove_pig_details").addClass("hidden")
})

function remove_pig_details(pig_id) {
    $("#remove_pig_details").removeClass("hidden")
}
$(".batch-data").on("click", (event) => {
    event.preventDefault()
    console.log(event)
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    var data = event.delegateTarget.cells
    console.log(data)
    $("#view_batch_id").html(data[0].outerText)
    $("#view_boar_id").html(data[1].outerText)
    $("#view_sow_id").html(data[2].outerText)
    $("#view_batch_detail").removeClass("hidden")
})
$("#confirm_view_batch").on("click", () => {
    $("#view_batch_detail").addClass("hidden")
})
$("#add_sow").on("input", (event) => {
    if (validateEmpty("add_sow") || sow_still_search) {
        sow_still_search = true;
        $("#add_sow_list").removeClass("hidden")
    }
    if (sow_still_search) {
        $(".sow-data").remove()
        var data = $("#add_sow").val()
        $.ajax({
            type: "post",
            url: "configs/php/load_sow.php",
            data: {
                "keyword": data
            },
            success: function (response) {
                $("#add_sow_list").append(response)
            }
        });
    }
})

$("#add_sow").on("focus", (event) => {
    sow_still_search = true;
})


function load_sow(id) {
    $("#add_sow").val(id)
    sow_still_search = false;
    $("#add_sow_list").addClass("hidden")
}

$("#add_boar").on("input", (event) => {
    if (validateEmpty("add_boar") || boar_still_search) {
        boar_still_search = true;
        $("#add_boar_list").removeClass("hidden")
    }
    if (boar_still_search) {
        $(".boar-data").remove()
        var data = $("#add_boar").val()
        $.ajax({
            type: "post",
            url: "configs/php/load_boar.php",
            data: {
                "keyword": data
            },
            success: function (response) {
                $("#add_boar_list").append(response)
            }
        });
    }
})

$("#add_boar").on("focus", (event) => {
    boar_still_search = true;
})
function load_boar(id) {
    $("#add_boar").val(id)
    boar_still_search = false;
    $("#add_boar_list").addClass("hidden")
}


//edit batch
$("#edit_boar").on("input", (event) => {
    if (validateEmpty("edit_boar") || boar_still_search) {
        boar_still_search = true;
        $("#edit_boar_list").removeClass("hidden")
    }
    if (boar_still_search) {
        $(".boar-data").remove()
        var data = $("#edit_boar").val()
        $.ajax({
            type: "post",
            url: "configs/php/load_boar.php",
            data: {
                "keyword": data
            },
            success: function (response) {
                $("#edit_boar_list").append(response)
            }
        });
    }
})

$("#edit_boar").on("focus", (event) => {
    boar_still_search = true;
})
function load_boar(id) {
    $("#edit_boar").val(id)
    boar_still_search = false;
    $("#edit_boar_list").addClass("hidden")
}

//Edit Sow
$("#edit_sow").on("input", (event) => {
    if (validateEmpty("edit_sow") || sow_still_search) {
        sow_still_search = true;
        $("#edit_sow_list").removeClass("hidden")
    }
    if (sow_still_search) {
        $(".sow-data").remove()
        var data = $("#edit_sow").val()
        $.ajax({
            type: "post",
            url: "configs/php/load_sow.php",
            data: {
                "keyword": data
            },
            success: function (response) {
                $("#edit_sow_list").append(response)
            }
        });
    }
})
$("#edit_sow").on("focus", (event) => {
    sow_still_search = true;
})
function load_sow(id) {
    $("#edit_sow").val(id)
    sow_still_search = false;
    $("#edit_sow_list").addClass("hidden")
}
$("#new_batch_form").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("add_sow")) {
        validityCost("add_sow", "Sow id is required.")
    } else if (validateEmpty("add_boar")) {
        validityCost("add_boar", "Boar id is required.")
    }
    else {
        $.ajax({
            type: "post",
            url: "configs/php/new_batch.php",
            data: {
                "boar": $("#add_boar").val(),
                "sow": $("#add_sow").val(),
            },
            success: function (response) {
                var parsed = JSON.parse(response)
                if (parsed.code == 200) {
                    success(parsed.message);
                    display_batch()
                    $("#add_batch").addClass("hidden")
                } else if (parse.code == 500) {
                    error(parsed.message)
                }
            }
        });
    }
})
$("#cancel_add_batch").on("click", (event) => {
    event.preventDefault()
    $("#add_new_batch").addClass("hidden")
    load_boar("")
    load_sow("")
})


$("#edit_batch_form").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("edit_sow")) {
        validityCost("edit_sow", "This field is required!")
    } else if (validateEmpty("edit_boar")) {
        validityCost("edit_boar", "This field is required!")
    } else {

        var data = $("#edit_batch_form").serializeArray()
        data.push({ name: "batch_id", value: pig_uid })
        console.log(data)
        $.ajax({
            type: "post",
            url: "configs/php/edit_batch.php",
            data: data,
            success: function (response) {
                var parsed = JSON.parse(response)
                if (parsed.code == 200) {
                    success(parsed.message)
                    $("#edit_batch_details").addClass("hidden")
                    display_batch()
                } else if (parsed.code == 500) {
                    error(parsed.message)
                }
            }
        });
    }
})

function display_batch() {
    $(".batch-data").remove();
    $.ajax({
        type: "post",
        url: "config/php/display_batch.php",
        data: {},
        success: function (response) {
            $("table-data").append(response)
        }
    });
}