document.addEventListener("DOMContentLoaded", function () {
  var note = document.createElement("div");
  note.className = "admin-note";
  note.innerHTML =
    '<p>You are viewing a demo of SilverShop. To login visit <a href="http://demo.silvershop.io/admin">demo.silvershop.io/admin</a>. Username and password is silvershopcore.</p>';
  document.body.prepend(note);
});
