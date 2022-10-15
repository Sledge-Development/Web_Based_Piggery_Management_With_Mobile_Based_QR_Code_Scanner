var notif = new Notyf({
  duration: 5000,
  ripple: true,
  position: {
    x: "right",
    y: "top",
  },
  dismissible: true,
});
function success(message) {
  notif.success(message);
}
function error(message) {
  notif.error(message);
}
function validityCost(id, message) {
  $("#" + id).get(0).setCustomValidity(message)
  $("#" + id).get(0).reportValidity();
  setTimeout(() => {
    $("#" + id).get(0).setCustomValidity('')
  }, 2000)
}
function validateEmpty(id) {
  if ($("#" + id).val() == "") {
    return true
  } else {
    return false
  }
}