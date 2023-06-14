//review ========================= set-slot.blade.php ================================
$(document).ready(function () {
    $("#disable_check").change(function () {
        if (this.checked) {
            console.log("Checkbox is checked");
            $("#input_appSlot").hide();
        } else {
            console.log("Checkbox is unchecked");
            $("#input_appSlot").show();
        }
    });

    $("#delete_check").change(function () {
        if (this.checked) {
            $("#delete_slot_div").show();
            $("#set_slot_div").hide();
            $("#delete_slot").show();
            $("#edit_slot").hide();
            $("#edit_check").prop("checked", false);
        } else {
            $("#delete_slot_div").hide();
            $("#delete_slot").hide();
        }
    });
    $("#edit_check").change(function () {
        if (this.checked) {
            $("#set_slot_div").show();
            $("#delete_slot_div").hide();
            $("#edit_slot").show();
            $("#delete_slot").hide();
            $("#hr_insert").show();
            $("#delete_check").prop("checked", false);
        } else {
            $("#set_slot_div").hide();
            $("#edit_slot").hide();
            $("#hr_insert").hide();
        }
    });
});
