<?php 
$no=0;
foreach($list->result_array() as $row)
    {
      $no++;
 ?>

  <tr class="text-right">
    <td class="text-left"><?= $no; ?></td>
    <td class="text-left"><?= $row['nama_produk']; ?></td>
    <td class="text-right"><?= number_format($row['harga']); ?></td>
    <td><?= $row['jumlah']; ?></td>
    <td><?= number_format($row['diskon']); ?></td>
    <td><?= number_format($row['total']); ?></td>
  </tr>

 <?php 
}

  ?>