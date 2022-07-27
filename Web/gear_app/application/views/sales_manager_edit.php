<?php echo form_open('tbl_master_manager_salesexecutive/edit/'.$tbl_master_manager_salesexecutive['PK_Manager_SalesExecutiveID']); ?>

	<div>
		Tbl Master Location : 
		<select name="FK_LocationID">
			<option value="">select tbl_master_location</option>
			<?php 
			foreach($all_tbl_master_location as $tbl_master_location)
			{
				$selected = ($tbl_master_location['PK_LocationID'] == $tbl_master_manager_salesexecutive['FK_LocationID']) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_location['PK_LocationID'].'" '.$selected.'>'.$tbl_master_location['Location_name'].'</option>';
			} 
			?>
		</select>
	</div>
	<div>
		Tbl Master Company : 
		<select name="FK_CompanyID">
			<option value="">select tbl_master_company</option>
			<?php 
			foreach($all_tbl_master_company as $tbl_master_company)
			{
				$selected = ($tbl_master_company['PK_CompanyID'] == $tbl_master_manager_salesexecutive['FK_CompanyID']) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_company['PK_CompanyID'].'" '.$selected.'>'.$tbl_master_company['Company_name'].'</option>';
			} 
			?>
		</select>
	</div>
	<div>
		Tbl Master Userinformation : 
		<select name="FK_USER_SalesExecutiveID">
			<option value="">select tbl_master_userinformation</option>
			<?php 
			foreach($all_tbl_master_userinformation as $tbl_master_userinformation)
			{
				$selected = ($tbl_master_userinformation['PK_UserID'] == $tbl_master_manager_salesexecutive['FK_USER_SalesExecutiveID']) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_userinformation['PK_UserID'].'" '.$selected.'>'.$tbl_master_userinformation['Name'].'</option>';
			} 
			?>
		</select>
	</div>
	<div>
		Tbl Master Userinformation : 
		<select name="FK_User_MangerID">
			<option value="">select tbl_master_userinformation</option>
			<?php 
			foreach($all_tbl_master_userinformation as $tbl_master_userinformation)
			{
				$selected = ($tbl_master_userinformation['PK_UserID'] == $tbl_master_manager_salesexecutive['FK_User_MangerID']) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_master_userinformation['PK_UserID'].'" '.$selected.'>'.$tbl_master_userinformation['Name'].'</option>';
			} 
			?>
		</select>
	</div>
	<div>
		FK CreatedBy : 
		<input type="text" name="FK_CreatedBy" value="<?php echo ($this->input->post('FK_CreatedBy') ? $this->input->post('FK_CreatedBy') : $tbl_master_manager_salesexecutive['FK_CreatedBy']); ?>" />
	</div>
	<div>
		CreatedDate : 
		<input type="text" name="CreatedDate" value="<?php echo ($this->input->post('CreatedDate') ? $this->input->post('CreatedDate') : $tbl_master_manager_salesexecutive['CreatedDate']); ?>" />
	</div>
	<div>
		FK ModifyBy : 
		<input type="text" name="FK_ModifyBy" value="<?php echo ($this->input->post('FK_ModifyBy') ? $this->input->post('FK_ModifyBy') : $tbl_master_manager_salesexecutive['FK_ModifyBy']); ?>" />
	</div>
	<div>
		ModifyDate : 
		<input type="text" name="ModifyDate" value="<?php echo ($this->input->post('ModifyDate') ? $this->input->post('ModifyDate') : $tbl_master_manager_salesexecutive['ModifyDate']); ?>" />
	</div>
	<div>
		IsActive : 
		<input type="text" name="IsActive" value="<?php echo ($this->input->post('IsActive') ? $this->input->post('IsActive') : $tbl_master_manager_salesexecutive['IsActive']); ?>" />
	</div>
	<div>
		SalesExecutiveName : 
		<input type="text" name="SalesExecutiveName" value="<?php echo ($this->input->post('SalesExecutiveName') ? $this->input->post('SalesExecutiveName') : $tbl_master_manager_salesexecutive['SalesExecutiveName']); ?>" />
	</div>
	<div>
		ManagerName : 
		<input type="text" name="ManagerName" value="<?php echo ($this->input->post('ManagerName') ? $this->input->post('ManagerName') : $tbl_master_manager_salesexecutive['ManagerName']); ?>" />
	</div>
	
	<button type="submit">Save</button>
	
<?php echo form_close(); ?>