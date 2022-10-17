var pig_uid = ""
var sow_still_search = true;
var boar_still_search = true;
var currentBatch = 0;
// show new pig details form add set their data
$("#new_pig_details").on("click", () => {
    if ($("#qrcode")[0].children[0] !== undefined) {
        $("#qrcode").empty();
    }
    $("#add_pig_details").removeClass("hidden")
    pig_uid = generate_pig_id();
    $("#new_pig_id").val(pig_uid)
    $("#pig_birthdate").val(new Date().getDate() + "/" + (parseInt(new Date().getMonth()) + 1) + "/" + new Date().getFullYear())
    //generate qr code to pig id
    new QRCode(document.getElementById("qrcode"), pig_uid);
    getBreed().then((data) => {
        $(".breed-data").remove()
        $(".cage-data").remove()
        $("#new_pig_breed").append(data)
        getCage().then((data) => {
            $("#add_cage").append(data)
            getBatch().then((data) => {
                $("#add_pig_batch").append(data)
                $("#add_sow").val(parsed.sow_id)
                $("#add_boar").val(parsed.boar_id)
            })
        })
    })
})
//to generate pig id  and return a pig id
function generate_pig_id() {
    var pig_start = "pig_";
    var data = "abcdefghijklmnopqrstuvwxyz1234567890".split("");
    for (let i = 0; i < 6; i++) {
        let num = Math.floor(Math.random() * data.length)
        pig_start = pig_start + data[num]
    }
    return pig_start
}
//hide add pig details
$("#cancel_add_pigs").on("click", (event) => {
    event.preventDefault()
    $("#add_pig_details").addClass("hidden")
})
//hide edit pig details form
$("#cancel_edit_pigs").on("click", (event) => {
    event.preventDefault()
    $("#edit_pig_details").addClass("hidden")
})


//Event to download qr code as png to be printed
$("#download_qr").on("click", () => {
    var link = document.createElement('a');
    link.download = pig_uid + '.png';
    link.href = $("#qrcode")[0].children[0].toDataURL()
    link.click();
})
//confirming to remove pig details
$("#confirm_remove_pig_detail").on("click", () => {
    $.ajax({
        type: "post",
        url: "configs/php/delete_pig.php",
        data: { "pig_id": pig_uid },
        success: function (response) {
            var parsed = JSON.parse(response)
            if (parsed.code == 200) {
                success(parsed.message)
                $("#remove_pig_details").addClass("hidden")
                display_pig();
            } else if (parsed.code == 500) {
                error(parsed.message)
            }
        }
    });
})
//Hide remove pig details
$("#cancel_remove_pig_detail").on("click", () => {
    $("#remove_pig_details").addClass("hidden")
})
//function to show remove pig details form
function remove_pig_details(pig_id) {
    $("#remove_pig_details").removeClass("hidden")
    pig_uid = pig_id;
    $("#display_pig_id").text(pig_uid)
}
//Event to navigate in batch management
$("#batch_management").on("click", () => {
    open("/batch_management.php", "_self")
})
//Event to navigate in cage management
$("#cage_management").on("click", () => {
    open("/cage_management.php", "_self")
})
//event when selecting data in table row
$("#pig-data").on("click", (event) => {
    if (event.target.id.includes("edit") || event.target.id.includes("delete")) {
        return 0;
    }
    if (event.target.outerText.includes("No data can be loaded at the moment.")) {
        return 0;
    }
    var id = event.target.parentNode.attributes[0].nodeValue
    $.ajax({
        type: "get",
        url: "configs/php/view_pig.php",
        data: {
            "pig_id": id
        },
        success: function (response) {
            var parsed = JSON.parse(response)
            console.log(parsed.message)
            if (parsed.code == 200) {
                $("#view_pig_id").text(parsed.message.pig_id)
                $("#view_pig_tag").text(parsed.message.pig_tag)
                $("#view_pig_weight").text(parsed.message.weight)
                $("#view_pig_breed").text(parsed.message.breed_name)
                $("#view_pig_birthdate").text(parsed.message.birthdate)
                $("#view_pig_batch").text(parsed.message.batch_id)
                $("#view_cage_name").text(parsed.message.cage_name)
                $("#view_sow_id").text(parsed.message.sow_id)
                $("#view_boar_id").text(parsed.message.boar_id)
                $("#view_gender").text(parsed.message.gender)
            }

        }
    });
    $("#view_pig_details").removeClass("hidden")
    $("#view_form").scrollTop(0)
})



