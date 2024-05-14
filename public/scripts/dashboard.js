"use strict"

const dashButton = document.getElementById("dashboard-button");
dashButton.addEventListener("click", showDashMenu);

const dashMenu = document.createElement("div");
const dashCloseBtn = document.createElement("div");
const changePasswordOption = document.createElement("div");
const manageContentOption = document.createElement("div");
const logoutOption = document.createElement("div");

dashMenu.id = "dash-menu";
dashCloseBtn.id = "dash-close-button";
changePasswordOption.id = "dash-change-password";
manageContentOption.id = "dash-manage-content";
logoutOption.id = "dash-logout";

dashCloseBtn.innerHTML = "x";
changePasswordOption.innerHTML = "Change Password";
manageContentOption.innerHTML = "Manage Content";
logoutOption.innerHTML = "Logout";

document.addEventListener("click", isClickOutsideDashMenu);
dashCloseBtn.addEventListener("click", hideDashMenu);
changePasswordOption.addEventListener("click", clickRedirect);
manageContentOption.addEventListener("click", clickRedirect);

dashMenu.append(dashCloseBtn, changePasswordOption, manageContentOption, logoutOption);
document.body.appendChild(dashMenu);

function showDashMenu(event) {
    event.stopPropagation();
    dashMenu.className = "visible";
}

function hideDashMenu() {
    dashMenu.classList.remove("visible");
}

function isClickOutsideDashMenu(event) {
    if (dashMenu.classList.contains('visible') && !dashMenu.contains(event.target)) {
        hideDashMenu();
    }
}

function clickRedirect(event) {
    console.log(event.target.id);
    switch (event.target.id) {
        case 'dash-change-password':
            window.location.href = "/public/ChangePassword.php";
            break;
        case 'dash-manage-content':
            window.location.href = "/public/ManageContent.php";
            break;
        default:
            // Do nothing
    }
}

function clickLogout() {
    // TODO: remove session token from database and remove session storage, redirect to home
}
