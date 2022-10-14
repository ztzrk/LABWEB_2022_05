var kalimat = prompt("Masukkan Kalimat..");

var kalimatLower = "";
for (let i = 0; i < kalimat.length; i++) {
    var code = parseInt(kalimat.charCodeAt(i));
    if ((code > 64 && code < 91) || (code > 96 && code < 123)) {
        kalimatLower += kalimat.charAt(i).toLowerCase();
    }
    else {
        kalimatLower += kalimat.charAt(i);
    }
}
var arrayHuruf = kalimatLower.split('').sort();
var jumlah = 1;
var arr = [];

for (let i = 0; i < arrayHuruf.length; i++) {
    const ch = arrayHuruf[i];
    if (ch == arrayHuruf[i+1]) {
        arr[ch] = jumlah;
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