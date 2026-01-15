//day/night switch themeSwitch(need to be optimized)
var l=0;
$(function(){
    $('#themeSwitch').click(function(){
        if(l==0){
        $('body').css({//changes light to dark
            'background-image': 'url("images/eds_bcc.gif")',
            'color':'white',
        });
        $('a').css({
            'color':'white',
        });
        $('footer').css({
            'background-color':'black',
        });
        $('header').css({
            'border-bottom':'5px solid white'
        });
        $('.login_head').css({
            'background-color':'black',
        });
        $('.login_main').css({
            'background-color':'black',
        });
        $('.line').css({
            'background-color':'white',
        });
        $('#orsign').css({
            'background-color':'black',
        });
        $('#orsign').css({
            'background-color':'black',
        });
        $('h4').css({
            'color':'white',
        });
        $('.themes').attr({
            "alt":"dark theme",
            "src":"images/ikony/ksiezyc.png",
        });
        $('.themes').css({
            'bottom':'1px',
            'right':'2px',
        });
        $('.spaces').css({
            'border-right':'solid 3px white',
        });
        $('.main').css({
            'border':'5px solid white',
        });
        $('.filters').css({
            'border':'5px solid white',
        });
        $('.the_choosen_one a').css({
            'color':'black',
        });
        $('.the_choosen_one').css({
            'border-right':'5px solid #632bff',
        });

        



        $('#cart').css({'filter':'invert()',});
        $('span #cart').css({'filter':'none',});
        l=1;
        console.log(l);
    }
        else{
            $('body').css({//changes dark to light
            'background-image': 'url("images/bckgrnd_light.jpg")',
            'color':'black',
        });
        $('a').css({
            'color':'black',
        });
         $('footer').css({
            'background-color':'white',
        });
        $('header').css({
            'border-bottom':'5px solid black'
        });
         $('.themes').attr({
            "alt":"light theme",
            "src":"images/ikony/slonce.png",
        });
         $('.themes').css({
            'bottom':'3px',
            'right':'0px',
        });
        $('.login_head').css({
            'background-color':'white',
        });
        $('.login_main').css({
            'background-color':'white',
        });
        $('.line').css({
            'background-color':'black',
        });
        $('#orsign').css({
            'background-color':'white',
        });
        $('#orsign').css({
            'background-color':'white',
        });
        $('h4').css({
            'color':'black',
        });
        $('#cart').css({'filter':'none',});
        l=0;
        console.log(l);

        
        $('.spaces').css({
            'border-right':'solid 3px black',
        });
        $('.main').css({
            'border':'5px solid black',
        });
        $('.filters').css({
            'border':'5px solid black',
        });
        $('.the_choosen_one').css({
            'border-right':'5px solid black',
        });
    }

    })
});

$(document).ready(function() {
    $('.copyrights h4').html(`spaceboots &copy; ${new Date().getFullYear()}`);
});
