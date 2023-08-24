$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // initDelete();
});

function initDelete() {
    if ($(".action-delete")) {
        $(".action-delete").on("click", function() {
            // alert("yes");
            var currentUrl = window.location.origin;
            var currentURL = currentUrl + "/admin/";
            const _self = $(this);
            const mod = $(this).data("module");
            const id = $(this).data("id");
            const deleteDialog = new duDialog(
                null,
                "Are you sure want to delete this item?", {
                    buttons: duDialog.OK_CANCEL,
                    yesText: "Delete",
                    noText: "Cancel",
                    callbacks: {
                        okClick: function() {
                            this.setLoading(true, true); // set loading to `true`, and cancellable to `true`
                            // peform delete
                            $.ajax({
                                url: currentURL + "delete-item",
                                type: "DELETE",
                                data: {
                                    id: id,
                                    object: mod,
                                },
                                success: function(result) {
                                    deleteDialog.hide();
                                    if (result.status) {
                                        if (_self.closest("tr").length > 0) {
                                            _self.closest("tr").fadeOut();
                                        }
                                        successShow(result.message);
                                    } else {
                                        errorShow(result.message);
                                    }
                                },
                                error: function(error) {
                                    deleteDialog.hide();
                                    errorShow(error.responseJSON.message);
                                },
                            });
                        },
                    },
                }
            );
        });
    }
}


function successShow(message) {
    // Display a success toast, with a title
    toastr.success(message);
}

function errorShow(message) {
    // Display a success toast, with a title
    toastr.error(message);
}