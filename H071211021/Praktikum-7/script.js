function isDelete(id) {
    if (confirm('Yakin ingin Hapus Data ?'))
    {
    window.location.href = 'process.php?hapus=' + id;
    }
}

var modal1 = document.getElementById('id01');
var modal2 = document.getElementById('id02');

window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    else if (event.target == modal2) {
        modal2.style.display = "none";
    }
}