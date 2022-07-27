<?php echo form_open('tbl_master_dealerinformation/add'); ?>

	<div>
		FK CreatedBy : 
		<input type="text" name="FK_CreatedBy" value="<?php echo $this->input->post('FK_CreatedBy'); ?>" />
	</div>
	<div>
		CreatedDate : 
		<input type="text" name="CreatedDate" value="<?php echo $this->input->post('CreatedDate'); ?>" />
	</div>
	<div>
		FK ModifyBy : 
		<input type="text" name="FK_ModifyBy" value="<?php echo $this->input->post('FK_ModifyBy'); ?>" />
	</div>
	<div>
		ModifyDate : 
		<input type="text" name="ModifyDate" value="<?php echo $this->input->post('ModifyDate'); ?>" />
	</div>
	<div>
		IsActive : 
		<input type="text" name="IsActive" value="<?php echo $this->input->post('IsActive'); ?>" />
	</div>
	<div>
		FK LocationID : 
		<input type="text" name="FK_LocationID" value="<?php echo $this->input->post('FK_LocationID'); ?>" />
	</div>
	<div>
		FK CompanyID : 
		<input type="text" name="FK_CompanyID" value="<?php echo $this->input->post('FK_CompanyID'); ?>" />
	</div>
	<div>
		DealerName : 
		<input type="text" name="DealerName" value="<?php echo $this->input->post('DealerName'); ?>" />
	</div>
	<div>
		GUID : 
		<input type="text" name="GUID" value="<?php echo $this->input->post('GUID'); ?>" />
	</div>
	<div>
		CwCategory : 
		<input type="text" name="cwCategory" value="<?php echo $this->input->post('cwCategory'); ?>" />
	</div>
	<div>
		CwExecutiveName : 
		<input type="text" name="cwExecutiveName" value="<?php echo $this->input->post('cwExecutiveName'); ?>" />
	</div>
	<div>
		CwProductName : 
		<input type="text" name="cwProductName" value="<?php echo $this->input->post('cwProductName'); ?>" />
	</div>
	<div>
		FK CategoryID : 
		<input type="text" name="FK_CategoryID" value="<?php echo $this->input->post('FK_CategoryID'); ?>" />
	</div>
	<div>
		DealerName Alias : 
		<input type="text" name="DealerName_Alias" value="<?php echo $this->input->post('DealerName_Alias'); ?>" />
	</div>
	<div>
		Product : 
		<input type="text" name="Product" value="<?php echo $this->input->post('Product'); ?>" />
	</div>
	<div>
		Address : 
		<input type="text" name="Address" value="<?php echo $this->input->post('Address'); ?>" />
	</div>
	<div>
		Town City Village : 
		<input type="text" name="Town_City_Village" value="<?php echo $this->input->post('Town_City_Village'); ?>" />
	</div>
	<div>
		District : 
		<input type="text" name="District" value="<?php echo $this->input->post('District'); ?>" />
	</div>
	<div>
		Pin Code : 
		<input type="text" name="Pin_Code" value="<?php echo $this->input->post('Pin_Code'); ?>" />
	</div>
	<div>
		Phone Number : 
		<input type="text" name="Phone_Number" value="<?php echo $this->input->post('Phone_Number'); ?>" />
	</div>
	<div>
		Mobile Number : 
		<input type="text" name="Mobile_Number" value="<?php echo $this->input->post('Mobile_Number'); ?>" />
	</div>
	<div>
		Category : 
		<input type="text" name="Category" value="<?php echo $this->input->post('Category'); ?>" />
	</div>
	<div>
		Sales Executive : 
		<input type="text" name="Sales_Executive" value="<?php echo $this->input->post('Sales_Executive'); ?>" />
	</div>
	<div>
		State : 
		<input type="text" name="State" value="<?php echo $this->input->post('State'); ?>" />
	</div>
	<div>
		Credit Days : 
		<input type="text" name="Credit_Days" value="<?php echo $this->input->post('Credit_Days'); ?>" />
	</div>
	<div>
		Credit Limit : 
		<input type="text" name="Credit_Limit" value="<?php echo $this->input->post('Credit_Limit'); ?>" />
	</div>
	<div>
		Vat No : 
		<input type="text" name="Vat_No" value="<?php echo $this->input->post('Vat_No'); ?>" />
	</div>
	<div>
		PAN IT No : 
		<input type="text" name="PAN_IT_No" value="<?php echo $this->input->post('PAN_IT_No'); ?>" />
	</div>
	<div>
		GSTIN : 
		<input type="text" name="GSTIN" value="<?php echo $this->input->post('GSTIN'); ?>" />
	</div>
	<div>
		E-Mail : 
		<input type="text" name="E-Mail" value="<?php echo $this->input->post('E-Mail'); ?>" />
	</div>
	<div>
		Contact Person : 
		<input type="text" name="Contact_Person" value="<?php echo $this->input->post('Contact_Person'); ?>" />
	</div>
	<div>
		Notes : 
		<input type="text" name="Notes" value="<?php echo $this->input->post('Notes'); ?>" />
	</div>
	<div>
		Alias : 
		<input type="text" name="Alias" value="<?php echo $this->input->post('Alias'); ?>" />
	</div>
	<div>
		Send SMS : 
		<input type="text" name="Send_SMS" value="<?php echo $this->input->post('Send_SMS'); ?>" />
	</div>
	<div>
		Sync : 
		<input type="text" name="Sync" value="<?php echo $this->input->post('Sync'); ?>" />
	</div>
	<div>
		OpeningBalance : 
		<input type="text" name="OpeningBalance" value="<?php echo $this->input->post('OpeningBalance'); ?>" />
	</div>
	<div>
		ClosingBalance : 
		<input type="text" name="ClosingBalance" value="<?php echo $this->input->post('ClosingBalance'); ?>" />
	</div>
	
	<button type="submit">Save</button>

<?php echo form_close(); ?>