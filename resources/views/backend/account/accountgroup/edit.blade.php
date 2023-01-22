<div class="modal-content">
    <form class="needs-validation" id="accountgroup_edit_form" action="{{ route('backend.account.accountgroup.update', $accountgroup) }}" method="Post"
        enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Account Group Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $accountgroup->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label' => 'Account Head','name' => 'account_head_id', 'optionDatas'=>$account_heads,'selectedKey'=>  $accountgroup->account_head_id ,'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('account_head_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'note', 'value' => $accountgroup->note, 'placeholder' => 'name will be here...', 'placeholder' => 'note will be here...', ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('note')])
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$accountgroup->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>
               
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_accountgroup_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>
<script >
   
    
</script>