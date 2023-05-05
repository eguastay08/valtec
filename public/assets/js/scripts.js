// script as-template 

$(document).ready(function () {

    console.log('Listo');

    // alertify.set('notifier','position', 'bottom-left');
    // alertify.success('Current position : ' + alertify.get('notifier','position'));

    function getRandomInt(t) {
        return Math.floor(Math.random() * t)
    }

    // Menú Sticky
    if($(document).scrollTop() >= 2)
    {
        document.querySelector('header').classList.toggle('as-sticky-header', window.scrollY > 0);
        $('.as-main').css('margin-top','40px');
        // $('.as-main').css('--sticky-margin-top','30px');
    }
    
    window.addEventListener("scroll", function() {
        let  as_header = document.querySelector('header');
        as_header.classList.toggle('as-sticky-header', window.scrollY > 0);
       if( window.scrollY > 0)
       {
        $('.as-main').css('margin-top','40px');
       }
       else 
       {
        $('.as-main').css('margin-top','0');
       }
    });

    // Fin Menú Sticky

    // Boton Arriba

    $('.ir-arriba').click(function() {
        $('body, html').animate({
            scrollTop:'0px'
        }, 100)
    });

    $(window).scroll(function(){
		if( $(this).scrollTop() > 10 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});

    // Fin Boton Arriba

    $( ".as-menu-lvl1").click(function() {
        let dataUrlMenu = $(this).attr("data-url");
        let titleMenu = $(this).attr("data-title");
        const url=$('meta[name=app-url]').attr("content") + "/getMenus";
        $.ajax({
            headers: 
            {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method:'GET',
            data: {url: dataUrlMenu }
        }).done(function (data) {
            let htmlstring = '';
            document.getElementById("as-sidenav-content").style.animation = "mainAway 0.3s forwards";
            document.getElementById("as-sidenav-content-sub").style.animation = "subBack 0.3s forwards";
            $('#as-submenu-title').html(titleMenu);
            data.forEach(function(menu, index) {
               let raiz = $('meta[name=app-url]').attr("content");
                htmlstring += '<li class="nav-item">' +
                '<a href="'+raiz +'/'+menu.link+'" class="nav-link as-menu_lv2 as-menu-link-lvl2-sty as-menu-links-lvl2-style px-3" title="'+ menu.nombre +'">'+
                '<span>'+ menu.nombre +'</span>' +
                '</a>'+
                '</li>';
              });
              $('#as-nav__ul').html(htmlstring);
        }).fail(function () {
            console.log("Error al cargar los datos");
        });
    });

     home_slider();
     noticia_slider();
     popup_Slider();

     categories_level();

    // Mostrar filtros
    $('#btnFilters').click(function() {
        // $('#filter-params').css('display','block');
        let collapse = $(this).attr("collapse");
        if(collapse == "false")
        {
            // $('#filter-params').addClass("collapse-filter");
            $('#filter-params').show(500);
            $(this).attr("collapse", "true");
        }
        else 
        {
            // $('#filter-params').removeClass("collapse-filter");
            $('#filter-params').hide(500);
            $(this).attr("collapse", "false");
        }
    });

    //Mostrar Filtros Noticias
    $('#btnFiltrosNoticia').click(function(){
            let collapsenoticias = $(this).attr("collapse");
            if(collapsenoticias == "false")
            {
                // $('#filter-params').addClass("collapse-filter");
                $('#noticia_filters').show(500);
                $(this).attr("collapse", "true");
            }
            else 
            {
                // $('#noticia_filters').removeClass("collapse-filter");
                $('#noticia_filters').hide(500);
                $(this).attr("collapse", "false");
            }
    });

    function cnt_incre(){
		$(document).on("click", '.btncntd', function() {
			let ctndField = $(this).parent().parent(".qntgroup");
			let val_actual = $(ctndField).find(".cntdvl").val();
			let newvalue = 1;
			if ($(this).is(".b-plus")) {
				newvalue = parseInt(val_actual) + 1;
			} else if (val_actual > 1) {
				newvalue = parseInt(val_actual) - 1;
			}
			$(ctndField).find(".cntdvl").val(newvalue);
		});
	}

	cnt_incre();

    $('.header-search').on('keyup', function(e)
    {
        let value = this.value;
        url=$('meta[name=app-url]').attr("content") + "/productos/search";
        if(value.length >= 3)
        {
            $.ajax({
                url: url,
                method:'GET',
                data: {producto: value}
            }).done(function (data) {
                $('.productos-search').html(data);
                $('#products-list').css("display","block");
            }).fail(function () {
                console.log("Error al cargar los datos");
            });
        }
        else 
        {
            $('.productos-search').html('');
            $('#products-list').css("display","block");
        }

       
    });

    $(document).mouseup(function(e)
    {
        const dvProductList = $("#products-list");
        const txtinputProduct = $('.header-search');
        if (!dvProductList.is(e.target) && dvProductList.has(e.target).length === 0 &&  !txtinputProduct.is(e.target) && txtinputProduct.has(e.target).length === 0)
        {
            dvProductList.hide ();
        }
    });

});

$(".header-search").focus(function(){
    $('#products-list').css("display","block");
});

function home_slider(){
    $('.slider-main').slick({
       dots: false,
       infinite: true,
       slidesToShow: 1,
       slidesToScroll: 1,
       fade: true,
       arrows: true,
       autoplay: true,
       autoplaySpeed: 4000,
       lazyLoad: 'ondemand'
     });
 }

 function noticia_slider()
 {
    $('.noticia-slider').slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 4000,
        lazyLoad: 'ondemand'
      });
 }

 function popup_Slider()
 {
    $('.popup_slider').slick({
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 20000,
        lazyLoad: 'ondemand'
    });
 }

