function isEmpty(x) {
    switch (x) {
        case "":
        case null:
        case undefined:
            return true;
        default:
        return false;
    }
}

function isSpace(x) {
    return x.trim().length == 0;
}

var nama = prompt("masukkan nama");
while (isEmpty(nama) || isSpace(nama)){
    console.log("Masukkan nama anda terlebih dahulu");
    nama = prompt("masukkan nama");
} 

var flag = true;
var flagAsistensi = true;
var flagJumlah = true;

while (flag) {
    var praktikum = prompt("Sudah mengumpulkan Tugas Praktikum? YES atau NO").toLowerCase();
    if (praktikum == "yes") {
        var asistensi = prompt("Ikut asistensi? YES atau NO").toLowerCase();
        while (flagAsistensi) {
            if (asistensi == "yes") {
                var jumlah = prompt("Sudah Berapa kali asistensi? 1 atau 2");
                while (flagJumlah){
                    if (jumlah == "1") {
                        console.log("Asistensi sekali lagi ya " + nama);
                        flagAsistensi = false;
                        flagJumlah = false;
                        flag = false;
                    }
                    else if (jumlah == "2") {
                        console.log("Hebat kamu ", nama, " :)");
                        flagAsistensi = false;
                        flagJumlah = false;
                        flag = false;
                    }
                    else {
                        console.log("inputnya yang sesuai yuk");
                        var jumlah = prompt("Sudah Berapa kali asistensi? 1 atau 2");
                    }
                }
            }
            else if (asistensi == "no") {
                console.log("Asisten dulu ya ", nama);
                flagAsistensi = false;
                flag = false
            }
            else {
                console.log("Masukkan input yang benar yaitu yes atau no");
                var asistensi = prompt("Ikut asistensi? YES atau NO").toLowerCase();
            }
        }
    }
    else if (praktikum == "no") {
        console.log("Jangan lupa dikerja tugas praktikumnya Budi");
        flag = false;
    }
    else {
        console.log("Masukkan input yang benar yaitu yes atau no");
        var praktikum = prompt("Sudah mengumpulkan Tugas Praktikum? YES atau NO").toLowerCase();
    }
}

