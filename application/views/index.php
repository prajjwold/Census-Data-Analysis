<body>
<b>Hello There !</b><br/>  

<table border="1px">
<th>year</th>
<th>district id</th>
<th>district name</th>
<th>bhramin</th>
<th>chhetri</th>
<th>newar</th>
<th>cluster id </th>
<th>total count</th>
<th>latitude</th>
<th>longitude</th>
<?php foreach($cluster_info as $cluster): 
?>
<tr>
<td><?php echo $cluster->yr; ?> </td>
<td><?php echo $cluster->dst_id; ?> </td>
<td><?php echo $cluster->dst_nme; ?> </td>
<td><?php echo $cluster->bhramin; ?> </td>
<td><?php echo $cluster->chhetri; ?> </td>
<td><?php echo $cluster->newar; ?> </td>
<td><?php echo $cluster->clst_id; ?> </td>
<td><?php echo $cluster->tot_cnt; ?> </td>
<td><?php echo $cluster->lat; ?> </td>
<td><?php echo $cluster->lng; ?> </td>
</tr>
<?php  
endforeach; ?>

<?php 
$ethnicity = array("bhramin","chhetri","newar");
$districts = array();
$k = array();
$eth = array();
for($i=1;$i<4;$i++)
{
    for($w=1;$w<4;$w++)
    $eth[$i][$w] = 0;
}
for($i=1;$i<4;$i++)
{
    $j=1;
    foreach($cluster_info as $cluster)
    {
        if($cluster->clst_id==$i)
        {
            $districts[$i][$j] = $cluster->dst_nme;
            $j++;
            for($w=1;$w<4;$w++)
            {
                $eth[$i][$w] = $eth[$i][$w]+$cluster->$ethnicity[$w-1];
            }
            
        }
    }
    $k[$i] = $j-1;
    
}

for($i=1;$i<4;$i++)
{
    echo "cluster number : ".$i."# ";
    for($w=1;$w<4;$w++)
    {
        echo $ethnicity[$w-1].":".$eth[$i][$w]; echo " ";
    }
    echo " DISTRICTS: ";
    for($x=1;$x<$k[$i];$x++)
    {
        echo $districts[$i][$x].",";
    }
    
    echo "<br><br><br>";
}


?>
</table>
</body>
