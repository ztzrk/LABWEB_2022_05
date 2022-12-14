function isDelete(id) {
    if (confirm('Yakin ingin Hapus Data ?'))
    {
    window.location.href = 'process.php?hapus=' + id;
    }
}

