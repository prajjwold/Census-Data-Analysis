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
</table>
</body>
