var eventTarget = "hidden";
$("#dashboard").on("click", () => {
  open("/dashboard.php", "_self");
});

$("#record_management").on("click", (event) => {
  event.preventDefault();
  if (event.target.parentElement.id == "manage_deworming" || event.target.id == "manage_deworming") {
    open("/manage_deworming.php", "_self")
  } else if (event.target.parentElement.id == "manage_feeding" || event.target.id == "manage_feeding") {
    open("manage_feeding.php", "_self")
  } else if (event.target.parentElement.id == "manage_vaccination" || event.target.id == "manage_vaccination") {
    open("/manage_vaccination.php", "_self")
  } else if (event.target.parentElement.id == "manage_medicine" || event.target.id == "manage_medicine") {
    open("/manage_medicine.php", "_self")
  }
  if (event.currentTarget.id == "record_management") {
    if (eventTarget == "hidden") {
      $(".record_sub_menu").removeClass("hidden")
      $("#record_management").removeClass("bg-gray-500")
      $("#record_management").addClass("bg-gray-900")
      eventTarget = "shown";
      $("#down_indicator").addClass("rotate-180")
    } else {
      $("#record_management").addClass("bg-gray-500")
      $("#record_management").removeClass("bg-gray-900")
      $(".record_sub_menu").addClass("hidden")
      eventTarget = "hidden"
      $("#down_indicator").removeClass("rotate-180")
    }
  }
});
$("#inventory_management").on("click", () => {

  open("/inventory_management.php", "_self");
});
$("#scheduling_management").on("click", () => {
  open("/scheduling_management.php", "_self");
});
$("#pig_management").on("click", () => {
  open("/pig_management.php", "_self");
});
$("#user_management").on("click", () => {
  open("/user_management.php", "_self");
});
$("#reports").on("click", () => {
  open("/reports.php", "_self");
});
$("#backup_and_restore").on("click", () => {
  open("/backup_and_restore.php", "_self");
});
$("#logout").on("click", () => {
  $.ajax({
    type: "post",
    url: "/configs/php/logout.php",
    data: {},
    success: function (response) {
      open("/index.php", "_self");
    }
  });

});

$(document).ready((event) => {

  var host = window.location;
  var menu_id = path_menu(host.pathname)
  if (menu_id.includes("manage")) {
    $("#" + menu_id).addClass("bg-gray-600")
    if ($("#" + menu_id)[0].parentElement.id == "record_management") {
      $(".record_sub_menu").removeClass("hidden")
      $("#record_management").removeClass("bg-gray-500")
      $("#record_management").addClass("bg-gray-900")
      eventTarget = "shown";
      $("#down_indicator").addClass("rotate-180")
    }
  }
  if (getUserJob() == "veterinarian") {
    $("#inventory_management").remove();
    $("#reports").remove();
    $("#backup_and_restore").remove()
    $("#user)management").remove()
  } else if (getUserJob() == "worker") {
    $("#reports").remove()
    $("#backup_and_restore").remove()
    $("#user_management").remove()
  }
});

function path_menu(pathname) {
  var data = pathname.split("/")[1].split(".")[0];
  return data;
}


function getUserJob() {
  var cookie = document.cookie.split(";")
  var job = "";
  for (let i = 0; i < cookie.length; i++) {
    if (cookie[i].includes("job")) {
      job = cookie[i].split("=")[1]
    }
  }
  return job;
}