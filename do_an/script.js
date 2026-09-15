function login() {
  window.location.href = "login/user.php";
}

const exploreButton = document.getElementById("btnChuyenTrang");
if (exploreButton) {
  exploreButton.addEventListener("click", function () {
    window.location.href = "main/index.php";
  });
}
