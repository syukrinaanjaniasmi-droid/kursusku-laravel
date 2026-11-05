| No | Skenario | Input utama | Hasil yang diharapkan | Status |
| 1 | Simpan data valid | Semua field valid | Data tersimpan, redirect ke index, pesan sukses | | [ ] Lulus |
| 2 | Kode kosong | code kosong | Validasi gagal, data tidak tersimpan | | [ ] Lulus |
| 3 | Kode duplikat | WEB-101 kedua kali | Ditolak rule unique | | [ ] Lulus |
| 4 | Nama kosong | name kosong | Validasi gagal | | [ ] Lulus |
| 5 | Biaya negatif | fee = -1000 | Ditolak karena min:0 | | [ ] Lulus |
| 6 | Kuota 0 | quota = 0 | Ditolak karena min:1 | | [ ] Lulus |
| 7 | Status tidak valid | ubah manual menjadi active | Ditolak, hanya draft/open/closed | | [ ] Lulus |
| 8 | Daftar tampil ulang | Reload /courses | Data tetap ada karena berasal dari MySQL | | [ ] Lulus |