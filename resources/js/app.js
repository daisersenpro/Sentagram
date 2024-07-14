import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar archivo',
    maxFiles: 1,
    uploadMultiple: false, 

    init: function() {
        const imagen = document.querySelector('[name="imagen"]').value.trim();
        if (imagen) {
            const imagenPublicada = { size: 1234, name: imagen };

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagen}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    },
});

dropzone.on("success", function(file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on("removedfile", function() {
    document.querySelector('[name="imagen"]').value = '';
});