//confirm view of pigs and hide view pig_details 
$("#confirm_view_pig_details").on("click", () => {
    $("#view_pig_details").addClass("hidden")
})
//Get breed list in table breed and add it in select input
function getBreed() {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: "configs/php/load_breed.php",
            data: {},
            success: function (data) {
                resolve(data)
            },
            error: function (error) {
                reject(error)
            }
        });
    })
}
//Increment batch number to one
$("#new_batch_btn").on("click", (event) => {
    $("#add_pig_batch").val(parseInt($("#add_pig_batch").val()) + 1)
})
//get batch add it in input
function getBatch() {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: "configs/php/load_batch_id.php",
            data: {},
            success: function (response) {
                resolve(response)
            }
        });
    })
}
//get cage list and add it in option 
function getCage() {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "post",
            url: "configs/php/load_cage.php",
            data: {},
            success: function (response) {
                resolve(response)
            }
        });
    })
}
//Search sow id base on keyword in table pigs and list it in table sow
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
//set sow_still_search to true when input box is in focus
$("#add_sow").on("focus", (event) => {
    sow_still_search = true;
})
//Load sow id in input box and hide table list of boar
function load_sow(id) {
    $("#add_sow").val(id)
    sow_still_search = false;
    $("#add_sow_list").addClass("hidden")
}
//Add boar input retrieve boar id in table pig and list it in boar list 
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
                "keyword": data,
                "action": "add"
            },
            success: function (response) {
                $("#add_boar_list").append(response)
            }
        });
    }
})
//Set boar_still_search when add boar input is focused
$("#add_boar").on("focus", (event) => {
    boar_still_search = true;
})
//when boar input box in add form is out of focus it would reset table list of boar and set boar_still_search to true means user is still searhing
$("#add_boar").on("focusout", (event) => {
    if (validateEmpty("add_boar") && boar_still_search) {
        boar_still_search = true;
        $("#add_boar_list").addClass("hidden")
        $(".boar-data").remove()
    }
})
//when add_sow input is out of focus it would reset sow list table and set sow_still_search to false
$("#add_sow").on("focusout", (event) => {
    if (validateEmpty("add_sow") && boar_still_search) {
        sow_still_search = true;
        $("#add_sow_list").addClass("hidden")
        $(".sow-data").remove()
    }
})
//Edit form details reload
//Get sow data from pig table based on doing search keyword
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
//When edit sow input box is focused it would set sow_still_search to true which means user is still searching
$("#edit_sow").on("focus", (event) => {
    sow_still_search = true;
})
//Function event trigger when clicked table row in sow list . 
//It will accept id of sow and change the value of edit_sow input box then setting sow_stil_search and hidding edit_sow_list table
function edit_load_sow(id) {
    $("#edit_sow").val(id)
    sow_still_search = false;
    $("#edit_sow_list").addClass("hidden")
}
//Focus out event when the focus of input box is out . It will set everything to hidden if the input box is empty and sow_still_search is true
$("#edit_sow").on("focusout", (event) => {
    if (validateEmpty("edit_sow") && sow_still_search) {
        sow_still_search = true;
        $("#edit_sow_list").addClass("hidden")
        $(".sow-data").remove()
    }
})
//Innput event when user type in input box it would retrieve data from pig table with the use of keyword
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
                "keyword": data,
                "action": "edit"
            },
            success: function (response) {
                $("#edit_boar_list").append(response)
            }
        });
    }
})
//focus event set boar_still_search to true means user is still searching
$("#edit_boar").on("focus", (event) => {
    boar_still_search = true;
})
$("#edit_boar").on("focusout", (event) => {
    if (validateEmpty("edit_boar") && boar_still_search) {
        boar_still_search = true;
        $("#edit_boar_list").addClass("hidden")
        $(".boar-data").remove()
    }
})
//Load boar data in input box
function load_boar(id, action) {
    if (action == "edit") {
        $("#edit_boar").val(id)
        boar_still_search = false;
        $("#edit_boar_list").addClass("hidden")
    } else if (action == "add") {
        $("#add_boar").val(id)
        boar_still_search = false;
        $("#add_boar_list").addClass("hidden")
    }
}
$("#edit_pig_form").on("submit", (event) => {
    event.preventDefault()
    $("#edit_pig_id").removeAttr("disabled")
    var data = $("#edit_pig_form").serializeArray()
    $.ajax({
        type: "post",
        url: "configs/php/update_pig.php",
        data: data,
        success: function (response) {
            console.log(response)
            var parsed = JSON.parse(response)
            if (parsed.code == 200) {
                success(parsed.message)
                $("#edit_pig_details").trigger("reset")
                $("#edit_pig_details").addClass("hidden")
                $("#edit_pig_id").attr("disabled", "disabled")
                $("#edit_pig_details").addClass("hidden")
            } else if (parsed.code == 500) {
                error(parsed.message)
            }
        }
    });
})

