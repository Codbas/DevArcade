"use strict"

const titleText = document.getElementById('upload-title');
const descriptionText = document.getElementById('upload-description');
const fileInput = document.getElementById('fileInput');
const removeFileButton = document.getElementById('removeFile');
const uploadButton = document.getElementById('uploadContentButton');
const deleteSelect = document.getElementById('deleteSelect');
const deleteButton = document.getElementById('deleteContentButton');
const uploadMessage = document.getElementById('upload-message');
const deleteMessage = document.getElementById('delete-message');
const uploadGameSelector = document.getElementById('uploadGameSelector');
const uploadDevlogSelector = document.getElementById('uploadDevlogSelector');
const deleteGameSelector = document.getElementById('deleteGameSelector');
const deleteDevlogSelector = document.getElementById('deleteDevlogSelector');

let games = JSON.parse(sessionStorage.getItem('games'));
let devlogs = JSON.parse(sessionStorage.getItem('devlogs'));

fileInput.addEventListener('change', checkValidFile);
removeFileButton.addEventListener('click', removeFile);
deleteButton.addEventListener('click', showDeleteConfirm);
deleteMessage.addEventListener('content-deleted', updateSelectOptions);
uploadButton.addEventListener('click', upload);
uploadMessage.addEventListener('content-uploaded', uploadUpdateContent);


loadOptions('games');

function upload(event) {
    titleText.value = titleText.value.trim();
    descriptionText.value = descriptionText.value.trim();

    let errorMsg = checkInput(titleText);
    if (errorMsg !== '') {
        uploadMessage.innerText = errorMsg;
        event.preventDefault();
        return false;
    }

    errorMsg = checkInput(descriptionText);
    if (errorMsg !== '') {
        uploadMessage.innerText = errorMsg;
        event.preventDefault();
        return false;
    }

    if (fileInput.value === '') {
        uploadMessage.innerText = 'ERROR: No file selected';
        event.preventDefault();
        return false;
    }

    errorMsg = getValidFileStatus();
    if (errorMsg !== '') {
        uploadMessage.innerText = errorMsg;
        event.preventDefault();
        return false;
    }

    uploadMessage.innerText = '';
}

function checkInput(element) {
    let errorMsg = '';
    const contentType = document.getElementById('uploadContentType');

    if (element.name === 'title') {
        switch (contentType.value) {
            case 'game':
                if (games.includes(element.value)) {
                    errorMsg = 'A game with this title already exists.';
                    return errorMsg;
                }
                break;
            case 'devlog':
                if (devlogs.includes('Dev Log - ' + element.value)) {
                    errorMsg = 'A dev log with this title already exists.';
                    return errorMsg;
                }
                break;
        }
    }

    if (!validStringLength(element.value, element.minLength, element.maxLength)) {
        errorMsg = `ERROR: ${element.name} must have between ${element.minLength} and ${element.maxLength} characters`;
        if (element.value === '') {
            return errorMsg;
        }
    }

    if (!validString(element.value)) {
        if (errorMsg === '') {
            errorMsg += `ERROR: ${element.name} can only contain ?!,.- symbols`;
        }
        else {
            errorMsg += ' and can only contain the ?!,.- symbols'
        }
    }

    return errorMsg;
}

function removeFile() {
    fileInput.value = '';
}

function checkValidFile(event) {
    const errorMsg = getValidFileStatus();
    if (errorMsg !== '') {
        uploadMessage.textContent = errorMsg;
        removeFile();
        event.preventDefault();
        return false;
    }
}

function getValidFileStatus() {
    const file = fileInput.files[0];
    const maxSize = 1_000_000 * 10; // 10 MB
    let errorMsg = '';

    if(file.size > maxSize) {
        errorMsg = 'File must be less than 10MB. ' +  shortenZipString(file.name) + ': ' + ((file.size/ 1000000).toFixed(1) + " MB.");
    }

    return errorMsg;
}

