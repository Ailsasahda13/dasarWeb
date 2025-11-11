<?php
session_start();
include 'koneksi.php';

$query = "SELECT * FROM anggota ORDER BY id DESC";
$result = pg_query($koneksi, $query);
?>

<table id="example" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (pg_num_rows($result) > 0): $no = 1; ?>
            <?php while ($row = pg_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                    <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td><?= htmlspecialchars($row['no_telp']); ?></td>
                    <td>
                        <button id="<?= $row['id']; ?>" class="btn btn-success btn-sm edit_data">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button id="<?= $row['id']; ?>" class="btn btn-danger btn-sm hapus_data">
                            <i class="fa fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">Tidak ada data ditemukan</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();

    $(document).on('click', '.edit_data', function() {
        var id = $(this).attr('id');
        var token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: 'get_data.php',
            data: { id: id, csrf_token: token },
            dataType: 'json',
            success: function(res) {
                if (res.error) {
                    alert(res.error);
                    return;
                }
                $('#id').val(res.id);
                $('#nama').val(res.nama);
                $('#alamat').val(res.alamat);
                $('#no_telp').val(res.no_telp);
                if (res.jenis_kelamin === "L") $('#jenkel1').prop('checked', true);
                else $('#jenkel2').prop('checked', true);
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        });
    });

    $(document).on('click', '.hapus_data', function() {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            var id = $(this).attr('id');
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: 'hapus_data.php',
                data: { id: id, csrf_token: token },
                success: function() {
                    alert('Data berhasil dihapus!');
                    $('.data').load('data.php');
                }
            });
        }
    });
});
</script>
