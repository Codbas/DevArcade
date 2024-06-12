"use strict"
const loginButton = document.getElementById('submit-button');
const username = document.getElementById('username');
const password = document.getElementById('password');
const message = document.getElementById('login-message');

loginButton.addEventListener('click', validateInputs);

function validateInputs(e) {
    const passwordResults = validPassword(password.value);
    const usernameResults = isValidUsername(username.value);
    const emptyInputs = checkBlanks();

    if (emptyInputs !== '') {
        displayMessage(emptyInputs);
        e.preventDefault();
        return;
    }

    if (usernameResults !== '') {
        displayMessage(usernameResults);
        e.preventDefault();
        return;
    }

    if (passwordResults !== '') {
        displayMessage(passwordResults);
        e.preventDefault();
        return;
    }

    message.style.color = 'red';
}
function displayMessage(msg) {
    message.style.color = '#000';
    message.innerText = msg;
}
function isValidUsername(username) {
    const reg = /^[A-Za-z0-9]$/
    const minLen = 4;
    const maxLen = 20;

    if (username.length < minLen || username.length > maxLen) {
        return `Username must be between ${minLen} and ${maxLen} characters`;
    }
    if (reg.test(username)) {
        return 'Username can only contain letters and numbers';
    }

    return '';
}
function validPassword(password) {
    const reg = /^[A-Za-z0-9!@#$%^&*()?.-]+$/;
    const minLen = 8;
    const maxLen = 24;

    if (password.length < minLen || password.length > maxLen) {
        return `Password must be between ${minLen} and ${maxLen} characters`;
    }
    if (!reg.test(password)){
        return 'Password can only contain letters, numbers and the symbols !@#$%^&*()?.-';
    }

    return '';
}

function checkBlanks() {
    let error = '';
    let msg = '';

    if (isBlank(username)) {
        msg = 'user'
    }
    if (msg !== '' && isBlank(password)) {
        msg = 'user and pass';
    }
    else if (isBlank(password)) {
        msg = 'pass';
    }

    switch (msg) {
        case 'user':
            error = 'Username cannot be blank';
            break;
        case 'pass':
            error = 'Password cannot be blank';
            break;
        case 'user and pass':
            error = 'You left the Username and Password blank!';
            break;
    }
    return error;
}

function isBlank(input) {
    return input.value === '';
}
