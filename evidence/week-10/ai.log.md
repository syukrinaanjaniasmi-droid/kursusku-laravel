Ai yang di pakai claude ai

1. Error namespace di CourseController
- Tujuan: memperbaiki error Namespace declaration statement has to be the very first statement.
- Saran AI: hapus baris kosong sebelum <?ph.
- Keputusan: diterima.
- Alasan: <?php sebelumnya berada di baris 2.
- Test: buka /courses/create.

2. Error view tidak ditemukan
- Tujuan: memperbaiki error pada view('courses.create').
- Saran AI: periksa nama folder dan file view.
- Keputusan: diterima.
- Alasan: nama folder salah ketik cources, diganti menjadi courses.
- Test: buka /courses/create.

3. Error Vite di layout
- Tujuan: memperbaiki error pada baris `@vite(...)`.
- Saran AI: jalankan `npm install` lalu `npm run build` atau `npm run dev`.
- Keputusan: diterima.
- Alasan: manifest Vite belum dibuat.
- Test: halaman tampil normal.