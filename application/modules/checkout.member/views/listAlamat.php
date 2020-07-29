<?php 
  $no=0;
  foreach($list->result_array() as $row)
      {
        $no++;
   ?>

    <tr class="text-right">
      <td class="text-left"><?= $no; ?></td>
      <td class="text-left"><?= $row['nama_history']; ?></td>
      <td class="text-left"><?= $row['alamat']; ?></td>
      <td class="text-left">
        <a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="getHistory('<?= $row['id']?>');">
          <i class=" icon-check menu-icon"></i>
        </a>
      </td>
    </tr>

   <?php 
  }
?>