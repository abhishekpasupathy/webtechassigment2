$(function () {
  const $form = $("#registrationForm");

  function showError($field, message) {
    $field.closest(".field").addClass("invalid").find(".error-message").text(message);
  }

  function clearError($field) {
    $field.closest(".field").removeClass("invalid").find(".error-message").text("");
  }

  function validateForm() {
    let valid = true;
    const requiredFields = ["#fullName", "#email", "#phone", "#dob", "#gender", "#course", "#year", "#address"];

    requiredFields.forEach(function (selector) {
      const $field = $(selector);
      const value = String($field.val() || "").trim();
      clearError($field);

      if (!value) {
        showError($field, "This field is required.");
        valid = false;
      }
    });

    const email = $("#email").val().trim();
    if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError($("#email"), "Please enter a valid email address.");
      valid = false;
    }

    const phone = $("#phone").val().trim();
    if (phone && !/^\+?[0-9\s()-]{7,18}$/.test(phone)) {
      showError($("#phone"), "Please enter a valid phone number.");
      valid = false;
    }

    const dob = $("#dob").val();
    if (dob && new Date(dob) > new Date()) {
      showError($("#dob"), "Date of birth cannot be in the future.");
      valid = false;
    }

    if (!$("#consent").is(":checked")) {
      $(".consent-error").text("Please confirm that your information is accurate.");
      valid = false;
    } else {
      $(".consent-error").text("");
    }

    return valid;
  }

  $form.on("input change", "input, select, textarea", function () {
    clearError($(this));
    if (this.id === "consent") $(".consent-error").text("");
  });

  $form.on("submit", function (event) {
    event.preventDefault();

    if (!validateForm()) {
      const $firstError = $(".field.invalid").first();
      if ($firstError.length) {
        $("html, body").animate({ scrollTop: $firstError.offset().top - 100 }, 250);
        $firstError.find("input,select,textarea").trigger("focus");
      }
      return;
    }

    const details = [
      ["Full name", $("#fullName").val().trim()],
      ["Email address", $("#email").val().trim()],
      ["Phone number", $("#phone").val().trim()],
      ["Date of birth", $("#dob").val()],
      ["Gender", $("#gender").val()],
      ["Course / programme", $("#course").val()],
      ["Year of study", $("#year").val()],
      ["Address", $("#address").val().trim()]
    ];

    const applicationId = "RV-" + Date.now().toString().slice(-8);
    $("#applicationId").text(applicationId);
    $("#resultDetails").empty();

    details.forEach(function (item) {
      const wide = item[0] === "Address" ? " wide" : "";
      const $item = $("<div>").addClass("detail-item" + wide);
      $("<span>").addClass("detail-label").text(item[0]).appendTo($item);
      $("<span>").addClass("detail-value").text(item[1]).appendTo($item);
      $("#resultDetails").append($item);
    });

    $("#successPanel").prop("hidden", false);
    $form.closest(".form-card").fadeOut(180);
    $("#successPanel").hide().fadeIn(250);
    $("html, body").animate({ scrollTop: $("#successPanel").offset().top - 35 }, 350);
  });

  $("#printButton").on("click", function () {
    window.print();
  });

  $("#newButton").on("click", function () {
    $form[0].reset();
    $(".field").removeClass("invalid");
    $(".error-message,.consent-error").text("");
    $("#successPanel").fadeOut(150);
    $(".form-card").fadeIn(200);
    $("html, body").animate({ scrollTop: $(".form-card").offset().top - 25 }, 300);
  });
});