//Ini adalah peringatan sebelum reload

//window.onbeforeunload = function() {
//  return "Dude, are you sure you want to leave? Think of the kittens!";
//}

var tabButtons = document.querySelectorAll('.nomor button');
var soal = document.querySelectorAll('.soal .tabSoal');
var waktu = 1800;
var counter = 0;



function submitForm(){
    
}

function convert(s){
    var m = Math.floor(s / 60);
    var s = s % 60;
    m = (m < 10) ? "0" + m + " Menit" : m + " Menit";
    s = (s < 10) ? "0" + s + " Detik" : s + " Detik";
    return m + " " + s;
}

function waktuJalan(){
    var clear = setInterval(() => {
    counters();
    }, 1000);

    function counters(){
    counter++;
    var wkt = convert(waktu - counter);
    document.getElementById('timerUjian').textContent = wkt;
    if(counter == waktu){
        document.submitData.submit();
    }
    }
}

waktuJalan();

function showJenis(soalIndex, classBaru){
    
}

function showPanel(soalIndex, classBaru){
    /*
    tabButtons.forEach(function (node){
    node.className = ' ' + 'btn btn-primary mt-1';
    });
    tabButtons[soalIndex - 1].className = ' ' + classBaru;
    */

    soal.forEach(function (node){
    node.style.display = 'none';
    });
    
    soal[soalIndex - 1].style.display = 'block';
}

function ragu(soalIndex, classBaru){
    tabButtons[soalIndex - 1].className = ' ' + classBaru;
}

/* membuat simpan
function simpan(soalIndex, classBaru){
    tabButtons[soalIndex - 1].className = ' ' + classBaru;
}
*/

function pilgan(soalIndex, pilihan, classBaru){
    tabButtons[soalIndex - 1].innerHTML = pilihan;
    tabButtons[soalIndex - 1].className = ' ' + classBaru;
}

function lanjutkan(soalIndex){

    var lanjut = soal[soalIndex].style.display = 'block';

    if(lanjut){
    soal[soalIndex - 1].style.display = 'none';
    }
}

function back(soalIndex){
    var kembali = soal[soalIndex - 2].style.display = 'block';

    if(kembali){
    soal[soalIndex - 1].style.display = 'none';
    }
}

showPanel(1, 'btn btn-secondary');
