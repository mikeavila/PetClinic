<?php
/*****************************************************************
*        DO NOT REMOVE                                           *
*        =============                                           *
*PetClinic Management Software                                   *
*Copyrighted 2015-2016 by Michael Avila                          *
*Distributed under the terms of the GNU General Public License   *
*This program is distributed in the hope that it will be useful, *
* but WITHOUT ANY WARRANTY; without even the implied warranty of *
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.           *
*****************************************************************/
$logFileName = "user";
$headerTitle="USER LOG";
require_once "includes/common.inc";
$mysqli = new mysqli('localhost', $user, $password, '');
?>
<form id="petform" name="petform" action="petmaintupd.php" method="post">
<table cellpadding="5" cellspacing="5" width="90%">
<tr>
     <td class="label">Pet Number</td>
     <td>
     	<input type="text" name="editpetnum" size="4" maxlength="4" READONLY value="<?php echo $editpetnum; ?>">
     </td>
     <td>&nbsp;</td>
     <td class="label">
         <label for="petname">
             Pet Name 
         </label>
     </td>
     <td class="field">
         <input id="petname" name="petname" type="text" size="15" maxlength="15" value="<?php echo $petname;?>"> 
     </td>
     <td class="status"></td>
     <td colspan="3">&nbsp;</td>
</tr>
<tr>
     <td class="label">
         <label for="dobm">
             Date of Birth Month
         </label>
     </td>
     <td class="field">
         <input id="dobm" name="dobm" type="text" size="2" maxlength="2" value="<?php echo $dobm;?>"> 
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="dobd">
             Date of Birth Day
         </label>
     </td>
     <td class="field">
         <input id="dobd" name="dobd" type="text" size="2" maxlength="2" value="<?php echo $dobd;?>"> 
     </td>
     <td class="status"></td>
     <td class="label">
         <label for="dobm">
             Date of Birth Year
         </label>
     </td>
     <td class="field">
         <input id="doby" name="doby" type="text" size="4" maxlength="4" value="<?php echo $doby;?>"> 
     </td>
     <td class="status"></td>
</tr>
<?php
if (!is_numeric($editpetnum)) {
	$speciescd = $_COOKIE["speciescd"];
	$speciesname = substr($speciescd, 1);
	$speciescode = substr($speciescd, 0, 1);
} else {
	$sql = "SELECT * FROM `petclinic`.`code_species` WHERE `speciescode` = \"".$petspecies."\";";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
		//setcookie("errormessage", "Internal error for code_species", $expire1hr);
          put_errormsg("Internal error for code_species");
          redirect("mainmenu.php");           
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
		//setcookie("errormessage", "Internal error for code_species", $expire1hr);
          put_errormsg("Internal error for code_species");
          redirect("mainmenu.php");           
		exit();
	}
	$speciesname = "";
	while ( $row = $result->fetch_row() ) {
		if ($petspecies == $row[0]) {
			$speciesname = $row[1];
			$speciescode = $petspecies;
			break;
		}
	}
}
?>
<tr>
	<td class="label">Species</td>
	<td>
		<input type="text" name="petspecies" size="20" maxlength="20" READONLY value="<?php echo $speciesname;?>">
		<input type="hidden" name="petspecies" value="<?php echo $speciescode;?>"></td>
	<td>&nbsp;</td>
	<td class="label">Breed</td>
	<td> 
		<SELECT name="petbreed">
<?php
$sql = "SELECT * FROM `petclinic`.`code_breed` WHERE `breedcode` LIKE \"".$speciescode."%\" ORDER BY `breeddesc`;";
	$result = $mysqli->query($sql);
	if ($result == FALSE)
	{
		//setcookie("errormessage", "Internal error for code_breed", $expire1hr);
          put_errormsg("Internal error for code_breed");
          redirect("mainmenu.php");           
	}
	$row_cnt = $result->num_rows;
	if ($row_cnt == 0) {
		//setcookie("errormessage", "Internal error for code_breed", $expire1hr);
          put_errormsg("Internal error for code_breed");
          redirect("mainmenu.php");           
		exit();
	}
	$petbreed1 = $petbreed;
	for ($i = 0; $i < $row_cnt; $i++) {
		$row = $result->fetch_row();
		$petbreed = substr($row[0], 1, 2);
		echo '<option value="' . $petbreed . '"';
		if ($petbreed1 <> "") {
			if ($petbreed == $petbreed1) {
				echo ' SELECTED ';
			}
		}
		echo '>' . $row[1] . '</option>';
	}
