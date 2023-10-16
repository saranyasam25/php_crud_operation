// get user function

function getUsers() {
  var pageno = $("#currentpage").val();
  $.ajax({
    url: "/PHP_advance_curd_operation/ajax.php",
    type: "GET",
    datatype: "json",
    data: { page: pageno, action: "getallusers" },
    beforeSend: function () {
      console.log("wait...Data");
    },
    success: function (response) {
      var data = JSON.parse(response);
      console.log(data);
      var players = data.players;
      if (players) {
        var userlist = "";
        $.each(players, function (index, user) {
          userlist += getuserrow(user);
        });
        $("#usertable tbody").html(userlist);
        var totaluser = data.count;
        var totalpages = Math.ceil(parseInt(totaluser) / 4);
        const curpages = $("#currentpage").val();
        pagination(totalpages, curpages);
      }
    },
    error: function (request, error) {
      console.log(arguments);
      console.log("Error" + error);
    },
  });
}

// function to get users from database

function getuserrow(user) {
  var userRow = "";
  if (user) {
    userRow += `<tr>
          <td scope="row"><img src="./uploads/${user.photo}" style=" width: 100px;height: 100px;"></td>
          <td>${user.name}</td>
          <td>${user.email}</td>
          <td>${user.mobile}</td>
          <td>
              <a href="#" class="me-3 profile" data-id=${user.id} data-bs-target="#userViewModal" data-bs-toggle="modal" title="view profile"><i class="fa-solid fa-eye"></i></a>
              <a href="#" class="me-3 editUser" data-id=${user.id} data-bs-target="#usermodal" data-bs-toggle="modal" title="edit"><i class="fa-solid fa-pen-to-square"></i></a>
              <a href="#" class="me-3 deleteuser" data-id=${user.id} title="delete"><i class="fa-solid fa-trash"></i></a>
          </td>
      </tr>`;
  }
  return userRow;
}

// function for pagenation

function pagination(totalpages, currentpages) {
  var pagelist = "";
  if (totalpages > 1) {
    currentpages = parseInt(currentpages);
    pagelist += `<ul class="pagination justify-content-center">`;
    const previousClass = currentpages == 1 ? "disabled" : "";
    pagelist += `<li class="page-item ${previousClass}"><a class="page-link" href="#" data-page="${
      currentpages - 1
    }">Previous</a></li>`;
    for (let p = 1; p <= totalpages; p++) {
      const activeClass = currentpages == p ? "active" : "";
      pagelist += `<li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${p}">${p}</a></li>`;
    }
    const nextClass = currentpages == totalpages ? "disabled" : "";
    pagelist += `<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page="${
      currentpages + 1
    }">Next</a></li>`;
    pagelist += `</ul>`;
  }
  $("#pagination").html(pagelist);
}

