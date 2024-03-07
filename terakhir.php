<?php
// Ganti dengan kredensial basis data yang sesuai
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baru";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Operasi CRUD untuk guru
if (isset($_POST['addTeacher'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $mata_pelajaran = $_POST['mata_pelajaran'];

    $sql = "INSERT INTO teachers (nip, nama, mata_pelajaran) VALUES ('$nip', '$nama', '$mata_pelajaran')";
    $result = $conn->query($sql);

    if ($result) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}

if (isset($_POST['editTeacher'])) {
    $nip_edit = $_POST['nip_edit'];
    $nama_edit = $_POST['nama_edit'];
    $mata_pelajaran_edit = $_POST['mata_pelajaran_edit'];

    $sql = "UPDATE teachers SET nama='$nama_edit', mata_pelajaran='$mata_pelajaran_edit' WHERE nip='$nip_edit'";
    $result = $conn->query($sql);

    if ($result) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}

if (isset($_GET['deleteTeacher'])) {
    $nip_delete = $_GET['deleteTeacher'];

    $sql = "DELETE FROM teachers WHERE nip='$nip_delete'";
    $result = $conn->query($sql);

    if ($result) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}

// Operasi CRUD untuk siswa
if (isset($_POST['addStudent'])) {
    $nisn = $_POST['nisn'];
    $nama_siswa = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];

    $sql = "INSERT INTO students (nisn, nama, kelas) VALUES ('$nisn', '$nama_siswa', '$kelas')";
    $result = $conn->query($sql);

    if ($result) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}

if (isset($_POST['editStudent'])) {
    $nisn_edit = $_POST['nisn_edit'];
    $nama_siswa_edit = $_POST['nama_siswa_edit'];
    $kelas_edit = $_POST['kelas_edit'];

    $sql = "UPDATE students SET nama='$nama_siswa_edit', kelas='$kelas_edit' WHERE nisn='$nisn_edit'";
    $result = $conn->query($sql);

    if ($result) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}


if (isset($_GET['deleteStudent'])) {
    $nisn_delete = $_GET['deleteStudent'];

    $sql = "DELETE FROM students WHERE nisn='$nisn_delete'";
    $result = $conn->query($sql);

    if ($result) {
        echo "";
    } else {
        echo "" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jurusan RPL</title>
    <style>
               body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #fff700;
            color: #000;
            text-align: center;
            padding: 20px 0;
        }

        nav {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #a59f00;
        }

        .dashboard-item {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #000;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-buttons a {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 15px;
            text-decoration: none;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
        }

        .edit-button {
            background-color: #3498db;
        }

        .delete-button {
            background-color: #e74c3c;
        }

        /* Hover effects for action buttons */
        .action-buttons a:hover {
            opacity: 0.8;
        }

        .edit-button:hover {
            background-color: #28c700;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        /* Form styling */
        form {
            display: grid;
            grid-gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #000;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4e4e4e;
        }

        .add-button {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #ff7e00;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-button:hover {
            background-color: #ffbf00;
        }
    </style>
</head>
<body>
    <header>
        <img src="smkn5.png" alt="Gambar Kiri" style="float: left; margin-right: 100px;max-width: 130px; margin-top: -10px;">
        <img src="smkbisa2.png" alt="Gambar Kanan" style="float: right; margin-left: 10px;max-width: 300px;margin-top: 5px;">
        <h2>SMK NEGERI 5 KOTA BEKASI</h2>
        
        <h1>REKAYASA PERANGKAT LUNAK</h2>
    </header>
    

    <nav>
        <a href="#" id="home-link">Home</a> | 
        <a href="#" id="courses-link">Mata Pelajaran</a> | 
        <a href="#" id="events-link">Events</a> | 
        <a href="#" id="gallery-link">Galeri</a> |
        <a href="#" id="teachers-link">Data Guru</a> | 
        <a href="#" id="students-link">Data Siswa</a>
        <a href="login.php" id="login-link">Admin Login</a>
    </nav>



    <section id="home" class="dashboard-item">
        <div style="display: flex; align-items: center; justify-content: space-between;">
    
            <!-- Konten Teks di Kiri -->
            <div style="width: 50%;">
                <h2>Selamat Datang di Dashboard Jurusan RPL</h2>
                <p>VISI MK Negeri 5 Kota Bekasi adalah Sebagai Berikut
                <p>“Terwujudnya SMK berkualitas yang menghasilkan Sumber Daya Manusia (SDM) 
                Unggul, Kompeten, Berkarakter, dan Berwawasan global”.</p>

                <h3>Informasi Pendidikan:</h3>
    <ul>
        <li>Program Studi: Rekayasa Perangkat Lunak (RPL)</li>
        <li>Mata Pelajaran Unggulan: Pemrograman Java, Basis Data, Analisis dan Desain Sistem, Pengujian Perangkat Lunak, Manajemen Proyek Perangkat Lunak</li>
        <li>Akreditasi: A</li>
    </ul>
    </section>
    
        



    <section id="courses" class="dashboard-item" style="display: none;">
    <h2>Jadwal Mata Pelajaran</h2>
    <table border="1">
        <tr>
            <th>Hari</th>
            <th>Jam Pertama</th>
            <th>Jam Kedua</th>
            <th>Jam Ketiga</th>
        </tr>
        <tr>
            <td>Senin</td>
            <td>Bahasa Indonesia</td>
            <td>Bahasa Inggris</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Selasa</td>
            <td>Pemrograman Web</td>
            <td>Produktif Keahlian</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Rabu</td>
            <td>Matematika</td>
            <td>Pemrograman Web</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Kamis</td>
            <td>Pemrograman Berbasis Objek</td>
            <td>Basis Data</td>
            <td>-</td>
        </tr>
        <tr>
            <td>Jumat</td>
            <td>Pemrograman Aplikasi Berbasis Platform</td>
            <td>Pemrograman Web</td>
            <td>-</td>
        </tr>
    </table>
</section>


    <section id="events" class="dashboard-item" style="display: none;">
    <h2>Event Jurusan RPL</h2>
    
    <!-- Event 1 -->
    <div class="event-item">
        <h3>Event 1 - Kolaborasi dengan Bangkok College of Technology</h3>
        <p>Prestasi SMK Negeri 5 Kota Bekasi dalam kolaborasi dengan Bangkok College of Technology.</p>
        
    </div>
    
    <!-- Event 2 -->
    <div class="event-item">
        <h3>Event 2 - Peringatan Hari Guru Nasional</h3>
        <p>Peringatan Hari Guru Nasional 25 November 2023 di SMK Negeri 5 Kota Bekasi.</p>
        
    </div>
    
    <!-- Event 3 -->
    <div class="event-item">
        <h3>Event 3 - Lorem Ipsum</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
</section>

<section id="gallery" class="dashboard-item" style="display: none;">
    <h2>Galeri</h2>
    <div class="gallery-images">
        <img src="b.jpg" alt="Gambar 1">
</section>

    <section id="teachers" class="dashboard-item" style="display: none;">
        <h2>Data Guru</h2>
        <a href="javascript:openModal('addTeacherModal')" class="add-button">Tambah Guru</a>
        <!-- Tampilkan tabel guru -->
        <table border="1">
        <tr>
    <th>NIP</th>
    <th>Nama Guru</th>
    <th>Mata Pelajaran</th>
    <th>Aksi</th>
</tr>
<?php
$guru = $conn->query("SELECT * FROM teachers");
while ($row = $guru->fetch_assoc()) {
    echo "<tr>
            <td>{$row['nip']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['mata_pelajaran']}</td>
            <td class='action-buttons'>
                <a href=\"javascript:populateEditTeacherModal('{$row['nip']}', '{$row['nama']}', '{$row['mata_pelajaran']}')\" class='edit-button'>Edit</a>
                <a href=\"?deleteTeacher={$row['nip']}\" onclick=\"return confirm('Apakah Anda yakin ingin menghapus guru ini?');\" class='delete-button'>Hapus</a>
            </td>
        </tr>";
}
?>
        </table>
    </section>

    <section id="students" class="dashboard-item" style="display: none;">
        <h2>Data Siswa</h2>
        <a href="javascript:openModal('addStudentModal')" class="add-button">Tambah Siswa</a>

        <!-- Tampilkan tabel siswa -->
        <table border="1">
        <tr>
    <th>NISN</th>
    <th>Nama Siswa</th>
    <th>Kelas</th>
    <th>Aksi</th>
</tr>
<?php
$siswa = $conn->query("SELECT * FROM students");
while ($row = $siswa->fetch_assoc()) {
    echo "<tr>
            <td>{$row['nisn']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['kelas']}</td>
            <td class='action-buttons'>
                <a href=\"javascript:populateEditStudentModal('{$row['nisn']}', '{$row['nama']}', '{$row['kelas']}')\" class='edit-button'>Edit</a>
                <a href=\"?deleteStudent={$row['nisn']}\" onclick=\"return confirm('Apakah Anda yakin ingin menghapus siswa ini?');\" class='delete-button'>Hapus</a>
            </td>
        </tr>";
}
?>
</table>
    </section>
    <section id="gallery" class="dashboard-item" style="display: none;">
    <h2>Galeri</h2>
</section>



<!-- Modal for editing teacher -->
<div id="editTeacherModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editTeacherModal')">&times;</span>
        <h2>Edit Guru</h2>
        <form method="post" action="">
            <label for="nip_edit">NIP:</label>
            <input type="text" id="nip_edit" name="nip_edit">
            
            <label for="nama_edit">Nama Guru:</label>
            <input type="text" id="nama_edit" name="nama_edit" required>

            <label for="mata_pelajaran_edit">Mata Pelajaran:</label>
            <input type="text" id="mata_pelajaran_edit" name="mata_pelajaran_edit" required>

            <button type="submit" name="editTeacher">Simpan Perubahan</button>
        </form>
    </div>
</div>

<!-- Modal for adding teacher -->
<div id="addTeacherModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addTeacherModal')">&times;</span>
            <h2>Tambah Guru</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="nip">NIP:</label>
                <input type="text" id="nip" name="nip" required>

                <label for="nama">Nama Guru:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="mata_pelajaran">Mata Pelajaran:</label>
                <input type="text" id="mata_pelajaran" name="mata_pelajaran" required>

                <button type="submit" name="addTeacher">Tambah Guru</button>
            </form>
        </div>
    </div>
       <!-- Modal for editing siswa -->
    <div id="editStudentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editStudentModal')">&times;</span>
        <h2>Edit Siswa</h2>
        <form method="post" action="">
            <label for="nisn">NISN:</label>
            <input type="text" id="nisn_edit" name="nisn_edit" required>
            
            <label for="nama_siswa_edit">Nama Siswa:</label>
            <input type="text" id="nama_siswa_edit" name="nama_siswa_edit" required>

            <label for="kelas_edit">Kelas:</label>
            <input type="text" id="kelas_edit" name="kelas_edit" required>

            <button type="submit" name="editStudent">Simpan Perubahan</button>
        </form>
    </div>
</div>
<!-- Modal for adding student -->
<div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('addStudentModal')">&times;</span>
            <h2>Tambah Siswa</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="nisn">NISN:</label>
                <input type="text" id="nisn" name="nisn" required>

                <label for="nama_siswa">Nama Siswa:</label>
                <input type="text" id="nama_siswa" name="nama_siswa" required>

                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas" required>

                <button type="submit" name="addStudent">Tambah Siswa</button>
            </form>
        </div>
    </div>


    <script>
 const homeLink = document.getElementById('home-link');
const coursesLink = document.getElementById('courses-link');
const eventsLink = document.getElementById('events-link');
const teachersLink = document.getElementById('teachers-link');
const studentsLink = document.getElementById('students-link');
const galleryLink = document.getElementById('gallery-link');

const homeSection = document.getElementById('home');
const coursesSection = document.getElementById('courses');
const eventsSection = document.getElementById('events');
const teachersSection = document.getElementById('teachers');
const studentsSection = document.getElementById('students');
const gallerySection = document.getElementById('gallery');

homeLink.addEventListener('click', function() {
    homeSection.style.display = 'block';
    coursesSection.style.display = 'none';
    eventsSection.style.display = 'none';
    teachersSection.style.display = 'none';
    studentsSection.style.display = 'none';
    gallerySection.style.display = 'none';
});

coursesLink.addEventListener('click', function() {
    homeSection.style.display = 'none';
    coursesSection.style.display = 'block';
    eventsSection.style.display = 'none';
    teachersSection.style.display = 'none';
    studentsSection.style.display = 'none';
    gallerySection.style.display = 'none';
});

eventsLink.addEventListener('click', function() {
    homeSection.style.display = 'none';
    coursesSection.style.display = 'none';
    eventsSection.style.display = 'block';
    teachersSection.style.display = 'none';
    studentsSection.style.display = 'none';
    gallerySection.style.display = 'none';
});

teachersLink.addEventListener('click', function() {
    homeSection.style.display = 'none';
    coursesSection.style.display = 'none';
    eventsSection.style.display = 'none';
    teachersSection.style.display = 'block';
    studentsSection.style.display = 'none';
    gallerySection.style.display = 'none';
});

studentsLink.addEventListener('click', function() {
    homeSection.style.display = 'none';
    coursesSection.style.display = 'none';
    eventsSection.style.display = 'none';
    teachersSection.style.display = 'none';
    studentsSection.style.display = 'block';
    gallerySection.style.display = 'none';
});

galleryLink.addEventListener('click', function() {
    homeSection.style.display = 'none';
    coursesSection.style.display = 'none';
    eventsSection.style.display = 'none';
    teachersSection.style.display = 'none';
    studentsSection.style.display = 'none';
    gallerySection.style.display = 'block';
});
        
        function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}

// Function to close modal
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Close modal when clicking outside the modal
window.onclick = function(event) {
    if (event.target.className === 'modal') {
        event.target.style.display = 'none';
    }
};
// Function to populate edit teacher modal
function populateEditTeacherModal(nip, nama, mata_pelajaran) {
    document.getElementById('nip_edit').value = nip;
    document.getElementById('nama_edit').value = nama;
    document.getElementById('mata_pelajaran_edit').value = mata_pelajaran;

    openModal('editTeacherModal');
}

// Function to populate edit student modal
function populateEditStudentModal(nisn, nama, kelas) {
    document.getElementById('nisn_edit').value = nisn;
    document.getElementById('nama_siswa_edit').value = nama;
    document.getElementById('kelas_edit').value = kelas;

    openModal('editStudentModal');
}

    </script>
</body>
</html>