function openNav()
{
    document.getElementById("as-sidebar-main").style.animation = "expand 0.3s forwards";
    // overlay
    document.getElementById("overlay").style.display="block";
    document.getElementById("overlay").style.animation = "show 0.3s";
}

function closeNav()
{
    document.getElementById("as-sidebar-main").style.animation = "collapse 0.3s forwards";

    document.getElementById("overlay").style.animation = "hide 0.3s";
    setTimeout(() => {
   
    document.getElementById("overlay").style.display="none";
    // reset Menus
    document.getElementById("as-sidenav-content").style.animation = "";
    document.getElementById("as-sidenav-content").style.transform = "translateX(0px)";
    document.getElementById("as-sidenav-content-sub").style.animation = "";
    document.getElementById("as-sidenav-content-sub").style.transform = "translateX(360px)";
    }, 300);
}

// const dropmainmenu = document.querySelectorAll(".as-menu-drop");
// if(dropmainmenu)
// {
//     dropmainmenu.forEach(row => {
//         row.addEventListener("click", () => {
//             document.getElementById("as-sidenav-content").style.animation = "mainAway 0.3s forwards";
//             document.getElementById("as-sidenav-content-sub").style.animation = "subBack 0.3s forwards";
//         })
//     });
// } 

document.getElementById("as-submenu").addEventListener("click", () => {
    document.getElementById("as-sidenav-content").style.animation = "mainBack 0.3s forwards";
    document.getElementById("as-sidenav-content-sub").style.animation = "subPush 0.3s forwards";
});

function categories_level(){
    $(".as-categoria-tree-list li span .drop-arrow").on("click", function() {
        let desplegado = $(this).attr('desplegado');
        if(desplegado == 0 ? $(this).attr('desplegado',1): $(this).attr('desplegado',0));
        
        if(desplegado == 0)
        {
            $(this).find('.ct-hide').removeClass('hide');
            $(this).find('.ct-hide').addClass('show');
            $(this).find('.ct-show').addClass('hide');
        }
        else 
        {
            $(this).find('.ct-show').removeClass('hide');
            $(this).find('.ct-hide').removeClass('show');
            $(this).find('.ct-hide').addClass('hide');
        }
        // let iconshow = $(this).find('.ct-show');
        // if(iconshow)
        // {
        // 	iconshow.toggleClass('hide');
        // 	$(this).find('.ct-hide').removeClass('hide');
        // 	$(this).find('.ct-hide').addClass('show');
        // }
        // else 
        // {
        // 	$(this).find('.ct-hide').removeClass('show');
        // 	$(this).find('.ct-hide').addClass('hide');
        // 	iconshow.removeClass('hide').addClass('show');
        // }
        $(this).parent().parent().children('.sublinks').toggleClass('active-sublinks');
        return false;
     
        // $(this).next(".sublinks").slideToggle("slow");
    }); 
}

