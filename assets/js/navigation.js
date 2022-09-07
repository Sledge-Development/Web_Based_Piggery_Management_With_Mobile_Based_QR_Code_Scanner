$("#login").on("click", () => {
  open("/dashboard.html", "_self");
});
$("#dashboard").on("click", () => {
  open("/dashboard.html", "_self");
});

$("#record_management").on("click", () => {
  open("/record_management.html", "_self");
});
$("#inventory_management").on("click", () => {
  open("/inventory_management.html", "_self");
});
$("#scheduling_management").on("click", () => {
  open("/scheduling_management.html", "_self");
});
$("#pig_management").on("click", () => {
  open("/pig_management.html", "_self");
});
$("#user_management").on("click", () => {
  open("/user_management.html", "_self");
});
$("#reports").on("click", () => {
  open("/reports.html", "_self");
});
$("#backup_and_restore").on("click", () => {
  open("/backup_and_restore.html", "_self");
});
$("#logout").on("click", () => {
  open("/index.html", "_self");
});

$(document).ready((event) => {
  var host = window.location;
  var menu_id=path_menu(host.pathname)
  $("#"+menu_id).addClass("bg-gray-600")
});

function path_menu(pathname) {
  var data = pathname.split("/")[1].split(".")[0];
  return data;
}
