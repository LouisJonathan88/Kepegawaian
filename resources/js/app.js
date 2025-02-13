import './bootstrap';
import Chart from 'chart.js/auto'
window.Chart = Chart
document.addEventListener('DOMContentLoaded', function() {
    const gajiInputs = document.querySelectorAll('#gaji_pokok');
    
    gajiInputs.forEach(function(gajiInput) {
        gajiInput.addEventListener('input', function(e) {
            // Hapus karakter non-angka
            let value = this.value.replace(/[^\d]/g, '');
            
            // Format dengan titik sebagai pemisah ribuan
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            
            // Tambahkan 'Rp' di depan
            this.value = 'Rp ' + value;
        });
    });
});