const prevBtns = document.querySelectorAll(".btn-prev");
const nextBtns = document.querySelectorAll(".btn-next");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");
let formStepsNum = 0;

nextBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
        if(formStepsNum == 0){
            if (isFormValid()) {         
            formStepsNum++;
            $('#lblnomapepago').html('&nbsp;&nbsp;'+$('#pagonombresapellidos').val());
            $('#lblinfo').html('&nbsp;&nbsp;'+$('#pagoinformacionadicional').val());
            $('#lblemail').html('&nbsp;&nbsp;'+$('#pagoemail').val());
            updateFormSteps();
            updateProgressbar();
            }
        }
        else if(formStepsNum == 1)
        {
          if(paymentIsChecked())
            {
                formStepsNum++;
                $('#lblPayment').html('&nbsp;&nbsp;'+$('input[name="payment"]:checked').attr("data-payment"));
                updateFormSteps();
                updateProgressbar();
            }
        }
    });
});

prevBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      formStepsNum--;
      updateFormSteps();
      updateProgressbar();
    });
  });

function isFormValid()
{
    // let not_errors = false; 
    let emailRegform = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

    if(($('#pagonombresapellidos').val() == '' || $('#pagoinformacionadicional').val() == '' || $('#pagoemail').val() == '' || $('#pagoemailverificar').val() == ''))
    {   
        if($('#pagonombresapellidos').val() == '')
        {  
        $("#error-nomapellido").text('Este Campo es Obligatorio');
        $("#pagonombresapellidos").removeClass("box_succes");
        $("#pagonombresapellidos").addClass("box_error");

        }
        else 
        {
            $("#error-nomapellido").text('');
            $("#pagonombresapellidos").removeClass("box_error");
            $("#pagonombresapellidos").addClass("box_succes");
     
        }

        if($('#pagoinformacionadicional').val() == '')
        {  
            $("#error-tele").text('Este Campo es Obligatorio');
            $("#pagoinformacionadicional").removeClass("box_succes");
            $("#pagoinformacionadicional").addClass("box_error");
        }
        else 
        {
            $("#error-tele").text('');
            $("#pagoinformacionadicional").removeClass("box_error");
            $("#pagoinformacionadicional").addClass("box_succes");
        }

        if($('#pagoemail').val() == '')
        {
            $("#error-email").text('Este Campo es Obligatorio');
            $("#pagoemail").removeClass("box_succes");
            $("#pagoemail").addClass("box_error");
    
        }
        else {
            $("#error-email").text('');
            $("#pagoemail").removeClass("box_error");
            $("#pagoemail").addClass("box_succes");
        }

        if($('#pagoemailverificar').val() == '')
        {
            $("#error-validateEmail").text('Este campo es obligatorio');
            $("#pagoemailverificar").removeClass("box_succes");
            $("#pagoemailverificar").addClass("box_error");
        }
        else 
        {       
            $("#error-validateEmail").text('Este campo es obligatorio');
            $("#pagoemailverificar").removeClass("box_error");
            $("#pagoemailverificar").addClass("box_succes");
        }
      
        return false;

    }

    if($('#pagoemail').val() != '' || $('#pagoemailverificar').val() != '')
    {
        if ($('#pagoemail').val() != "" && !emailRegform.test($('#pagoemail').val())) {
        
            $("#error-email").text('Porfavor Ingresar un formato de correo válido.');
            $("#pagoemail").removeClass("box_succes");
            $("#pagoemail").addClass("box_error");

            return false;
        } else {

            $("#error-email").text('');
            $("#pagoemail").removeClass("box_error");
            $("#pagoemail").addClass("box_succes");

        }

        if ($('#pagoemail').val() != $('#pagoemailverificar').val()) {

            $("#error-validateEmail").text('Los Correos no coinciden');
            $("#pagoemailverificar").removeClass("box_succes");
            $("#pagoemailverificar").addClass("box_error");
          return false;
        } else {

            $("#error-validateEmail").text('');
            $("#pagoemailverificar").removeClass("box_error");
            $("#pagoemailverificar").addClass("box_succes");
        }
    }
   

        return true;
    
    
  

//     if($('#pagonombresapellidos').val() == '')
//     {  
//         $("#error-nomapellido").text('Este Campo es Obligatorio');
//         $("#pagonombresapellidos").removeClass("box_succes");
//         $("#pagonombresapellidos").addClass("box_error");
//         return false;
//     }
//     else 
//     {
//         $("#error-nomapellido").text('');
//         $("#pagonombresapellidos").removeClass("box_error");
//         $("#pagonombresapellidos").addClass("box_succes");
//         // not_errors = true;
//     }

//    if($('#pagoinformacionadicional').val() == '')
//     {  
//         $("#error-tele").text('Este Campo es Obligatorio');
//         $("#pagoinformacionadicional").removeClass("box_succes");
//         $("#pagoinformacionadicional").addClass("box_error");
//       return false;
//     }
//     else 
//     {
//         $("#error-tele").text('');
//         $("#pagoinformacionadicional").removeClass("box_error");
//         $("#pagoinformacionadicional").addClass("box_succes");
//     }

//     if($('#pagoemail').val() == '')
//     {
//         $("#error-email").text('Este Campo es Obligatorio');
//         $("#pagoemail").removeClass("box_succes");
//         $("#pagoemail").addClass("box_error");
//       return false;
//     }
//     else 
//     {
//         if (!emailRegform.test($('#pagoemail').val())) {
//             $("#error-email").text('Porfavor Ingresar un formato de correo válido.');
//             $("#pagoemail").removeClass("box_succes");
//             $("#pagoemail").addClass("box_error");
//            return false;
//         } else {
//             $("#error-email").text('');
//             $("#pagoemail").removeClass("box_error");
//             $("#pagoemail").addClass("box_succes");
//         }
//     }

//     if ($('#pagoemailverificar').val() == '') {
//         $("#error-validateEmail").text('Este campo es obligatorio');
//         $("#pagoemailverificar").removeClass("box_succes");
//         $("#pagoemailverificar").addClass("box_error");
//         return false;
//     } 
//     else 
//     {
//         if ($('#pagoemail').val() != $('#pagoemailverificar').val()) {
//             $("#error-validateEmail").text('Los Correos no coinciden');
//             $("#pagoemailverificar").removeClass("box_succes");
//             $("#pagoemailverificar").addClass("box_error");
//            return false;
//         } else {
//             $("#error-validateEmail").text('');
//             $("#pagoemailverificar").removeClass("box_error");
//             $("#pagoemailverificar").addClass("box_succes");
         
//         }
//     }

//     return true;

}

