<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .stat-card {
      background-image: linear-gradient(to bottom right, #e2c49f, #78716c, #3f3f3f);
      min-height: 160px;
    }
    
    h2 {
      align-items: center;
    }

    .icon-container {
      background-color: #000;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 4px;
    }
    
    .sidebar {
      transition: transform 0.3s ease;
      position: fixed;
      margin-top: 5vh;
      height: 100vh;
      top: 0;
      left: 0;
      z-index: 20;
      background:rgb(229, 231, 235);
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
      transform: translateX(-100%);
    }

    .sidebar li:hover {
      background-color:rgb(195, 195, 195);
    }
    
    .sidebar-open {
      transform: translateX(0);
    }
    
    .main-content {
      transition: margin-left 0.3s ease;
      margin-left: 0;
    }
    
    .sidebar-open + .main-content {
      margin-left: 150px;
    }
    
    @media (max-width: 768px) {
      .stat-card {
        min-height: 140px;
      }
      .sidebar-open + .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="bg-white-100">
@include('components.navbar')

  <!-- Sidebar -->
@include('components.sidebar')

  <!-- Main Content -->
@yield('content')

  <script>
    // Toggle sidebar
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    
    menuButton.addEventListener('click', (e) => {
      e.stopPropagation();
      sidebar.classList.toggle('sidebar-open');
    });
    
    // Close sidebar when clicking outside
    document.addEventListener('click', (event) => {
      if (!sidebar.contains(event.target) && !menuButton.contains(event.target) && sidebar.classList.contains('sidebar-open')) {
        sidebar.classList.remove('sidebar-open');
      }
    });
  </script>
  <script>
      function showUpdateStatusModal(id, status) {
          const modal = document.getElementById('modal-update-status');
          document.getElementById('update-status-id').value = id;
          document.getElementById('update-status-select').value = status;
          modal.showModal();
      }

      function showPengembalianModal(id) {
          const modal = document.getElementById('modal-pengembalian');
          document.getElementById('pengembalian-id').value = id;
          modal.showModal();
      }
  </script>
  <script>
    // Fungsi untuk menampilkan modal ubah status
    function showUpdateStatusModal(id, currentStatus) {
        document.getElementById('update-status-id').value = id;
        document.getElementById('update-status-select').value = currentStatus;
        document.getElementById('modal-update-status').classList.remove('hidden');
    }
    
    // Fungsi untuk menampilkan modal pengembalian
    function showPengembalianModal(id) {
        document.getElementById('pengembalian-id').value = id;
        document.getElementById('modal-pengembalian').classList.remove('hidden');
    }
    
    // Fungsi untuk menampilkan detail pengembalian
    function showDetailPengembalian(data) {
        const content = document.getElementById('detail-content');
        const kondisi = {
            'sangat_baik': 'Sangat Baik',
            'baik': 'Baik',
            'rusak': 'Rusak',
            'hilang': 'Hilang'
        };
        
        const tanggalPenyewaan = new Date(data.tanggal_penyewaan);
        const tanggalPengembalian = new Date(data.tanggal_pengembalian);
        
        content.innerHTML = `
            <div class="space-y-2">
                <p><strong>ID Pengembalian:</strong> ${data.id}</p>
                <p><strong>No. Penyewaan:</strong> #${data.id_penyewaan}</p>
                <p><strong>Pelanggan:</strong> ${data.nama_pelanggan}</p>
                <p><strong>Tanggal Penyewaan:</strong> ${tanggalPenyewaan.toLocaleDateString('id-ID')} ${tanggalPenyewaan.toLocaleTimeString('id-ID')}</p>
                <p><strong>Tanggal Pengembalian:</strong> ${tanggalPengembalian.toLocaleDateString('id-ID')} ${tanggalPengembalian.toLocaleTimeString('id-ID')}</p>
                <p><strong>Kondisi:</strong> ${kondisi[data.kondisi] || '-'}</p>
                <p><strong>Denda:</strong> ${data.denda ? 'Rp ' + data.denda.toLocaleString('id-ID') : '-'}</p>
                <p><strong>Catatan:</strong> ${data.catatan || '-'}</p>
            </div>
        `;
        
        document.getElementById('modal-detail').classList.remove('hidden');
    }
    
    // Fungsi untuk menyembunyikan modal
    function hideModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
    
    // Tutup modal ketika klik di luar area modal
    window.onclick = function(event) {
        ['modal-update-status', 'modal-pengembalian', 'modal-detail'].forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }
</script>

<script>
    function showUpdateStatusModal(id, currentStatus) {
        document.getElementById('update-status-id').value = id;
        document.getElementById('update-status-select').value = currentStatus;
        document.getElementById('modal-update-status').classList.remove('hidden');
    }
    
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
<script>
    function showUpdateStatusModal(id, currentStatus) {
        document.getElementById('update-status-id').value = id;
        document.getElementById('update-status-select').value = currentStatus;
        document.getElementById('modal-update-status').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function showPengembalianModal(id) {
        document.getElementById('pengembalian-id').value = id;
        document.getElementById('modal-pengembalian').showModal();
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#products-table tbody tr');
            
            rows.forEach(row => {
                const productName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                row.style.display = productName.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});
</script>
</body>
</html>