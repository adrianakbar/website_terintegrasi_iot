$(document).ready(function () {
    // Event saat tombol "Simpan" pada modal tambah data diklik
    $("#createbutton").click(function (event) {
        event.preventDefault(); // Mencegah perilaku default form submission

        var nama = $("#createnama").val();
        var tanggalMasuk = $("#createtanggalmasuk").val();
        var alamat = $("#createalamat").val();
        var noHp = $("#createnohp").val();

        // Memeriksa apakah semua field telah diisi
        if (
            nama === "" ||
            tanggalMasuk === "" ||
            alamat === "" ||
            noHp === ""
        ) {
            Swal.fire({
                title: "Gagal",
                text: "Semua data harus diisi",
                icon: "warning",
                confirmButtonColor: "#515646",
            });
            return; // Menghentikan proses jika ada field yang kosong
        }

        // Memeriksa apakah nomor HP hanya terdiri dari angka
        var hpPattern = /^\d+$/;
        if (!hpPattern.test(noHp)) {
            Swal.fire({
                title: "Gagal",
                text: "Nomor HP harus berupa angka",
                icon: "warning",
                confirmButtonColor: "#515646",
            });
            return; // Menghentikan proses jika nomor HP tidak valid
        }

        // Memeriksa ketersediaan token CSRF
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        if (!csrfToken) {
            console.error("CSRF token tidak ditemukan.");
            return;
        }

        // Kirim data ke server menggunakan Ajax
        $.ajax({
            url: "/createkaryawan",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            data: JSON.stringify({
                nama: nama,
                tanggal_masuk: tanggalMasuk,
                alamat: alamat,
                no_hp: noHp,
            }),
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
            error: function (xhr) {
                console.error("Terjadi kesalahan:", xhr.responseText);
                Swal.fire({
                    title: "Gagal",
                    text: "Terjadi kesalahan saat menambahkan data karyawan. Silakan coba lagi",
                    icon: "error",
                });
            },
        });
    });

    $(".delete-btn").click(function (e) {
        e.preventDefault();
        var id_karyawan = $(this).data("id"); // Mengambil nilai ID dari atribut data-id

        // Memeriksa ketersediaan token CSRF
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#515646",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal",
            confirmButtonText: "Yakin",
            confirmButtonColor: "#515646",
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user mengkonfirmasi untuk menghapus, kirim permintaan delete ke server
                $.ajax({
                    url: "/deletekaryawan/" + id_karyawan, // Sesuaikan dengan URL yang sesuai di Laravel
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        // Tampilkan pesan sukses
                        Swal.fire({
                            title: "Terhapus",
                            text: "Data karyawan berhasil dihapus",
                            icon: "success",
                            confirmButtonColor: "#515646",
                        }).then(() => {
                            // Refresh halaman setelah penghapusan berhasil
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        // Tampilkan pesan error jika terjadi masalah saat menghapus
                        Swal.fire({
                            title: "Gagal",
                            text: "An error occurred while deleting the file",
                            icon: "error",
                        });
                        console.error(xhr.responseText);
                    },
                });
            }
        });
    });

    $(".update-btn").click(function () {
        var id = $(this).data("id");
        $.get("/idkaryawan/" + id, function (data) {
            $("#updatenama").val(data.nama_karyawan);
            $("#updatetanggalmasuk").val(data.tanggal_masuk);
            $("#updatealamat").val(data.alamat);
            $("#updatenohp").val(data.no_hp);
            $("#updateform").attr("action", "/updatekaryawan/" + id);
        });
    });

    $("#saveupdate").click(function () {
        var id = $("#updateform").attr("action").split("/").pop();
        var nama = $("#updatenama").val();
        var tanggalMasuk = $("#updatetanggalmasuk").val();
        var alamat = $("#updatealamat").val();
        var noHp = $("#updatenohp").val();

        // Periksa apakah nama atau tanggal kosong
        if (
            nama === "" ||
            tanggalMasuk === "" ||
            alamat === "" ||
            noHp === ""
        ) {
            // Tampilkan Sweet Alert untuk error
            Swal.fire({
                icon: "error",
                title: "Gagal",
                text: "Semua data harus diisi",
                confirmButtonColor: "#515646",
            });
            return; // Berhenti eksekusi jika ada data yang kosong
        }

        // Memeriksa apakah nomor HP hanya terdiri dari angka
        var hpPattern = /^\d+$/;
        if (!hpPattern.test(noHp)) {
            Swal.fire({
                title: "Gagal",
                text: "Nomor HP harus berupa angka",
                icon: "warning",
                confirmButtonColor: "#515646",
            });
            return; // Menghentikan proses jika nomor HP tidak valid
        }

        $.ajax({
            url: "/updatekaryawan/" + id,
            method: "PUT",
            data: $("#updateform").serialize(),
            success: function (response) {
                // Tampilkan Sweet Alert untuk sukses
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Data karyawan berhasil diperbarui",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#515646",
                }).then(function () {
                    location.reload(); // Muat ulang halaman setelah Sweet Alert tertutup
                });
            },
            error: function (xhr) {
                // Tampilkan Sweet Alert untuk error
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Terjadi kesalahan! Silakan coba lagi",
                });
                console.log(xhr.responseText);
            },
        });
    });
});