function paymentIsChecked()
{
    if(!$('input[name=payment]').is(':checked'))
    {
        alertify.alert('<h4>Debe Seleccionar un Medio de Pago</h4>')
        .set('title', 'Importante').set('closable', true); 
        return false;
    }

    return true;
}

function updateFormSteps() {
    formSteps.forEach((formStep) => {
      formStep.classList.contains("form-step-active") &&
        formStep.classList.remove("form-step-active");
    });
  
    formSteps[formStepsNum].classList.add("form-step-active");
}


function updateProgressbar() {
    progressSteps.forEach((progressStep, idx) => {
        if (idx < formStepsNum + 1) {
        progressStep.classList.add("progress-step-active");
        } else {
        progressStep.classList.remove("progress-step-active");
        }
    });

    const progressActive = document.querySelectorAll(".progress-step-active");

    progress.style.width =
        ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}

$(document).on("click", '#TabMediopago .nav-link', function() {

    let val_attr = $(this).attr('data-tab');

    let vale = $('#'+val_attr).children().children().children('input[name="payment"]').is(':checked');

    if(vale == true)
    {
        $('#dvdetailspayment').removeClass('hide'); 
    }
    else 
    {
        $('#dvdetailspayment').addClass('hide'); 
    }

    if(val_attr == 'pagoOnline')
    {
        $('#comprobantefechaDiv').addClass('hide'); 
    }
    else 
    {
        $('#comprobantefechaDiv').removeClass('hide'); 
    }

});

