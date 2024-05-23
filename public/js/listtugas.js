function createtugas() {
    var judul = $("#judultugas").val();
    var deskripsi = $("#deskripsitugas").val();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var hari = $("#hari").val();
    var checkbox = $("#checkbox").prop("checked") ? 1 : 0; // Mendapatkan nilai checkbox

    // Memeriksa apakah semua field telah diisi
    if (judul === "" || deskripsi === "" || hari === "") {
        Swal.fire({
            title: "Gagal",
            text: "Semua data harus diisi",
            icon: "warning",
            confirmButtonColor: "#515646",
        });
        return; // Menghentikan proses jika ada field yang kosong
    }

    $.ajax({
        type: "POST",
        url: "/createlisttugas",
        data: {
            judul: judul,
            deskripsi: deskripsi,
            hari: hari,
            checkbox: checkbox,
        },
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            Swal.fire({
                title: "Berhasil",
                text: "Data karyawan berhasil ditambahkan",
                icon: "success",
                showCancelButton: false, // Tidak menampilkan tombol Cancel
                confirmButtonText: "OK", // Mengubah teks tombol konfirmasi menjadi "OK"
                confirmButtonColor: "#515646", // Mengubah warna tombol konfirmasi menjadi hijau
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Me-refresh halaman jika tombol "OK" diklik
                }
            });
        },
        error: function (response) {
            console.error(response);
            // Tampilkan pesan error jika terjadi kesalahan
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Terjadi kesalahan saat menambahkan data!",
            });
        },
    });
}

function deletetugas(id_tugas) {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#515646",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yakin",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: "/deletelisttugas/" + id_tugas,
                data: {
                    _method: "DELETE",
                },
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    console.log(response);
                    // Refresh halaman setelah menghapus data
                    location.reload();
                },
                error: function (response) {
                    console.error(response);
                    // Tampilkan pesan error jika terjadi kesalahan
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Terjadi kesalahan saat menghapus data!",
                    });
                },
            });
        }
    });
}
