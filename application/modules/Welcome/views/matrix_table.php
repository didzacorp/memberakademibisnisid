<style>
table, th, td {
    border: 1px solid black;
    font-size: 9;
    font-family: sans-serif;
}
</style>

<html>
<body>
    <table>
        <tr>
            <td>No</td>
            <td>Item</td>
            <?php 
            $i=1;
            foreach($date['list']->result_array() as $date)
                {?>
                <td><?= substr($date['TransDate'],8,2)?></td>
            <?php }?>
        </tr>
        <?php 
        $i=1;
        foreach($item['list']->result_array() as $item)
        {?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $item['SKU'].' - '.$item['Description']?></td>
            </tr>
        
        <?php }?>
    </table>
</body>
</html>