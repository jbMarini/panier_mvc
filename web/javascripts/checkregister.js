$(document).ready(function () {
// Validation du formulaire
    $("#registerForm").validate({
        rules: {
            registerAgree: "required"
        },
        messages: {
            registerAgree: "Veuillez accepter nos conditions d'utilisation",
        }
    });

  // vérifier si le nom d'utilisateur est libre et ok
  $("#registerLogin").keyup(function () {
    if($(this).val().length !=0){
      if($(this).val().length < 4){
        $("#registerLogin").removeClass("is-valid");
        $("#registerLogin").addClass("is-invalid");
        $("small#output_registerLogin").show();
        $("#output_registerLogin").css("color", "red").html("le login doit contenir au moins 4 caractères");
      }
      else{
        checkLogin();
        checkForm();
      }
    }
  });
  
  function checkLogin() {
    $.ajax({
      type: "post",
      data: {
        login_check: $("#registerLogin").val(),
      },
      url: "check-register",
      success: function (data) {
        if (data == "success") {
          $("#registerLogin").removeClass("is-invalid");
          $("#registerLogin").addClass("is-valid");
          $("small#output_registerLogin").hide();
        } else {
          $("#registerLogin").removeClass("is-valid");
          $("#registerLogin").addClass("is-invalid");
          $("small#output_registerLogin").show();
          $("#output_registerLogin").css("color", "red").html(data);
        }
      },
    });
  }
  // vérifier si le mail est libre et ok
  $("#registerMail").keyup(function () {
    checkMail();
    checkForm();
  });
  function checkMail() {
    $.ajax({
      type: "post",
      data: {
        mail_check: $("#registerMail").val(),
      },
      url: "/check-register",
      success: function (data) {
        if (data == "success") {
          $("#registerMail").removeClass("is-invalid");
          $("#registerMail").addClass("is-valid");
          $("small#output_registerMail").hide();
        } else {
          $("#registerMail").removeClass("is-valid");
          $("#registerMail").addClass("is-invalid");
          $("small#output_registerMail").show();
          $("#output_registerMail").css("color", "red").html(data);
        }
      },
    });
  }
  //On vérifie si les mots de passe sont identiques
  $("#registerPwd").keyup(function () {
    //vérification du mdp
    if($(this).val().length != 0){
      if($(this).val().match(/^(.{0,7}|[^0-9]*|[^A-Z]*|[^a-z]*)$/)){
        $("#output_registerPwd").css("color", "red").html("Le mot de passe doit contenir au minimum 8 caractères dont 1 lettre miniscule, 1 lettre majuscule et 1 chiffre");
        $("small#output_registerPwd").show();
        $("#registerPwd").removeClass("is-valid");
        $("#registerPwd").addClass("is-invalid");
      }else{
        if($("#registerChkPwd").val() != ''){
          if($("#registerChkPwd").val() == $("#registerPwd").val()){
            $("#registerPwd").removeClass("is-invalid");
            $("#registerPwd").addClass("is-valid");
            $("small#output_registerPwd").hide();
          }else{
            $("small#output_registerPwd").show();
            $("#output_registerPwd").css("color", "red").html("Les mots de passe ne sont pas identiques");
            $("#registerPwd").removeClass("is-valid");
            $("#registerPwd").addClass("is-invalid");
          }
        }else{
          $("#registerPwd").removeClass("is-invalid");
          $("#registerPwd").addClass("is-valid");
          $("small#output_registerPwd").hide();
        }
      }
    }
    checkForm();
  });
  // vérification second mdp
  $("#registerChkPwd").keyup(function () {
    //On vérifie si les mots de passe coïncident
    if($("#registerPwd").val() != '' && $("#registerPwd").val() == $("#registerChkPwd").val()){
      $("#registerChkPwd").removeClass("is-invalid");
      $("#registerChkPwd").addClass("is-valid");
      $("small#output_registerChkPwd").hide();
    }else{
      $("small#output_registerChkPwd").show();
      $("#output_registerChkPwd").css("color", "red").html("Les mots de passe ne sont pas identiques");
      $("#registerChkPwd").removeClass("is-valid");
      $("#registerChkPwd").addClass("is-invalid");
    }
    checkForm();
  });

  // vérif de tout le formulaire
  function checkForm() {
    if (
      $("#registerLogin").hasClass("is-valid") == true &&
      $("#registerMail").hasClass("is-valid") == true &&
      $("#registerPwd").hasClass("is-valid") == true &&
      $("#registerChkPwd").hasClass("is-valid") == true
    ) {
      $("#status")
        .css("color", "green")
        .html("Vous pouvez envoyer votre formulaire");
      $("#registerSubmit").attr("disabled", false);
    } else {
      $("#status")
        .css("color", "red")
        .html("Veuillez remplir tous les champs avant d’envoyer le formulaire");
      $("#registerSubmit").attr("disabled", true);
    }
  }
});
