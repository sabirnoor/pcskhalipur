$(function () {
	 
	$(document).on("input", ".numeric", function () {
        this.value = this.value.replace(/\D/g, '');
    });

    $(document).on("input", ".decimal", function () {
        this.value = this.value.replace(/[^0-9.]/g, '');
    });

    $(document).on("input", ".time", function () {
        this.value = this.value.replace(/[^0-9:aApPmM ]/g, '');
    });

    $(document).on("input", ".alpha", function () {
        this.value = this.value.replace(/[^A-Za-z ]/g, '');
    });

    $(document).on("input", ".alpha-nospace", function () {
        this.value = this.value.replace(/[^A-Za-z]/g, '');
    });

    $(document).on("input", ".alphanumeric", function () {
        this.value = this.value.replace(/[^0-9A-Za-z ]/g, '');
    });

    $(document).on("input", ".alphanumeric-nospace", function () {
        this.value = this.value.replace(/[^0-9A-Za-z]/g, '');
    });

    $(document).on("input", ".email", function () {
        this.value = this.value.replace(/[^0-9A-Za-z._@]/g, '');
    });
      
    $(document).on("input", ".address", function () {
        this.value = this.value.replace(/[^0-9A-Za-z -/,]/g, '');
    });
	
	$(document).on("input", ".date_with_dash", function () {
        this.value = this.value.replace(/[^0-9-]/g, '');
    });
	$(document).on("input", ".date_with_slash", function () {
        this.value = this.value.replace(/[^0-9/]/g, '');
    });
	
	
});