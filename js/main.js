var counter = 0;
$(document).ready(function(){
    // Check if js is running
    console.log('Js loaded');
    
    // Reg form validation with ajax
    $('#firstname').keyup(function(){
    // var regExp = new RegExp(/^[a-zA-Z]*$/); method 1
        var regExp =  /^[a-zA-Z]+$/;
        if(!regExp.test($('#firstname').val())){
            $('#firstname').addClass('invalid animated shake');
            $('#error').text("Invalid");
            $('#error').addClass("invalid");    
        }else{
            $('#firstname').removeClass('invalid animated shake');
            $('#firstname').addClass('valid');
            $('#error').detach();
        }
    });
    $('#lastname').keyup(function(){
        var regExp =  /^[a-zA-Z]+$/;
        if(!regExp.test($('#lastname').val())){
            $('#lastname').addClass('invalid animated shake');
        }else{
            $('#lastname').removeClass('invalid animated shake');
            $('#lastname').addClass('valid');
        }
    });
    $('#username').keyup(function(){
        var regExp =  /^[a-zA-Z0-9]+$/;
        if(!regExp.test($('#username').val())){
            $('#username').addClass('invalid animated shake');
        }else{
            $('#username').removeClass('invalid animated shake');
            $('#username').addClass('valid');
        }
    });
    $('#email').keyup(function(){
        var regExp =  /^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/;
        if(!regExp.test($('#email').val())){
            $('#email').addClass('invalid animated shake');
        }else{
            $('#email').removeClass('invalid animated shake');
            $('#email').addClass('valid');
        }
    });
    $('#phone').keyup(function(){
        var regExp =  /^[0-9]{10}$/;
        if(!regExp.test($('#phone').val())){
            $('#phone').addClass('invalid animated shake');
            $('#phone').html('Invalid no');
        }else{
            $('#phone').removeClass('invalid animated shake');
            $('#phone').addClass('valid');
        }
    });
    $('#password').keyup(function(){
        var regExp =  /^[a-zA-Z0-9_\s]{8,20}$/;
        if(!regExp.test($('#password').val())){
            $('#password').addClass('invalid animated shake');
        }else{
            $('#password').removeClass('invalid animated shake');
            $('#password').addClass('valid');
        }
    });
    $('#confirm_pass').keyup(function(){
        var regExp =  /^[a-zA-Z0-9_\s]{8,20}$/;
        if(regExp.test($('#confirm_pass').val())){
            if($('#confirm_pass').val() == $('#password').val()){
                $('#confirm_pass').removeClass('invalid');
                $('#confirm_pass').addClass('valid');
            }else{
                $('#confirm_pass').addClass('invalid animated shake');
            }
        }
        else{
            $('#confirm_pass').addClass('invalid animated shake');
        }
    });
    $('#user_input').keyup(function(){
        var regExp =  /^[a-zA-Z0-9@.]+$/;
        if(!regExp.test($('#user_input').val())){
            $('#user_input').addClass('invalid animated shake');
        }else{
            $('#user_input').removeClass('invalid animated shake');
            $('#user_input').addClass('valid');
        }
    });

    $('#price').keyup(function(){
        var regExp = /^[0-9.,]+$/;
        if(!regExp.test($('#price').val())){
            $('#price').addClass('invalid animated shake');
        }else{
            $('#price').removeClass('invalid animated shake');
            $('#price').addClass('valid');
        }
    });

    $('#qty').keyup(function(){
        var regExp = /^[0-9]+$/;
        if(!regExp.test($('#qty').val())){
            $('#qty').addClass('invalid animated shake');
        }else{
            $('#qty').removeClass('invalid animated shake');
            $('#qty').addClass('valid');
        }
    });
    
    
    // Delete button
    $('#deleteBtn').click(function(){
        $("#contact-row").addClass('animated fadeOutRight');
        setTimeout(3600);
    });


   
    // Config for dropdown
    $(".dropdown-trigger").dropdown({
        hover: true,
        coverTrigger: false,
        alignment: 'left',
        constrainWidth: false,
        inDuration: 420,
        outDuration: 360
    });
    
    // Modal
    $('.modal').modal({
        opacity: 0.8,
        inDuration: 200,
        startingTop: '5%',
        dismissible: true,
        // outDuration: 420,
        preventScrolling: false
    });    
    
    // Textarea
    M.textareaAutoResize($('#textarea1'));

    // Count character
    $('input#phone, textarea#address, textarea#desc, input#card-no, input#cvv').characterCounter();

    // text fields
    M.updateTextFields();

    // For sidenav
    $('.sidenav').sidenav({
        inDuration: 300,
        outDuration: 280,
        draggable: true,
        preventScrolling: true
    });
    
    //Collapsible    
    $('.collapsible').collapsible({
        accordian: true,
        inDuration: 200,
        outDuration: 180
    });

    
   
    ScrollReveal().reveal('.product-showcase');
    // For materialbox
    $('.materialboxed').materialbox();

    // Select 
    $('select').formSelect();

   
    // Tooltip
    $('.tooltipped').tooltip();

    // Scroll reveal
    ScrollReveal().reveal('.row .product-showcase');      


    // Slider
    $('.slider').slider({
        indicators: false,
        height: 520,
        duration: 600,
        interval: 6000
    });
    

  
    
});
