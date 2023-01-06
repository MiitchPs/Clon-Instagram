import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube Aqui tu Imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //Funcion para imagen publicada 
    init: function () {
        //alert("dropzone Creado");
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(
                this,
                imagenPublicada,
                `/uploads/${imagenPublicada.name}`
            );

            imagenPublicada.previewElement.classList.add(
                'dz-success',
                'dz-complete'
            );
        }
    },
});

//Para Testear Los typos de datos enviados
/*dropzone.on("sending", function (file, xhr, formData) {
    console.log(formData);
});*/
dropzone.on("success", function (file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});
/*dropzone.on("error", function (file, message) {
    console.log(message);
});*/
dropzone.on("removedfile", function () {
    //  console.log("Archivo Eliminado");
    document.querySelector('[name="imagen"]').value = "";
});



