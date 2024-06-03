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
logoutOption.addEventListener("click", clickLogout);

dashMenu.append(dashCloseBtn, changePasswordOption, manageContentOption, logoutOption);
document.body.appendChild(dashMenu);

function showDashMenu(event) {
    event.stopPropagation();
    dashMenu.className = "visible";
    return false;
}

function hideDashMenu(event) {
    dashMenu.classList.remove("visible");
    event.preventDefault();
    event.stopPropagation();
    return false;
}

function isClickOutsideDashMenu(event) {
    if (dashMenu.classList.contains('visible') && !dashMenu.contains(event.target)) {
        hideDashMenu(event);
    }
}

function clickRedirect(event) {
    console.log(event.target.id);
    switch (event.target.id) {
        case 'dash-change-password':
            window.location.href = "../public/ChangePassword.php";
            break;
        case 'dash-manage-content':
            window.location.href = "../public/ManageContent.php";
            break;
        default:
            // Do nothing
    }
}

function clickLogout() {
    fetch('../includes/logoutUser.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
            if (data.status === 'success') {
                window.location.href = "../public/Home.php";
            } else {
                console.error('Logout failed');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}
