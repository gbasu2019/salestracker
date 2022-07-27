<?php echo form_open('tbl_master_dealerinformation/edit/'.$tbl_master_dealerinformation['PK_DealerID']); ?>

	
	<div>
		DealerName : <?php echo $tbl_master_dealerinformation['DealerName'];?>
		
	</div>
	
	<div>
		CwExecutiveName : 
		<input type="text" name="cwExecutiveName" value="<?php echo ($this->input->post('cwExecutiveName') ? $this->input->post('cwExecutiveName') : $tbl_master_dealerinformation['cwExecutiveName']); ?>" />
	</div>
	<div>
		CwProductName : <?php echo $tbl_master_dealerinformation['cwProductName'];?>
		
	</div>
	<div>
		CategoryID : <?php echo $tbl_master_dealerinformation['FK_CategoryID'];?>
		
	</div>
	
	<div>
		OpeningBalance : <?php echo $tbl_master_dealerinformation['OpeningBalance'];?>
		
	</div>
	<div>
		ClosingBalance : <?php echo $tbl_master_dealerinformation['ClosingBalance'];?>
		
	</div>
	
	<button type="submit">Save</button>
	
<?php echo form_close(); ?>