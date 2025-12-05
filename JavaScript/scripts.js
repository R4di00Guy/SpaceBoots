//day/night switch themeSwitch
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
        $('#themeSwitch').text("☾");
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
        $('#themeSwitch').text("☀");
        l=0;
        console.log(l);
    }

    })
})
