<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header bg-info"> <button type="button" class="close" data-dismiss="modal">&times;</button> 
		<h4 class="modal-title"><?=lang('edit')?> Bank</h4>
		</div><?php
			 $attributes = array('class' => 'bs-example form-horizontal');
          echo form_open(base_url().'bank/view/update',$attributes); ?>
          <?php if (!empty($banks)) {
		foreach ($banks as $key => $bank) { ?>
		<div class="modal-body">
			<input type="hidden" name="bank_id" value="<?=$bank->id?>">
			<div class="form-group">
				<label class="col-lg-4 control-label">Bank Name<?//=lang('bank_name')?> <span class="text-danger">*</span></label>
				<div class="col-lg-8">
					<input type="text" class="form-control" value="<?=$bank->bname?>" name="bname" required>
				</div>
			</div>
		</div>
		<div class="modal-footer"> <a href="#" class="btn btn-default" data-dismiss="modal"><?=lang('close')?></a> 
		<input type="submit" class="btn btn-info" value="<?=lang('save_changes')?>">
		</form>
		<?php } } ?>
		</div>
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->