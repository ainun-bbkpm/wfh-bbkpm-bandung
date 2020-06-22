//Enable Disabled Edit Alalamt
document.getElementById("edit_alamat").onchange = function () {
  document.getElementById("propinsi").disabled = !this.checked;
  document.getElementById("kab_kota").disabled = !this.checked;
  document.getElementById("kec").disabled = !this.checked;
  document.getElementById("kel").disabled = !this.checked;
  document.getElementById("alamat").disabled = !this.checked;
  if (!this.checked) {
    $("#propinsi2").fadeIn("slow");
    $("#kab_kota2").fadeIn("slow");
    $("#kec2").fadeIn("slow");
    $("#kel2").fadeIn("slow");
  } else {
    $("#propinsi2").fadeOut("slow");
    $("#kab_kota2").fadeOut("slow");
    $("#kec2").fadeOut("slow");
    $("#kel2").fadeOut("slow");
  }
};

var settings = {
  url: "http://localhost/wfh/alamat/getProp",
  method: "GET",
  timeout: 0,
};

$.ajax(settings).done(function (response) {
  // console.log(response);
  $("#propinsi").select2({
    data: response,
    theme: "bootstrap4",
  });
});

function getKabKota(e) {
  var id_prop = e.options[e.selectedIndex].value;
  $("option:selected").removeAttr("selected");
  $("#kab_kota").select2({
    theme: "bootstrap4",
  });

  $.ajax({
    url: "http://localhost/wfh/alamat/getKab",
    method: "POST",
    data: { idpropinsi: id_prop },

    success: function (res) {
      $("#kab_kota").empty();

      select = document.getElementById("kab_kota");

      $.each(res, function (index, value) {
        var opt = document.createElement("option");
        opt.value = value.id;
        opt.innerHTML = value.text;
        select.appendChild(opt);
      });
    },

    error: function (err) {
      console.log(err);
    },
  });
}

function getKec(e) {
  var idkabupaten = e.options[e.selectedIndex].value;
  $("#kec").select2({
    theme: "bootstrap4",
  });

  $.ajax({
    url: "http://localhost/wfh/alamat/getKec",
    method: "POST",
    data: { idkabupaten: idkabupaten },

    success: function (res) {
      $("#kec").empty();

      select = document.getElementById("kec");
      $.each(res, function (index, value) {
        var opt = document.createElement("option");
        opt.value = value.id;
        opt.innerHTML = value.text;
        select.appendChild(opt);
      });
    },

    error: function (err) {
      console.log(err);
    },
  });
}
function getKel(e) {
  var idkecamatan = e.options[e.selectedIndex].value;
  $("#kel").select2({
    theme: "bootstrap4",
  });

  $.ajax({
    url: "http://localhost/wfh/alamat/getKel",
    method: "POST",
    data: { idkecamatan: idkecamatan },

    success: function (res) {
      $("#kel").empty();

      select = document.getElementById("kel");
      $.each(res, function (index, value) {
        var opt = document.createElement("option");
        opt.value = value.id;
        opt.innerHTML = value.text;
        select.appendChild(opt);
      });
    },

    error: function (err) {
      console.log(err);
    },
  });
}
