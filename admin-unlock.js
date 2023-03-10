// Title: admin-unlock.js
// Author: Brian Choi
// Updated: 1/27/2022
// Version: 1.0.0
// Purpose: Script for unlocking user in the admin page.

function changeLockStatus() {
  var userId = event.target.parentNode.parentNode.id;
  var data = document.getElementById(userId).querySelectorAll(".row-data");
  var username = data[0].innerHTML;
  var locked = data[1].value;
  var preChange = locked;

  $.ajax({
    method: 'post',
    url: 'admin-unlock.php',
    data: {
      'username': username,
      'locked': locked
    },
  });

  var postChange = locked;
  if(locked == 1) {
    alert(`${username} has been unlocked!`);
  } else {
    alert(`${username} has been locked!`);
  }

  location.reload();

}