// loading  document
$(document).ready(function () {
  toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: true,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
  };

  // ======================================================== validation=======================================================
  $("#addform").validate({
    errorElement: "span",
    errorPlacement: function (error, element) {
      error.insertAfter(element.closest(".input-group"));
    },

    rules: {
      // input fields
      username: {
        required: true,
      },
      email: {
        required: true,
      },
      mobile: {
        required: true,
      },
    },
    // input fields error mesaages
    messages: {
      username: {
        required: "Username is required.",
      },
      email: {
        required: "email is requried.",
      },
      mobile: {
        required: "mobile number is required",
      },
    },
    highlight: function (element) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
      $(element).removeClass("is-invalid");
    },
  });

  // adding user
  $(document).on("submit", "#addform", function (e) {
    e.preventDefault();
    if (!$("#addform").valid()) {
      return;
    }
    var msg =
      $("#userId").val().length > 0
        ? "user has been updated successfully!"
        : "New user has been added successfully";
    // ajax
    $.ajax({
      url: "/PHP_advance_curd_operation/ajax.php",
      type: "post",
      dataType: "json",
      data: new FormData(this),
      processData: false,
      contentType: false,
      beforeSend: function () {
        console.log("wait...Data is loading");
      },
      success: function (response) {
        console.log(response);

        if (response) {
          $("#usermodal").modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
          $("#addform")[0].reset();
          $(".displaymessage").html(msg).fadeIn().delay(2500).fadeOut();
          getUsers();
        }
      },
      error: function (request, error) {
        console.log(arguments);
        console.log("Error" + error);
      },
    });
  });

  // click event function for pagination
  $(document).on("click", "ul.pagination li a", function (e) {
    e.preventDefault();
    const pageNum = $(this).data("page");
    $("#currentpage").val(pageNum);
    getUsers();
    $(this).parent().siblings().removeClass("active");
    $(this).parent().addclass("active");
  });

  // onclick event for editing
  $(document).on("click", "a.editUser", function (e) {
    e.preventDefault();
    var userId = $(this).data("id");
    $.ajax({
      url: "/PHP_advance_curd_operation/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: userId, action: "editusersdata" },
      beforeSend: function () {
        console.log("wait...Data is loading");
      },
      success: function (response) {
        console.log(response);
        if (response) {
          $("#username").val(response.name);
          $("#email").val(response.email);
          $("#mobile").val(response.mobile);
          $("#userphoto").attr("src", './uploads/'+ response.photo);
          $("#userId").val(response.id);
        }
      },
      error: function (request, error) {
        console.log(arguments);
        console.log("Error" + error);
      },
    });
  });

  $(document).on("change", "#userphoto", function () {
    var file = $(this).prop("files")[0];
    var reader = new FileReader();

    reader.onload = function (event) {
      $("#image-preview").html(
        '<img src="' + event.target.result + '" alt="Preview">'
      );
    };

    reader.readAsDataURL(file);
  });

  // Onclick for adding user btn
  $("#adduserbtn").on("click", function () {
    $("#addform")[0].reset();
    $("#userId").val("");
  });

  // Onclick event for deleting
  $(document).on("click", "a.deleteuser", function (e) {
    e.preventDefault();
    var userId = $(this).data("id");
    if (confirm("Are You sure you want to delete this user?")) {
      $.ajax({
        url: "/PHP_advance_curd_operation/ajax.php",
        type: "GET",
        dataType: "json",
        data: { id: userId, action: "deleteuser" },
        beforeSend: function () {
          console.log("wait...Data is loading");
        },
        success: function (response) {
          console.log(response.delete == 1);
          if (response.delete == 1) {
            $(".displaymessage")
              .html("user deleted successfully")
              .fadeIn()
              .delay(2500)
              .fadeOut();
            getUsers();
          }
        },
        error: function (request, error) {
          console.log(arguments);
          console.log("Error" + error);
        },
      });
    }
  });

  // profile view
  $(document).on("click", "a.profile", function () {
    var userId = $(this).data("id");
    $.ajax({
      url: "/PHP_advance_curd_operation/ajax.php",
      type: "GET",
      dataType: "json",
      data: { id: userId, action: "editusersdata" },
      success: function (user) {
        if (user) {
          // console.log(user);
          // return;
          const profile = `<div class="row">
              <div class="col-sm-6 col-md-4">
                  <img src="uploads/${user.photo}" alt="images" class="pictures style=" width: 100px;height: 100px;">
              </div>
              <div class="col-sm-6 col-md-8">
                  <h4 class="text-primary">${user.name}</h4>
                  <p>
                  <i class="fa-solid fa-envelope py-1"></i> ${user.email}
                  <br>
                  <i class="fa-solid fa-phone py-1 "></i> ${user.mobile}
                  </p>
              </div>
          </div>`;
          $("#profile").html(profile);
        }
      },
      error: function (request, error) {
        console.log(arguments);
        console.log("Error" + error);
      },
    });
  });

  // search function
  $(document).on("keyup", "#searchinput", function () {
    const searchText = $(this).val();
    if (searchText.length > 1) {
      $.ajax({
        url: "/PHP_advance_curd_operation/ajax.php",
        type: "GET",
        dataType: "json",
        data: { searchQuery: searchText, action: "searchuser" },
        success: function (response) {
          if (response) {
            var userslist = "";
            $.each(response, function (index, user) {
              userslist += getuserrow(user);
            });
            $("#usertable tbody").html(userslist);
            $("#pagination").hide();
          }
        },
        error: function () {
          console.log("error");
        },
      });
    } else {
      getUsers();
      $("#pagination").show();
    }
  });

  // clear function
  $(document).on("click", ".close-btn", function (e) {
    e.preventDefault();
    $('input[type="text"]').val("");
    $(".error").text("");
    $(".form-control").removeClass("is-invalid");
  });

  $(document).on("click", ".btn-close", function () {
    $('.close-btn').trigger('click');
  })
  getUsers();
});
