function openMenu() {
    const Btn = document.getElementById('SideMenuBtn');
    const Menu = document.getElementById('SideMenu');
    let buttonStatus = Btn.textContent
    if (buttonStatus == "❮") {
        Btn.innerHTML = "&#10095;"
        Btn.style.marginRight = "200px"
        Menu.style.marginRight = "0px"
    }
    else {
        Btn.innerHTML = "&#10094;"
        Btn.style.marginRight = "0px"
        Menu.style.marginRight = "-200px"
    }
    //console.log(buttonStatus)

}
function Login_out() {
    location.href = "register";
}
