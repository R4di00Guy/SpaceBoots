//day/night switch themeSwitch

var l=0;
$(function(){
    $('#themeSwitch').click(function(){
        if(l==0){
        $('body').css({//changes light to dark
            'background-image': 'url("eds_bcc.gif")',
            'color':'white',
        });
        $('#themeSwitch').text("⏾");
        l=1;
        console.log(l);
    }
        else{
            $('body').css({//changes dark to light
            'background-image': 'url("bckgrnd_light.jpg")',
            'color':'black',
        });
        $('#themeSwitch').text("☀");
        l=0;
        console.log(l);
    }

    })
})
