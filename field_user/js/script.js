// JavaScript Document

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  var lat = position.coords.latitude;
  document.getElementById("get_latitude").value = lat;
  var lon = position.coords.longitude;
  document.getElementById("get_longitude").value = lon;
}