$(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});
function dropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }
  $(".clasificacion").find("input").change(function(){
    var valor = $(this).val()
    $(".clasificacion").find("input").removeClass("activo")
    $(".clasificacion").find("input").each(function(index){
       if(index+1<=valor){
        $(this).addClass("activo")
       }
       
    })
  })
  
  $(".clasificacion").find("label").mouseover(function(){
    var valor = $(this).prev("input").val()
    $(".clasificacion").find("input").removeClass("activo")
    $(".clasificacion").find("input").each(function(index){
       if(index+1<=valor){
        $(this).addClass("activo")
       }
       
    })
  })
  lidi.create({
  status : 1, // OPTIONAL DEFAULT STATUS, 1 LIKE -1 DISLIKE
  hWrap : document.getElementById("demoA"),
  onChange : (status) => {
      // SEND THE NEW STATUS TO UPDATE YOUR SERVER
      var data = new FormData();
      data.append("status", status);
      fetch("1-dummy.txt", { method: "POST", body: data })
      .then(res => res.text())
      .then((txt) => { console.log(txt); })
      .catch((err) => { console.error(err); });
  }
  });


function mostrarPassword(){
        var cambio = document.getElementById("txtPassword");
        var cambio1 = document.getElementById("txtPassword1");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
        if(cambio1.type == "password"){
            cambio1.type = "text";
            $('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio1.type = "password";
            $('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    } 
    
    $(document).ready(function () {
    //CheckBox mostrar contrasenya
    $('#ShowPassword').click(function () {
        $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
    });
});
function mostrarPassword1(){
        var cambio = document.getElementById("txtPassword1");
        if(cambio.type == "password"){
            cambio.type = "text";
            $('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        }else{
            cambio.type = "password";
            $('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
} 

$(document).ready(function () {
//CheckBox mostrar contrasenya
$('#ShowPassword').click(function () {
    $('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
});
});


  
$('.login-reg-panel input[type="radio"]').on('change', function() {
    if($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut(); 
        $('.login-info-box').fadeIn();
        
        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');
        
    }
    else if($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();
        
        $('.white-panel').removeClass('right-log');
        
        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});