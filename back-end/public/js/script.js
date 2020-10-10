$(function(){
    getHoratio();
    getInfos();
})
function getInfos()
{
    $.ajax({
        url : "api/get/all",
        method : "GET",
        success : function(res){
            res = JSON.parse(res)
            $("tbody").html("");
            res.forEach(senha => {
                if(senha.status == 1){
                    let audio = new Audio('assets/alert.mp3');
                    audio.play();
                    document.getElementById('yourAudioTag').play();
                }
                $("tbody").append(`
                <tr>
                    <td>${senha.senha}</td>
                    <td>${senha.guiche}</td>
                    <td>${senha.data}</td>
                </tr>
                `)
            });

            console.log(res[0])
            $("#senha-card").html(res[0].senha);
            $("#guiche-card").html(res[0].guiche);
        }
    })

    setTimeout(function(){
        getInfos();
    }, 5000)
}

function getHoratio(){
    var data = new Date();
    var hora    = data.getHours();          
    var min  = data.getMinutes();
    switch (min) {
        case 0:
            min = "00";
            break;
        case 1:
            min = "01";
            break;
        case 2:
            min = "02";
            break;
        case 3:
            min = "03";
            break;
        case 4:
            min = "04";
            break;
        case 5:
            min = "05";
            break;
        case 6:
            min = "06";
            break;
        case 7:
            min = "07";
            break;
        case 8:
            min = "08";
            break;
        case 9:
            min = "09";
            break;

        default:
            break;
    }   
    $("#horario").html(hora + ":"+ min);

    setTimeout(function(){
        getHoratio();
    }, 30000)
}