//show edit pig details form
function edit_pig_details(pig_id) {
    $("#edit_pig_details").removeClass("hidden")
    getBreed().then((data) => {
        $(".breed-data").remove()
        $(".cage-data").remove()
        $("#edit_pig_breed").append(data)
        getCage().then((data) => {
            $("#edit_cage").append(data)
            getBatch().then((data) => {
                $("#edit_pig_batch").append(data)
                $.ajax({
                    type: "post",
                    url: "configs/php/edit_pig.php",
                    data: { "pig_id": pig_id },
                    success: function (response) {
                        var parsed = JSON.parse(response)
                        console.log(parsed)
                        if ($("#edit_qrcode")[0].children[0] !== undefined) {
                            $("#edit_qrcode").empty();
                        }
                        //generate qr code to pig id
                        new QRCode(document.getElementById("edit_qrcode"), pig_id);
                        $("#edit_birthdate").val(parsed.message.birthdate)
                        $("#edit_pig_id").val(parsed.message.pig_id)
                        $("#edit_pig_breed").val(parsed.message.breed_id)
                        $("#edit_pig_tag").val(parseInt(parsed.message.pig_tag))
                        $("#edit_weight").val(parsed.message.weight)
                        $("#edit_cage").val(parsed.message.cage_id)
                        $("#edit_sow").attr("disabled", "disabled")
                        $("#edit_boar").attr("disabled", "disabled")
                        $("#edit_gender").val(parsed.message.gender)
                        $("#edit_pig_batch").val(parsed.message.batch_id)
                    }
                });
            })
        })
    })
}
//Add pig inforamation
$("#add_pig_form").on("submit", (event) => {
    event.preventDefault()
    if (validateEmpty("new_pig_tag")) {
        validityCost("new_pig_tag", "Please enter pig tag .")
    }
    else if (validateEmpty("weight")) {
        validityCost("new_pig_weight", "Pig weight cannot be empty.")
    } else if ($("#new_pig_breed").val() == "default") {
        validityCost("new_pig_breed", "Select pig breed first.")
    }
    else if (validateEmpty("birthdate")) {
        validityCost("birthdate", "Birthdate should not be empty.")
    }
    else {
        new_pig().then((data) => {
            console.log(data)
            var parsed = JSON.parse(data);
            if (parsed.code == 200) {
                success(parsed.message)
                $("#add_pig_details").addClass("hidden")
                display_pig()
                $(".data-batch").remove();
            } else if (parsed.code == 500) {
                error(parsed.message)
            }
        })

    }
})
function new_pig() {
    return new Promise((resolve, reject) => {
        $("#add_boar").removeAttr("disabled", "disabled")
        $("#add_sow").removeAttr("disabled", "disabled")
        $("#new_pig_id").removeAttr("disabled");
        $("#add_pig_batch").removeAttr("disabled")
        var data = $("#add_pig_form").serializeArray()
        $("#new_pig_id").attr("disabled", "disabled")
        $("#add_pig_batch").attr("disabled")
        $.ajax({
            type: "post",
            url: "configs/php/new_pig.php",
            data: data,
            success: function (response) {
                resolve(response)
            }
        });
    })
}

function new_batch() {
    return new Promise((resolve, reject) => {
        $("#add_boar").removeAttr("disabled", "disabled")
        $("#add_sow").removeAttr("disabled", "disabled")
        $.ajax({
            type: "post",
            url: "configs/php/new_batch.php",
            data: {
                "boar": $("#add_boar").val(),
                "sow": $("#add_sow").val(),
            },
            success: function (response) {
                resolve(response)
            }
        });
    })
}


function display_pig() {
    $(".pig-data").remove()
    $.ajax({
        type: "post",
        url: "configs/php/display_pig.php",
        data: {},
        success: function (response) {
            $("#pig-data").append(response)
        }
    });
}

$("#pig_details_search").on("input", (event) => {
    $(".pig-data").remove()
    $.ajax({
        type: "post",
        url: "configs/php/search_pig.php",
        data: {
            "keyword": $("#pig_details_search").val()
        },
        success: function (response) {
            $("#pig-data").append(response)
        }
    });
})