function showDeleteConfirm(e) {
    const contentType = document.getElementById('deleteContentType').value;
    const content = deleteSelect.value;

    if (!confirm('Do you want to PERMANENTLY delete the ' + contentType + ' ' + content + '?')) {
        e.preventDefault();
        return false;
    }
}

function loadOptions(contentType) {
    removeAllChildNodes(deleteSelect);
    const contentArray = (contentType === 'games') ? games : devlogs;

    if (contentArray.length < 1 || contentArray == undefined) {
        deleteButton.disabled = true;
        const noOptionText = 'No ' + contentType + ' found';
        const noOption = document.createElement('option');
        noOption.textContent = noOptionText;
        deleteSelect.appendChild(noOption);
        return;
    }

    deleteButton.disabled = false;
    for (let i = 0; i < contentArray.length; i++) {
        const option = document.createElement('option');
        option.textContent = contentArray[i];
        option.value = contentArray[i];
        deleteSelect.appendChild(option);
    }
}

function setContentType(type, upload) {
    let gameSelectorId = "uploadGameSelector";
    let devlogSelectorId = "uploadDevlogSelector";
    let contentTypeId = "uploadContentType";

    if (!upload) {
        gameSelectorId = "deleteGameSelector";
        devlogSelectorId = "deleteDevlogSelector";
        contentTypeId = "deleteContentType";
    }

    const gameSelector = document.getElementById(gameSelectorId);
    const devlogSelector = document.getElementById(devlogSelectorId);
    const contentType = document.getElementById(contentTypeId);

    switch (type){
        case `game`:
            gameSelector.classList.add(`selected`);
            devlogSelector.classList.remove(`selected`);
            if (!upload) {
                loadOptions('games');
            }
            break;
        case `devlog`:
            devlogSelector.classList.add(`selected`);
            gameSelector.classList.remove(`selected`);
            if (!upload) {
                loadOptions('devlogs');
            }
            break;
    }
    contentType.value = type;
}

function uploadUpdateContent() {
    const contentType = document.getElementById('uploadContentType').value;

    console.log(titleText.value);
    if (contentType === 'game') {
        games.push(titleText.value);
    }
    else {
        devlogs.push(`Dev Log - ${titleText.value}`);
    }

    if (contentType === document.getElementById('deleteContentType').value) {
        loadOptions(contentType + 's');
    }
    titleText.value = '';
    descriptionText.value = '';
    removeFile();
}

function updateSelectOptions() {
    const contentType = document.getElementById('deleteContentType').value;
    const content = deleteSelect.value;

    for (let i = 0; i < deleteSelect.length; i++) {
       if (deleteSelect.options[i].value === content) {
            deleteSelect.options[i].remove();

            if (contentType === 'game') {
                games = removeFromArray(games, content);
                sessionStorage.setItem('games', JSON.stringify(games));
                sessionStorage.removeItem('games');
            }
           else {
               devlogs = removeFromArray(devlogs, content);
               sessionStorage.removeItem('devlogs');
               sessionStorage.setItem('devlogs', JSON.stringify(devlogs));
          }
          break;
       }
    }

    if (deleteSelect.length < 1) {
        deleteButton.disabled = true;
        const noOptionText = 'No ' + contentType + ' found';
        const noOption = document.createElement('option');
        noOption.textContent = noOptionText;
        deleteSelect.appendChild(noOption);
    }
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function removeFromArray(arr, value) {
    for (let i = 0; i < arr.length; i++) {
        if (arr[i] === value) {
            arr.splice(i, 1);
        }
    }
    return arr;
}

function validString(str) {
    const regex = /^[a-zA-Z0-9 \-.,!?]+$/;
    return  regex.test(str);
}

function validStringLength(str, minLength, maxLength) {
    return (str.length >= minLength && str.length <= maxLength);
}

function shortenZipString(str) {
    const maxLength = 29;

    if (str.length < maxLength + 7) { // extension length + three periods
        return str;
    }

    const beginning = str.slice(0, ((maxLength / 2) - 1));
    const end = str.slice(((maxLength / 2) + 2), maxLength);

    return `${beginning}...${end}.zip`;
}
