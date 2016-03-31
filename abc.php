<div class="modal fade disp-none" tabindex="-1" role="dialog"  id="signup_modal">
   <div class="modal-dialog modal-member">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="56b0cc608eb73_memberModalRegisterLabel">Sign Up</h4>
         </div>
         <div class="modal-body" ng-controller="formCtrl">
            <form class="noo-ajax-register-form form-horizontal" name="form"  novalidate id="referral-form" method="post">
               <div class="form-group row">
                  <label for="referral_code" class="col-sm-9 text-bold form-label">Referral Code</label>
                  <div class="col-sm-9">
                     <input type="text" class="user_login form-control"  ng-model="user.referral_code" name="uCode" placeholder="Referral" required>
                     <div ng-show="form.$submitted || form.uCode.$touched">
                        <div ng-show="form.uCode.$error.required" class="error-msg">Referral Code is required.</div>
                     </div>
                     <div id="invalid_code" class="error-msg disp-none">Invalid Referral Code.</div>
                     <div id="used_code" class="error-msg disp-none">Referral Code is already been used.</div>
                  </div>
               </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary text-bold"  ng-click="referral_code(user);">Submit</button>
               </div>
            </form>
            <form class="noo-ajax-register-form form-horizontal disp-none" name="form" id="signup-form" novalidate  method="post">
               <div class="form-group text-center noo-ajax-result" style="display: none"></div>
               <div class="form-group row user_login_container">
                  <label for="name" class="col-sm-9 text-bold form-label">Name</label>
                  <div class="col-sm-9">
                     <input type="text" class="user_login form-control" ng-model="user.name" name="uName"  placeholder="Name" required>
                     <div ng-show="form.$submitted || form.uName.$touched">
                        <div ng-show="form.uName.$error.required" class="error-msg">Name is required.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="name" class="col-sm-9 text-bold form-label">Mobile</label>
                  <div class="col-sm-9">
                     <input type="text" ng-model="user.mnumber" name="uMNumber" class="user_login form-control"   ng-minlength="10"   ng-maxlength="15" ng-pattern="/^[- +()]*[0-9][- +()0-9]*$/" placeholder="Mobile Number" required>
                     <div ng-show="form.$submitted || form.uMNumber.$touched">
                        <div ng-show="form.uMNumber.$error.required" class="error-msg">Mobile Number is required.</div>
                        <div ng-show="(!form.uMNumber.$valid ||form.uMNumber.$error.pattern) && !form.uMNumber.$error.required && user.mnumber!=''" class="error-msg">This is not a valid Mobile Number.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="email" class="col-sm-9 text-bold form-label">Email</label>
                  <div class="col-sm-9">
                     <input type="email" class="user_login form-control" ng-model="user.email" name="uEmail"  ng-pattern="/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" placeholder="Email">
                     <div ng-show="form.$submitted || form.uEmail.$touched">
                        <div ng-show="form.uEmail.$error.email||form.uEmail.$error.pattern" class="error-msg">This is not a valid Email-Id.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="email" class="col-sm-9 text-bold form-label">Password</label>
                  <div class="col-sm-9">
                     <input type="password" class="user_login form-control" ng-model="user.password" id="uPassword" name="uPassword"  ng-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/" placeholder="Password" required ng-required>
                     <div ng-show="form.$submitted || form.uPassword.$touched">
                        <div ng-show="form.uPassword.$error.required" class="error-msg">Password is required.</div>
                        <div ng-show="form.uPassword.$error.password||form.uPassword.$error.pattern" class="error-msg">This is not a valid Password.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="email" class="col-sm-9 text-bold form-label">Confirm Password</label>
                  <div class="col-sm-9">
                     <input type="password" class="user_login form-control" ng-model="user.confirm_password" pw-check="uPassword" id="uConfirmpassword" name="uConfirmpassword"  ng-pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/" placeholder="Confirm Password" required ng-required>
                     <div ng-show="form.$submitted || form.uConfirmpassword.$touched">
                         <div ng-show="form.uConfirmpassword.$error.required" class="error-msg">Confirm Password is required.</div>
                         <div ng-show="form.uConfirmpassword.$error.pwmatch" class="error-msg">Passwords don't match.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="dob" class="col-sm-9 text-bold form-label">Date of Birth</label>
                  <div class="col-sm-9">
                     <input type="text" class="user_login form-control" ui-date ng-model="user.dob"  name="uDOB" placeholder="Date of Birth" required>
                     <div ng-show="form.$submitted || form.uDOB.$touched">
                        <div ng-show="form.uDOB.$error.required" class="error-msg">Date of Birth is required.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="gender" class="col-sm-9 text-bold form-label">Gender</label>
                  <div class="col-sm-9 text-left">
                     <input type="radio" ng-model="user.gender" value="Male"  class="form-label"  name="uGender">Male
                     <input type="radio"  ng-model="user.gender" value="Female" name="uGender">Female
                     <div ng-show="form.$submitted || form.uGender.$touched">
                        <div ng-show="form.uGender.$error.required" class="error-msg">Gender is required.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="Pincode" class="col-sm-9 text-bold form-label">Location</label>
                  <div class="col-sm-9">
                     <div class="form-control-flat">
                        <select class="user_role" name="uLocation" ng-model="user.location" required>
                           <option value="">-Select-</option>
                           <option ng-repeat="pincode in pincodes" value="{{pincode}}" ng-bind="pincode"></option>
                        </select>
                        <i class="fa fa-caret-down"></i>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="Profiles" class="col-sm-9 text-bold form-label">Interested Profiles</label>
                  <div class="col-sm-9">
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" name="uPromoters"  ng-model="user.promoters">Promoters</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" name="uHostesses" ng-model="user.hostesses">Hostesses</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" name="uEmCees" ng-model="user.emcess">EmCees</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" name="uPamphlet" ng-model="user.pamphlet">Pamphlet Distributors</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" name="uModels" ng-model="user.models">Models</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" name="uOtherprofile" ng-model="user.othersprof">Others</label>
                     <div class="col-sm-9 pad-left0 form-others" ng-show="user.othersprof">
                        <input type="text" class="user_login form-control" ng-model="user.other_profile" name="uOTherprofile"  placeholder="Please enter any other skill">
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="Language" class="col-sm-9 text-bold form-label">Languages known</label>
                  <div class="col-sm-9">
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox"  id="uEnglish"  ng-model="user.english">English</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" id="uHindi" ng-model="user.hindi">Hindi</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" id="uKannada" ng-model="user.kannada">Kannada</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" id="uTamil" ng-model="user.tamil">Tamil</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" id="uMalayalam" ng-model="user.malayam">Malayalam</label>
                     <label class="col-sm-6 pad-left0 text-left"><input type="checkbox" id="uOtherlanguage" ng-model="user.others">Others</label>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="vehicle" class="col-sm-9 text-bold form-label">Do you Own a 2-Wheeler</label>
                  <div class="col-sm-9 text-left">
                     <input type="radio" ng-model="user.vehicle" value="yes"  class="form-label"  name="uVehicle">Yes
                     <input type="radio"  ng-model="user.vehicle" value="no" name="uVehicle">No
                     <div ng-show="form.$submitted || form.uVehicle.$touched">
                        <div ng-show="form.uVehicle.$error.required" class="error-msg">Please enter whether you possess a 2-wheeler or not.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <label for="laptop" class="col-sm-9 text-bold form-label">Do you have a laptop</label>
                  <div class="col-sm-9 text-left">
                     <input type="radio" ng-model="user.laptop" value="yes"  class="form-label"  name="uLaptop">Yes
                     <input type="radio"  ng-model="user.laptop" value="no" name="uLaptop">No
                     <div ng-show="form.$submitted || form.uLaptop.$touched">
                        <div ng-show="form.uLaptop.$error.required" class="error-msg">Please enter whether you possess a laptop or not.</div>
                     </div>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <div class="col-sm-9">
                     <label class="col-sm-12 pad-left0 text-left"><input type="checkbox"  id="uTerms"  ng-model="user.terms" required>Please accept the terms and conditions</label>
                  </div>
               </div>
               <div class="form-group row user_login_container">
                  <div class="col-sm-9">
                     <div class="g-recaptcha" data-sitekey="6LepPRcTAAAAANv40rrqC14V_dlYWcf2K­OX­Gvd"></div>
                  </div>
               </div>
               <div class="form-group text-center">
                  <button type="submit" class="btn btn-primary" ng-click="signup_user(user);">Sign Up</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
