import {Dropzone} from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzoneProfile', {
    dictDefaultMessage: 'Sube tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Remove File',
    maxFiles: 1,
    uploadMultiple: false,
})

dropzone.on('sending', function (file, xhr, formData) {
        console.log(file);
    }
);

dropzone.on('success',function (file, response){
    //console.log(response.nameImage);
    document.getElementById('user_image').value = response.userImage;
});

dropzone.on('error', function (file, message) {
        console.log(message);
    }
);

dropzone.on('removedFile', function () {
        console.log('Archivo eliminado');
    }
);
