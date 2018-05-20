/* ------------------------------------------------------------------------------
*
*  # Dropzone multiple file uploader
*
*  Specific JS code additions for uploader_dropzone.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Defaults
    Dropzone.autoDiscover = false;


    // // Single file
    // $("#dropzone_single").dropzone({
    //     paramName: "file", // The name that will be used to transfer the file
    //     maxFilesize: 1, // MB
    //     maxFiles: 1,
    //     dictDefaultMessage: 'Drop file to upload <span>or CLICK</span>',
    //     autoProcessQueue: false,
    //     init: function() {
    //         this.on('addedfile', function(file){
    //             if (this.fileTracker) {
    //             this.removeFile(this.fileTracker);
    //         }
    //             this.fileTracker = file;
    //         });
    //     }
    // });


    // // Multiple files
    // $("#dropzone_multiple").dropzone({
    //     paramName: "file", // The name that will be used to transfer the file
    //     dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
    //     maxFilesize: 0.1 // MB
    // });


    // // Accepted files
    // $("#dropzone_accepted_files").dropzone({
    //     paramName: "file", // The name that will be used to transfer the file
    //     dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
    //     maxFilesize: 1, // MB
    //     acceptedFiles: 'image/*'
    // });



    // Removable thumbnails
    var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
    var fileList = new Array;
    var i = 0;
    $("#dropzone_remove").dropzone({
        paramName: "file", // The name that will be used to transfer the file
        dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        url: "http://marketplace-kombas.com/Seller/uploaddropzone",
        init: function () {

            // Hack: Add the dropzone class to the element
            $(this.element).addClass("dropzone");

            this.on("success", function (file, serverFileName) {
                fileList[i] = {
                    "serverFileName": serverFileName,
                    "fileName": file.name,
                    "fileId": i
                };
                $('.dz-message').show();
                i += 1;
            });
            this.on("removedfile", function (file) {
                var rmvFile = "";
                for (var f = 0; f < fileList.length; f++) {
                    if (fileList[f].fileName == file.name) {

                        $.ajax({
                                url: "http://marketplace-kombas.com/Seller/deletedropzone/"+file.name, //your php file path to remove specified image
                                type: "POST",
                                data: {
                                    filenamenew: rmvFile,
                                    type: 'delete',
                                },
                            });
                    }
                }

                
            });

        }
    });


    //  $("#dropzone_sampul").dropzone({
    //     url: "http://marketplace-kombas.com/Seller/uploaddropzone",
    //     acceptedFiles: "image/*",
    //     addRemoveLinks: true,
    //     maxFiles: 1,
    //     removedfile: function(file) {
    //         var name = file.name;

    //         $.ajax({
    //             type: "post",
    //             url: "http://marketplace-kombas.com/Seller/deletedropzone",
    //             data: { file: name },
    //             dataType: 'html'
    //         });

    //         // remove the thumbnail
    //         var previewElement;
    //         return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
    //     },
    //     init: function() {
    //         var me = this;
    //         $.get("<http://marketplace-kombas.com/Seller/list_files", function(data) {
    //             // if any files already in server show all here
    //             if (data.length > 0) {
    //                 $.each(data, function(key, value) {
    //                     var mockFile = value;
    //                     me.emit("addedfile", mockFile);
    //                     me.emit("thumbnail", mockFile, "http://marketplace-kombas.com/assets/images/test/" + value.name);
    //                     me.emit("complete", mockFile);
    //                 });
    //             }
    //         });
    //     },
    //     renameFilename: function (filename) {
    //         return 'PRODUCT_ADD_0';
    //     }
    // });







    $("#dropzone_galeri").dropzone({
        paramName: "file", // The name that will be used to transfer the file
        dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
        maxFilesize: 2, // MB
        acceptedFiles: "image/jpeg,image/png,image/gif",//"image/*",
        maxFiles: 6,
        addRemoveLinks: true,
        url: "http://marketplace-kombas.com/Ajax/uploadimage",
        init: function () {

            // Hack: Add the dropzone class to the element
            $(this.element).addClass("dropzone");

            this.on("success", function (file, serverFileName) {
                fileList[i] = {
                    "serverFileName": serverFileName,
                    "fileName": file.name,
                    "fileId": i
                };
                $('.dz-message').show();
                i += 1;
            });
            this.on("removedfile", function (file) {
             var name = file.previewElement.querySelector('[data-dz-name]').innerHTML;
             var rmvFile = "";
             for (var f = 0; f < fileList.length; f++) {
                if (fileList[f].fileName == file.name) {

                    $.ajax({
                        url: "http://marketplace-kombas.com/Ajax/deleteimage/"+name, //your php file path to remove specified image
                        type: "POST",
                        data: {
                            filenamenew: rmvFile,
                            type: 'delete',
                        },
                    });
                }
            }


        });
        },
        renameFilename: function (filename) {
            return 'PRODUCTADD_'+ $('#id_user').val() + '_' + filename;
        }
       // renameFilename: function (file) {
       //      return file.renameFilename ="YourNewfileName." + file.split('.').pop();
       //  } 
   });



    // // File limitations
    // $("#dropzone_file_limits").dropzone({
    //     paramName: "file", // The name that will be used to transfer the file
    //     dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
    //     maxFilesize: 0.4, // MB
    //     maxFiles: 4,
    //     maxThumbnailFilesize: 1,
    //     addRemoveLinks: true
    // });
    
});
