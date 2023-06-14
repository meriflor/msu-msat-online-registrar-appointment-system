@extends('appointment.appointment')

@section('content')
    <div class="account-settings" id="account-settings">
        <div class="account-settings-head">
            <p class="display-6 font-mont font-bold">Account Settings</p>
        </div>
        <div class="account-form mt-5">
            <h5 class="font-bold">Change password</h5>
            <hr>
            <form action="" method="post">
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="">Password</label>
                        <input class="form-control form-control" type="password" placeholder="" aria-label="default input example">
                    </div>    
                    <div class="col-md-6">
                        <label for="">Re-type password</label>
                        <input class="form-control form-control" type="password" placeholder="" aria-label="default input example">
                    </div>  
                </div>
                <div class="row d-flex flex-row justify-content-end my-3">
                    <button type="submit" class="btn btn-appoint font-mont font-body">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection