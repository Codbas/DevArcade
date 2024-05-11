"use strict"

document.documentElement.style.cssText = `
    user-select: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
`;

const body = document.body;
body.style.margin = '0px';
body.style.overflow = 'hidden';
body.innerHTML = 'Game One';
body.style.cssText = `
    margin: 0px;
    margin-top: 10vh;
    font-weight: bold;
    font-size: 64px;
    padding: 0px;
    text-align: center;
    overflow: hidden;
    user-select: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
`

const button = document.createElement('div');
document.body.appendChild(button);
let buttonWidth = 120;
let buttonHeight = 60;

button.innerHTML = "Click Me";
button.style.cssText = `
    width: ${buttonWidth}px;
    height: ${buttonHeight}px;
    background: #888888;
    border: 2px solid #000000;
    color: #ffffff;
    font-family: 'Comic Sans MS';
    font-size: 16px;
    font-weight: normal;
    border-radius: 6px;
    text-align: center;
    line-height: ${buttonHeight}px; 
    cursor: pointer;
    position: absolute;
    user-select: none;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
`;

button.addEventListener('mouseover', function () {
    button.style.background = '#555555';
})
button.addEventListener('mouseout', function () {
    button.style.background = '#888888';
})

let start = false;

let windowWidth = window.innerWidth;
let windowHeight = window.innerHeight;
let mouseX, mouseY;
let posX = (windowWidth / 2) - (buttonWidth / 2);
let posY = (windowHeight / 2) - (buttonHeight / 2);

button.style.top = posY + 'px';
button.style.left = posX + 'px';

let accelerationX = 0.0;
let accelerationY = 0.0;
let velocityX = 0, velocityY = 0;

let drag = 0.015;
let bounceFactor = 1.50;
let mousePower = 0.005;
let maxAcceleration = 3.0;
let minAcceleration = -3.0;
let maxVelocity = 7;
let minVelocity = -7;
let forceRadius = 750;
let maxForce = 75;
let minForce = -75;

function updateButtonPosition() {
    let force = calcForce(mouseX, mouseY, (button.offsetLeft + (buttonWidth / 2)), (button.offsetTop + (buttonHeight / 2)));
    accelerationX = clamp((mousePower * force[0]), maxAcceleration, minAcceleration);
    accelerationY = clamp((mousePower * force[1]), maxAcceleration, minAcceleration);

    velocityX += accelerationX;
    velocityY += accelerationY;

    velocityX = clamp(velocityX, maxVelocity, minVelocity);
    velocityY = clamp(velocityY, maxVelocity, minVelocity);

    velocityX *= (1 - drag);
    velocityY *= (1 - drag);

    posX += velocityX;
    if (posX < 0) {
        posX = 0;
        velocityX = -velocityX * bounceFactor;
    }
    if (posX > (windowWidth - buttonWidth)) {
        posX = (windowWidth - buttonWidth)
        velocityX = -velocityX * bounceFactor;
    }

    posY += velocityY;
    if (posY < 0) {
        posY = 0;
        velocityY = -velocityY * bounceFactor;
    }
    if (posY > (windowHeight - buttonHeight)) {
        posY = (windowHeight - buttonHeight);
        velocityY = -velocityY * bounceFactor;
    }

    button.style.top = posY + 'px';
    button.style.left = posX + 'px';

    requestAnimationFrame(updateButtonPosition);
}

document.addEventListener('mousemove', (event) => {
    mouseX = event.clientX;
    mouseY = event.clientY;
});

button.addEventListener('click', function() {
    if (!start) {
        start = !start;
        updateButtonPosition()
    }
});

window.addEventListener('resize', function() {
    windowWidth = window.innerWidth;
    windowHeight = window.innerHeight;

    if (!start) {
        button.style.left = ((windowWidth / 2) - (buttonWidth / 2)) + 'px';
        button.style.top = ((windowHeight / 2) - (buttonHeight / 2)) + 'px';
    }
});

function clamp(val, max, min) {
    return Math.min(Math.max(val, min), max);
}

window.addEventListener('mouseout', function() {
    mouseX = -9999999;
    mouseY = -9999999;
})

function calcForce(x1, y1, x2, y2) {
    let dx = x2 - x1;
    let dy = y2 - y1;
    let r = Math.sqrt(dx**2 + dy**2);

    if (r > forceRadius)
        return [0, 0]

    let F = 10000 / (r**1.3);
    let u = [dx / r, dy / r];

    return [clamp((F * u[0]), maxForce, minForce), clamp((F * u[1]), maxForce, minForce)];
}

const numOptions = 8;
const menu = document.createElement('div');
menu.id = 'menu';
menu.style.position = 'absolute';
menu.style.fontSize = '16px';
menu.style.display = 'none';
menu.style.width = '200px';
if (navigator.userAgent.indexOf('Firefox') != -1)
    menu.style.height = '500px';
else
    menu.style.height = '455px';

const optionId = ['mousePower', 'drag', 'bounceFactor','forceRadius', 'maxAcceleration',
    'maxVelocity', 'buttonWidth', 'buttonHeight']
const optionStrings = ['Mouse Power', 'Drag', 'Wall Bounce', 'Force Radius', 'Max Acceleration',
    'Max Velocity', 'Button Width', 'Button Height', 'Reset To Defaults'];
const optionRange = [[0.0, 0.03], [0.0, 1.0], [0.0, 5.0], [0.0, 2000.0], [0.0, 20.0], [0.0, 30.0], [10, 500], [10, 500]];
const optionDefault = [mousePower, drag, bounceFactor, forceRadius, maxAcceleration, maxVelocity, buttonWidth, buttonHeight];

for (let i = 0; i < numOptions; i++) {
    let optionContainer = document.createElement('div');
    optionContainer.id = optionId[i];

    let option = document.createElement('div');
    option.innerHTML = optionStrings[i];
    option.style.fontWeight = 'normal';

    let slider = document.createElement('input');
    slider.type = 'range';
    slider.min = optionRange[i][0];
    slider.max = optionRange[i][1];
    slider.step = ((optionRange[i][1] - optionRange[i][0]) / 100);

    slider.addEventListener('input', function() {
        switch(optionId[i]) {
            case optionId[0]:
                mousePower = slider.value;
                break;
            case optionId[1]:
                drag = slider.value;
                break;
            case optionId[2]:
                bounceFactor = slider.value;
                break;
            case optionId[3]:
                forceRadius = slider.value;
                break;
            case optionId[4]:
                maxAcceleration = slider.value;
                minAcceleration = -slider.value;
                break;
            case optionId[5]:
                maxVelocity = slider.value;
                minVelocity = -slider.value;
                break;
            case optionId[6]:
                buttonWidth = slider.value;
                button.style.width = slider.value + 'px';
                button.style.left = ((windowWidth / 2) - (buttonWidth / 2)) + 'px';
                if (!start)
                    posX = (windowWidth / 2) - (buttonWidth / 2);
                break;
            case optionId[7]:
                buttonHeight = slider.value;
                button.style.height = slider.value + 'px';
                button.style.lineHeight = slider.value + 'px'
                button.style.top = ((windowHeight / 2) - (buttonHeight / 2)) + 'px';
                if (!start)
                    posY = (windowHeight / 2) - (buttonHeight / 2);
                break;
        }
    });

    optionContainer.appendChild(option);
    optionContainer.appendChild(slider);
    menu.appendChild(optionContainer);
}

document.body.appendChild(menu);

for (let i = 0; i < numOptions; i++) {
    document.getElementById(optionId[i]).children[1].value = optionDefault[i];
}

let resetDefaults = document.createElement('div');
resetDefaults.innerHTML = "Reset To Defaults";;
resetDefaults.style.cursor = 'pointer';

resetDefaults.addEventListener('click', function() {
    document.getElementById('mousePower').children[1].value = optionDefault[0];
    mousePower = optionDefault[0];
    document.getElementById('drag').children[1].value = optionDefault[1];
    drag = optionDefault[1];
    document.getElementById('bounceFactor').children[1].value = optionDefault[2];
    bounceFactor = optionDefault[2];
    document.getElementById('forceRadius').children[1].value = optionDefault[3];
    forceRadius = optionDefault[3];
    document.getElementById('maxAcceleration').children[1].value = optionDefault[4];
    maxAcceleration = optionDefault[4];
    minAcceleration = -optionDefault[4];
    document.getElementById('maxVelocity').children[1].value = optionDefault[5];
    maxVelocity = optionDefault[5];
    minVelocity = -optionDefault[5];
    document.getElementById('buttonWidth').children[1].value = optionDefault[6];
    buttonWidth = optionDefault[6];
    button.style.width = optionDefault[6] + 'px';
    button.style.left = ((windowWidth / 2) - (buttonWidth / 2)) + 'px';
    document.getElementById('buttonHeight').children[1].value = optionDefault[7];
    buttonHeight = optionDefault[7];
    button.style.height = optionDefault[7] + 'px';
    button.style.lineHeight = optionDefault[7] + 'px';
    button.style.top = ((windowHeight / 2) - (buttonHeight / 2)) + 'px';
});

menu.appendChild(resetDefaults);

let reset = document.createElement('div');
reset.innerHTML = 'Reset';
reset.style.color = '#ad1616';
reset.style.cursor = 'pointer';

reset.addEventListener('click', function() {
    location.reload();
});

menu.appendChild(reset);

for (let i = 0; i < menu.children.length; i++) {
    menu.children[i].style.cssText = `
    font-size: 12px;
    font-family: 'Comic Sans MS';
    font-weight: 'normal';
    padding-top: 5px;
    padding-bottom: 5px;
    border: 1px solid #bbbbbb;
    background: #eeeeee;
    padding-left: 10px;
    padding-right: 10px;
    `
    menu.children[i].addEventListener('mouseover', function() {
        menu.children[i].style.background = '#dddddd';
    });

    menu.children[i].addEventListener('mouseout', function() {
        menu.children[i].style.background = '#eeeeee';
    });

    if (i === 0) {
        menu.children[i].style.borderTopRightRadius = '4px';
        menu.children[i].style.borderTopLeftRadius = '4px';
    }
    if (i === (menu.children.length - 1)) {
        menu.children[i].style.borderBottomRightRadius = '4px';
        menu.children[i].style.borderBottomLeftRadius = '4px';
        menu.children[i].style.color = '#ad1616';
    }
}

document.addEventListener('contextmenu', function(e) {
    e.preventDefault();

    menu.style.left = e.clientX + 'px';
    menu.style.top = e.clientY + 'px';
    let menuWidth = parseInt(menu.style.width);
    let menuHeight = parseInt(menu.style.height);

    if ((menuWidth + e.clientX) > windowWidth)
        menu.style.left = (e.clientX - ((menuWidth + e.clientX) - windowWidth)) + 'px';

    if ((menuHeight + e.clientY) > windowHeight)
        menu.style.top = (e.clientY - ((menuHeight + e.clientY) - windowHeight)) + 'px';

    menu.style.display = 'block';

    document.addEventListener('click', hideMenu);
});

function hideMenu(e) {
    if (menu.contains(e.target))
        return;

    menu.style.display = 'none';
    document.removeEventListener('click', function() {
    });
}
