// function fetchData() {
//     $.ajax({
//         url: '/owner/datakelembaban', // Menggunakan endpoint baru yang telah dibuat
//         method: 'GET',
//         success: function(response) {
//             var kelembaban = parseFloat(response);
//             updateSpeedometer(kelembaban);
//         },
//         error: function(xhr, status, error) {
//             console.error(error);
//         }
//     });
// }

// setInterval(fetchData, 1000);