?>
		</select>
	</td>
	<td>&nbsp;</td>
	<td class="label">Gender</td>
	<td>
		<select name="petgender">
<?php
	echo '<option value="M"' . ($petgender == "M" ? ' selected' : '') . '>Male</option>';
	echo '<option value="F"' . ($petgender == "F" ? ' selected' : '') . '>Female</option>';
     echo '</select></td></tr>';
     echo '<tr><td class="label">Fixed</td><td><select name="petfixed">';
     echo '<option value="Y"' . ($petfixed == "Y" ? ' selected' : '') . '>Yes</option>';
     echo '<option value="N"' . ($petfixed == "N" ? ' selected' : '') . '>No</option>';
?>
		</select>
	</td>
	<td>&nbsp;</td>
	<td class="label">Description</td>
	<td colspan="4">
		<input name="petdesc" type="text" size="50" maxlength="50" value= "<?php echo $petdesc; ?>">
	</td>
	<td class="status"></td>
</tr>
<tr>
	<td class="label">Color</td>
	<td>
		<input name="petcolor" type="text" size="20" maxlength="20" value= "<?php echo $petcolor;?>">
	</td>
	<td>&nbsp;</td>
	<td class="label">License</td>
	<td>
		<input name="license" type="text" size="15" maxlength="15" value= "<?php echo $license; ?>">
	</td>
	<td>&nbsp;</td>
	<td class="label">Microchip</td>
	<td>
		<input name="microchip" type="text" size="18" maxlength="18" value= "<?php echo $microchip; ?>">
	</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="label">RabiesTag</td>
	<td>
		<input name="rabiestag" type="text" size="10" maxlength="10" value= "<?php echo $rabiestag; ?>">
	</td>
	<td>&nbsp;</td>
	<td class="label">Tattoo Number</td>
	<td>
		<input name="tattoonumber" type="text" size="10" maxlength="10" value= "<?php echo $tattoonumber; ?>">
	</td>
	<td>&nbsp;</td>
	<td class="label">Picture</td>
	<td>
		<input name="picture" type="text" size="1" maxlength="1" value= "<?php echo $picture; ?>">
	</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td class="label">Status</td>
	<td>
		<input type="text" name="status" size="1" maxlength="1" value="<?php echo $status; ?>">
	</td>
	<td>&nbsp;</td>
</tr>
<?php
$sqlclient="SELECT * FROM `petclinic`.`clientpet` WHERE `petnumber` = \"".$editpetnum."\";";
$resultpc = $mysqli->query($sqlclient);
$clientpc = array_fill(0, 10, "");
if ($resultpc <> FALSE)
	{
	$row_cntpc = $resultpc->num_rows;
	if ($row_cntpc == 0) {
		$clientpc[$i] = "";
	} else {
		for ($i = 0; $i < $row_cntpc; $i++) {
			$rowpc = $resultpc->fetch_row();
			$clientpc[$i] = $rowpc[$i];
		}	
	}				
} else {
	$clientpc[0] = "";
}

$mysqli->close();
?>
<tr>
	<td class="center" colspan="3"><a href="petmaintc.php" target="_blank"> Click Here </a> to get a list of Clients</td>
	<td class="center" colspan="3">This pet belongs to the this/these client/clients; enter the client number(s)&nbsp;
		<input type="text" name="client1" size="5" maxlength="5" value="<?php echo $clientpc[0]; ?>">
 		<input type="text" name="client2" size="5" maxlength="5" value="<?php echo $clientpc[1]; ?>">
 	</td>
<?php
if (is_numeric($editpetnum)) {
	echo '<td class="center" colspan="3">Do you want to upload a pet picture? <select name="petpic">';
    echo '<option value="N" selected>No</option><option value="Y">Yes</option></select>';
    echo '<input type="hidden" name="petid" value="' . $editpetnum . '"></td>';
}
echo '</tr></table><br>';
echo '<div class="center"><input type="submit" value="Create/Update Pet"></div></form><br>';
echo '<div class="center"><form action="maintmenu.php"><input type="submit" value="Return to Maint Menu"></form></div><br>';

require_once 'includes/display_errormsg.inc';
?>