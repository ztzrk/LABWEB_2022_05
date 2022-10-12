var kalimat = prompt("Masukkan Kalimat..");

var arrayHuruf = kalimat.split('').sort();
var jumlah = 1;
var arr = [];

for (let i = 0; i < arrayHuruf.length; i++) {
    const ch = arrayHuruf[i];
    if (ch == arrayHuruf[i+1]) {
        jumlah +=1;
    }
    else {
        arr[ch] = jumlah;
        jumlah = 1;
    }
}

for (const x in arr) {
    if (x == " ") {
        console.log("spasi =" + arr[x]);
    }
    else{
        console.log(x +"=" + arr[x]);
    }
}