@extends('appointment.appointment')

@section('content')
    <div class="edit-profile" id="edit-profile">
        <div class="edit-profile-head">
            <p class="display-6 font-mont font-bold"> Edit Profile</p>
        </div>
        <div class="edit-profile-form">
            <form action="{{ route('updateProfile') }}" method="post"> 
                @csrf
                @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('fail'))
        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif 
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="editFirstName">First Name</label>
                        <input id="editFirstName" name="editFirstName" class="form-control" type="text" value="{{ $firstName }}" aria-label="default input example" required>
                    </div>    
                    <div class="col-md-6">
                        <label for="editLastName">Last Name</label>
                        <input id="editLastName" name="editLastName" class="form-control" type="text" value="{{ $lastName }}" aria-label="default input example" required>
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="editMiddleName">Middle Name</label>
                        <input id="editMiddleName" name="editMiddleName" class="form-control" type="text" value="{{ $middleName }}" aria-label="default input example">
                    </div>  
                    <div class="col-md-6">
                        <label for="editSuffix">Suffix</label>
                        <input id="editSuffix" name="editSuffix" class="form-control" type="text" value="{{ $suffix }}" aria-label="default input example">
                    </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="editSchoolID">Student ID</label>
                        <input id="editSchoolID" name="editSchoolID" class="form-control" type="number" value="{{ $school_id }}" aria-label="default input example" required>
                    </div> 
                    <div class="col-md-6">
                        <label for="editCpNo">Cellphone No.</label>
                        <input id="editCpNo" name="editCpNo" class="form-control" type="text" value="{{  $cell_no }}" aria-label="default input example" required>
                    </div>    
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="editEmail">Email</label>
                        <input id="editEmail" name="editEmail" class="form-control" type="email" value="{{ $email }}" aria-label="default input example" required>
                    </div>  
                    <div class="col-md-6">
                        <label for="editAddress">Address</label>
                        <input id="editAddress" name="editAddress" class="form-control" type="text" value="{{ $address }}" aria-label="default input example" required>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-lg-6">
                        <label for="editCivilStatus">Civil Status</label>
                        <select name="editCivilStatus" class="form-control" id="editCivilStatus" name="editCivilStatus" required>
                            <option value=""{{ $civil_status == null ? 'selected' : '' }}>Choose...</option>
                            <option value="Single"{{ $civil_status == 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married"{{ $civil_status == 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Single Parent"{{ $civil_status == 'Single Parent' ? 'selected' : '' }}>Single Parent</option>
                            <option value="Widow"{{ $civil_status == 'Widow' ? 'selected' : '' }}>Widow</option>
                            <option value="Divorced"{{ $civil_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                            <option value="Annulled"{{ $civil_status == 'Annulled' ? 'selected' : '' }}>Annulled</option>
                            <option value="Separated"{{ $civil_status == 'Separated' ? 'selected' : '' }}>Separated</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label for="editBirthdate">Birthdate</label>
                        <input type="date" class="form-control" id="editBirthdate" name="editBirthdate" value="{{ $birthdate }}" required>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-lg-6">
                        <label for="editGender">Gender</label>
                        <select name="editGender" class="form-control" id="editGender" required>
                            <option value=""{{ $gender == null ? 'selected' : '' }}>Choose...</option>
                            <option value="Female"{{ $gender == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Male"{{ $gender == 'Male' ? 'selected' : '' }}>Male</option>
                        </select>
                    </div>
                    <div class="col-lg-6" id="course_loaded" style="display:none;">
                        <label for="editCourse">Course</label>
                        <select name="editCourse" class="form-control" id="editCourse">
                            <option value="">Choose...</option>
                            @foreach($courses as $course_loop)
                                <option value="{{ $course_loop->course_name }}">
                                    {{ $course_loop->course_name }}
                                </option>
                            @endforeach
                            <option value="other">Other (please specify)...</option>
                        </select>
                    </div>
                    <div class="col-lg-6" id="course_input">
                        <label for="editBirthdate">Course</label>
                        <div class="d-flex flex-row align-items-center">
                            <div class="" style="flex: 1;">
                                <input type="text" class="form-control" id="editOtherCourse" name="course_name" value="{{ $course }}" placeholder="Specify your course...">
                            </div>
                            <div>
                                <a class="btn fs-4 m-0 p-0 px-3" id="course_specify">&times;</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-lg-6">
                        <label for="editStatus">Status</label>
                        <select name="editStatus" class="form-control" id="editStatus" required>
                            <option value=""{{ $status == null ? 'selected' : '' }}>Choose...</option>
                            <option value="Junior High School"  {{ $status == 'Junior High School' ? 'selected' : '' }}>Junior High School</option>
                            <option value="Senior High School" {{ $status == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                            <option value="High School Graduate (Before K-12)" {{ $status == 'High School Graduate (Before K-12)' ? 'selected' : '' }}>High School Graduate (Before K-12)</option>
                            <option value="Senior High School Graduate" {{ $status == 'Senior High School Graduate' ? 'selected' : '' }}>Senior High School Graduate</option>
                            <option value="College Undergraduate" {{ $status == "College Undergraduate" ? 'selected' : '' }}>College Undergraduate</option>
                            <option value="College Graduate" {{ $status == "College Graduate" ? 'selected' : '' }}>College Graduate</option>
                            <option value="Master's Degree" {{ $status == "Master's Degree" ? 'selected' : '' }}>Master's Degree</option>
                            <option value="Master's Degree Graduate"  {{ $status == "Master's Degree Graduate" ? 'selected' : '' }}>Master's Degree Graduate</option>   
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <div id="edit-AcadYear" style="display:none;">
                            <label for="editAcadYear">Academic Year</label>
                            <input type="text" class="form-control" id="editAcadYear" name="editAcadYear" value="{{ $acadYear }}">
                        </div>
                        <div id="edit-GradYear" style="display:none;">
                            <label for="editGradYear">Year Graduated</label>
                            <input type="text" class="form-control" id="editGradYear" name="editGradYear" value="{{ $gradYear }}">
                        </div>
                    </div>
                </div>
                <div class="row d-flex flex-row justify-content-end my-3">
                    <button type="submit" class="btn btn-appoint font-mont font-body">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('#course_specify').click(function(){
            $('#course_loaded').show();
            $('#course_input').hide();
            $('#course_input').val("");
        });
        $('#editCourse').change(function(){
            if($('#editCourse').val() == "other"){
                $('#course_input').show();
                $('#course_loaded').hide();
                // $('#course_input').val("");
            }else{
                $('#course_input').hide();
            }
        });
    </script>
@endsection