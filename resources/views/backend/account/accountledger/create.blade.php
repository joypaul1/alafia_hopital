
<div class="modal-content">
    <form class="needs-validation" id="accountledger_add_form" action="{{ route('backend.account.accountledger.store') }}" method="Post"
        enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Account Ledger Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label' => 'Account Group','name' => 'account_group_id', 'optionDatas'=>$account_groups, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('account_group_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'note', 'placeholder' => 'note will be here...'])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('note')])
                </div>
               
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="" id="status">
                    <label class="form-check-label" for="status">Active ?</label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="rec_pay" id="rec_pay">
                    <label class="form-check-label" for="rec_pay">Receive/Payment Transition?</label>
                </div>
                <h3>Opening Balance</h3>
                <hr>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'balance', 'number'=>true ,'placeholder' => 'balance will be here...',  ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="debit" id="debit">
                    <label class="form-check-label" for="debit" >Debit </label>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="credit" id="credit">
                    <label class="form-check-label" for="credit">Credit </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_accountledger_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>


