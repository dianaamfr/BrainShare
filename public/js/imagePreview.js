'use strict'

const reader = new FileReader();
const fileInput = document.getElementById("register-file");
const img = document.getElementById("register-image");
const imgError = document.getElementById("profile-image-error");

if(fileInput){
    reader.onload = e => {
        img.src = e.target.result;
    }

    fileInput.addEventListener('change', e => {
        let f = e.target.files[0];
        if (validateFile(f)){
            reader.readAsDataURL(f);
        }
        else {
           imgError.innerHTML = "Invalid image (supports png, jpg or jpeg)."
        }
    })    
}

function validateFile(file) {

    console.log(file.name);
    const allowedExtensions = ['jpeg', 'jpg', 'png'];
    const fileExtension = file.name.split('.').pop().toLowerCase();

    return allowedExtensions.includes(fileExtension);
}
