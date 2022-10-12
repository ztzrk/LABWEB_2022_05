var angka1 = prompt("Perkalian Berapa?");
while (isNaN(angka1)) {
    console.log("Input bukan angka")
    angka1 = prompt("Perkalian Berapa?");
}
var angka2 = prompt("Ingin dikalikan sampai berapa?");
while (isNaN(angka2)) {
    console.log("Input bukan angka")
    angka2 = prompt("Ingin dikalikan sampai berapa?");
}

var intAngka1 = parseInt(angka1);
var intAngka2 = parseInt(angka2);
var jumlah = 0;

for (var i = 1; i <= intAngka2; i++) {
    console.log(i + " x " + angka1 + " = " + i * angka1);
    jumlah += i * angka1;
}
console.log("Hasil seluruh perkalian: ", jumlah);