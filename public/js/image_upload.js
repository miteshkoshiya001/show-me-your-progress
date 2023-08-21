function handleImageUpload(url) {
    $(document).ready(function () {
        var crop = null; // Initialize a variable to store the Cropme instance
        // Show the Crop Modal immediately when the image is selected
        $("#image").change(function () {
            var selectedImage = this.files[0];
            if (selectedImage) {
                if (crop) {
                    crop.cropme("destroy");
                    if ($("#cropme-image").length === 0) {
                        $(".modal-body").prepend('<img src="" id="cropme-image">');
                    }
                    crop = null; // Reset the crop variable
                }
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#cropme-image").attr("src", e.target.result);
                    $("#cropme-image").on("load", function () {
                        $("#cropModal").modal("show"); // Show the modal
                    });
                };
                reader.readAsDataURL(selectedImage);
            }
        });

        // Initialize Cropme when the modal is shown for the first time
        $("#cropModal").on("shown.bs.modal", function () {
            if (!crop) {
                crop = $("#cropme-image").cropme({
                    container: {
                        width: "100%",
                        height: 400,
                    },
                    viewport: {
                        width: 200,
                        height: 200,
                        type: "circle",
                        border: {
                            width: 2,
                            enable: true,
                            color: "#fff",
                        },
                    },
                    zoom: {
                        enable: true,
                        mouseWheel: true,
                        slider: true,
                    },
                    rotation: {
                        slider: true,
                        enable: true,
                        position: "left",
                    },
                    transformOrigin: "viewport",
                });
            }
        });


        $("#cropImage").click(function () {
            if (crop) {
                crop.cropme("crop", {
                    type: "base64",
                    width: 800,
                }).then(function (output) {
                    showLoader();
                    // Use the correct field name "image"
                    selectedOption = $("#template-dropdown option:selected");

                    var selectedImage = $(".sticker-template-img");
                    var selectedDriverId = selectedImage.data('driver-id');
                    var formData = new FormData();
                    formData.append("image", output);
                    formData.append('driver_id', parseInt(selectedDriverId));



                    $.ajax({
                        type: "POST",
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData, // Use the updated formData
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            var imageContainer = $("#processed-image-container");
                            imageContainer.empty(); // Clear previous content

                            $("#downloadAllButton").show();
                            $("#goToProfileButton").hide();
                            var imageRow = $('<div>')
                                .addClass('row');

                            $.each(response.processedImages, function (index, image) {
                                var imageDiv = $('<div>')
                                    .addClass('col-lg-4 col-md-3 col-sm-4 col-6 d-flex align-items-center pt-2');

                                var processedImageWithoutWatermark = $('<img>')
                                    .attr('src', image.processedImageURL)
                                    .attr('alt', 'Processed Image without Watermark')
                                    .addClass('img-fluid processed-image'); // Add the class

                                imageDiv.append(processedImageWithoutWatermark);
                                imageRow.append(imageDiv);
                            });


                            imageContainer.append(imageRow);


                            $("#cropModal").modal("hide");
                        },


                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        },
                        complete: function () {
                            hideLoader();
                            $("button[type='submit']").prop("disabled", false);
                        },
                    });
                });
            }
        });

    });
}
$(document).ready(function () {
    $("#downloadAllButton").on("click", function () {
        var imagesToDownload = $(".processed-image");

        imagesToDownload.each(function (index, image) {
            var imageUrl = $(image).attr("src");
            var imageName = imageUrl.split('/').pop();
            var downloadLink = document.createElement("a");
            downloadLink.href = imageUrl;
            downloadLink.download = imageName;
            downloadLink.style.display = "none";
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        });
    });
});
