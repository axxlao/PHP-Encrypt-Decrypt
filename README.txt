Skrip PHP Enkripsi dan Dekripsi
Copyright © 2023 oleh Totok Hermawan

Skrip PHP ini menunjukkan proses dasar enkripsi dan dekripsi menggunakan algoritma enkripsi AES-256-CBC. Skrip ini menggunakan kunci rahasia dan ID konstan untuk enkripsi dan dekripsi. Data yang dienkripsi kemudian di-encode dalam format base64 untuk kemudahan transmisi dan penyimpanan.

Persyaratan
Sebelum menjalankan skrip, pastikan Anda memiliki hal-hal berikut:
PHP: Pastikan PHP terinstal di sistem Anda.
Composer: Skrip ini menggunakan Composer untuk mengelola dependensi. Jika Anda belum menginstal Composer, ikuti petunjuk di Instalasi Composer.
Pustaka LZCompressor: Skrip ini menggunakan pustaka LZCompressor untuk kompresi data. Instal pustakanya menggunakan Composer:
composer require pointnet/lz-string
Variabel Lingkungan: Buat file .env di direktori yang sama dengan skrip dengan konten berikut:

SECRET_KEY=kunci_rahasia_anda
CONS_ID=id_konstan_anda
Gantilah kunci_rahasia_anda dan id_konstan_anda dengan kunci rahasia dan ID konstan sesuai kebutuhan.

File Data Sampel (sample.json): Buat file sample.json dengan konten berikut:
{
  "metaData": {
    "code": "200",
    "message": "OK"
  },
  "response": "Test 123"
}
Sesuaikan data sesuai kebutuhan.

Menjalankan Skrip
Untuk menjalankan skrip, eksekusi perintah berikut di terminal Anda:

php nama_skrip_anda.php
Gantilah nama_skrip_anda.php dengan nama sebenarnya dari skrip PHP Anda.

Penjelasan Skrip
Konfigurasi Lingkungan: Skrip ini memuat variabel lingkungan dari file .env, termasuk SECRET_KEY dan CONS_ID.

Generasi Kunci: Fungsi generateKey membuat kunci unik untuk enkripsi dan dekripsi berdasarkan waktu saat ini.

Enkripsi: Fungsi encrypt mengambil data, mengompresnya, dan kemudian mengenkripsinya menggunakan enkripsi AES-256-CBC. Hasilnya diencode dalam format base64.

Dekripsi: Fungsi decrypt membalik proses enkripsi, mengembalikan data asli.

Persiapan Data: Skrip membaca data sampel dari sample.json, yang kemudian dienkripsi dan didekripsi. Sebagai alternatif, Anda dapat menggunakan sebuah string ($dataToEncrypt = "Sample Text") sebagai sumber data.

Eksekusi: Data yang dienkripsi dan didekripsi dicetak ke konsol.

Catatan
Skrip ini ditujukan untuk keperluan pendidikan dan mungkin memerlukan langkah-langkah keamanan tambahan untuk digunakan di lingkungan produksi. Selalu perlakukan kunci enkripsi dan data sensitif dengan hati-hati.