let error = false;

$('#pagonombresapellidos').keydown(function() {
    let pagonomval = $(this).val();
    if(pagonomval == '')
    {  
        $("#error-nomapellido").text('Este Campo es Obligatorio');
        $("#pagonombresapellidos").removeClass("box_succes");
        $("#pagonombresapellidos").addClass("box_error");
        error = true;
    }
    else 
    {
        $("#error-nomapellido").text('');
        $("#pagonombresapellidos").removeClass("box_error");
        $("#pagonombresapellidos").addClass("box_succes");
        error = false;
    }
});

$('#pagoinformacionadicional').keyup(function() {
    let pagonomval = $(this).val();
    if(pagonomval == '')
    {  
        $("#error-tele").text('Este Campo es Obligatorio');
        $("#pagoinformacionadicional").removeClass("box_succes");
        $("#pagoinformacionadicional").addClass("box_error");
        error = true;
    }
    else 
    {
        $("#error-tele").text('');
        $("#pagoinformacionadicional").removeClass("box_error");
        $("#pagoinformacionadicional").addClass("box_succes");
        error = false;
    }
});

$('#pagoemail').keyup(function(){
    let emailval = $(this).val();
    
    // let emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    let emailReg = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

    if(emailval == '')
    {
        $("#error-email").text('Este Campo es Obligatorio');
        $("#pagoemail").removeClass("box_succes");
        $("#pagoemail").addClass("box_error");
        error = true;
    }
    else 
    {
        if (!emailReg.test(emailval)) {
            $("#error-email").text('Porfavor Ingresar un formato de correo válido.');
            $("#pagoemail").removeClass("box_succes");
            $("#pagoemail").addClass("box_error");
            error = true;
        } else {
            $("#error-email").text('');
            $("#pagoemail").removeClass("box_error");
            $("#pagoemail").addClass("box_succes");
            error = false;
        }
    }
});

$('#pagoemailverificar').keyup(function(){
    let emailverificarval = $(this).val();
    let emailReg2 = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    let emailval = $('#pagoemail').val();

    
    if (emailverificarval == '') {
        $("#error-validateEmail").text('Este campo es obligatorio');
        $("#pagoemailverificar").removeClass("box_succes");
        $("#pagoemailverificar").addClass("box_error");
        error = true;
    } 
    else 
    {
        if (emailval != emailverificarval) {
            $("#error-validateEmail").text('Los Correos no coinciden');
            $("#pagoemailverificar").removeClass("box_succes");
            $("#pagoemailverificar").addClass("box_error");
            error = true;
        } else {
            $("#error-validateEmail").text('');
            $("#pagoemailverificar").removeClass("box_error");
            $("#pagoemailverificar").addClass("box_succes");
            error = false;
        }
    }

});

// $('.btn-next-first').on('click',function()
// {
//     if($('#pagonombresapellidos').val() == '')
//     {  
//         $("#error-nomapellido").text('Este Campo es Obligatorio');
//         $("#pagonombresapellidos").removeClass("box_succes");
//         $("#pagonombresapellidos").addClass("box_error");
//         error = true;
//     }
//     else 
//     {
//         $("#error-nomapellido").text('');
//         $("#pagonombresapellidos").removeClass("box_error");
//         $("#pagonombresapellidos").addClass("box_succes");
//         error = false;
//     }
// });


