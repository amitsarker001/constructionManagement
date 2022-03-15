<?php
/**
 * Created By: Amit Sarker
 * Created Date: 20-08-2020
 */
?>
<div id="personalInfo" class="personalInfo w-100">
    <table>
        <tbody>
        <tr>
            <td><label>1. Name of the Assessee:&nbsp;</label></td>
            <td><label>{{$customerName}}</label></td>
        </tr>
        <tr>
            <td><label>2. National ID No <small>(if any):&nbsp;</small></label></td>
            <td><label>{{$nid}}</label></td>
        </tr>
        <tr>
            <td><label>3. UTIN <small>(if any):&nbsp;</small></label></td>
            <td><label>
                    <table>
                        <tbody>
                        <tr>
                            <td>1</td>
                        </tr>
                        </tbody>
                    </table>
                </label></td>
        </tr>
        <tr>
            <td><label>4. TIN:&nbsp;</label></td>
            <td><label>{{$tin}}</label></td>
        </tr>
        <tr>
            <td><label>5. ETIN:&nbsp;</label></td>
            <td><label>{{$etin}}</label></td>
        </tr>
        <tr>
            <td><label>6. (a) Taxes Circle:&nbsp;</label></td>
            <td><label>{{$taxCircle}}</label></td>
            <td><label>(b) Taxes Zone:</label></td>
            <td><label>{{$taxZone}}</label></td>
        </tr>
        <tr>
            <td><label>7. Assessment Year:&nbsp;</label></td>
            <td><label>{{$assessmentYear}}</label></td>
            <td><label>8. Residential Status:</label></td>
            <td><label>{{$residentialStatus}}</label></td>
        </tr>


        </tbody>
    </table>
    <div class="form-group row">

        <div class="col-sm-10">
            <input type="text" class="form-control" id="nationIdNo"
                   value="{{!empty($customerInfo->nid) ? $customerInfo->nid : ''}}" name="nid"
                   placeholder="National ID No">
        </div>
    </div>
    <div class="form-group row">
        <label for="utin" class="col-sm-2 col-form-label font-weight-bold">UTIN (if
            any)</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="utin"
                   value="{{!empty($customerInfo->utin) ? $customerInfo->utin : ''}}" name="utin" placeholder="UTIN">
        </div>
    </div>
    <div class="form-group row">
        <label for="tin" class="col-sm-2 col-form-label font-weight-bold">TIN</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="tin"
                   value="{{!empty($customerInfo->tin) ? $customerInfo->tin : ''}}" name="tin" placeholder="TIN">
        </div>
    </div>
    <div class="form-group row">
        <label for="etin" class="col-sm-2 col-form-label font-weight-bold">E-TIN</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" id="etin"
                   value="{{!empty($customerInfo->etin) ? $customerInfo->etin : ''}}" name="etin" placeholder="E-TIN"
                   readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="taxesCircle" class="col-sm-2 col-form-label font-weight-bold">Taxes
            Circle</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="taxesCircle"
                   value="{{!empty($customerInfo->tax_circle) ? $customerInfo->tax_circle : ''}}"
                   name="tax_circle"
                   placeholder="Taxes Circle" required>
        </div>
        <label for="taxesZone" class="col-sm-2 col-form-label font-weight-bold">Taxes
            Zone</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="taxesZone"
                   value="{{!empty($customerInfo->tax_zone) ? $customerInfo->tax_zone : ''}}"
                   name="tax_zone" placeholder="Taxes Zone" required>
        </div>
        <label for="taxAreaId" class="col-sm-2 col-form-label font-weight-bold">Taxes
            Area</label>
        <div class="col-sm-2">
            <select class="form-control" id="taxAreaId" name="tax_area_id" required>
                <option value="">Please Select</option>
                <?php $taxAreaWithAmountArray = getTaxAreaWithAmountArray(); ?>
                @if(!empty($taxAreaWithAmountArray))
                    @foreach($taxAreaWithAmountArray as $key => $value)
                        <option min-amount="{{$value['amount']}}"
                                value="{{$key}}" {{($key == 1 ?'selected':'')}}>{{$value['tax_area']. ' '. ($value['amount']. ' '.getCurrency() . ' Minimum')}}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="assessmentYear" class="col-sm-2 col-form-label font-weight-bold">Assessment
            Year</label>
        <div class="col-sm-4">
            <select class="form-control" id="assessmentYear" name="assessment_year" required>
                <option value="">Please Select</option>
                @if(!empty(getAssessmentYearArray()))
                    @foreach(getAssessmentYearArray() as $key => $valueYear)
                        <option value="{{$valueYear}}" {{($key== 1 ? 'selected' : '')}}>{{$valueYear}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <label for="residentialStatus" class="col-sm-2 col-form-label font-weight-bold">Residential Status</label>
        <div class="col-sm-4">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="residentialStatusResidential"
                       name="residential_status"
                       value="1"
                       {{(!empty($customerInfo->residential_status) && $customerInfo->residential_status==1) ? 'checked' : ''}}
                       class="custom-control-input">
                <label class="custom-control-label" for="residentialStatusResidential">Resident</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="residentialStatusNonResidential"
                       name="residential_status"
                       value="2"
                       {{(!empty($customerInfo->residential_status) && $customerInfo->residential_status==2) ? 'checked' : ''}} class="custom-control-input">
                <label class="custom-control-label"
                       for="residentialStatusNonResidential">Non-Resident</label>
            </div>
            <div class="residential_status_error"></div>
        </div>
    </div>
    <div class="form-group row">
        <label for="status"
               class="col-sm-2 col-form-label font-weight-bold">Status</label>
        <div class="col-sm-10 float-left text-left">
            <div class="custom-control custom-radio custom-control-inline">
                <input required type="radio" id="statusIndividual" name="status"
                       value="1" {{(!empty($customerInfo->status) && $customerInfo->status==1) ? 'checked' : ''}}
                       class="custom-control-input">
                <label class="custom-control-label"
                       for="statusIndividual">Individual</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="statusFirm" name="status" value="2"
                       {{(!empty($customerInfo->status) && $customerInfo->status==2) ? 'checked' : ''}}
                       class="custom-control-input">
                <label class="custom-control-label" for="statusFirm">Firm</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="statusAssociationOfPerson" name="status"
                       value="3"
                       {{(!empty($customerInfo->status) && $customerInfo->status==3) ? 'checked' : ''}} class="custom-control-input">
                <label class="custom-control-label" for="statusAssociationOfPerson">Association of Persons</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="statusHinduUndividedFamily" name="status"
                       value="4"
                       {{(!empty($customerInfo->status) && $customerInfo->status==4) ? 'checked' : ''}} class="custom-control-input">
                <label class="custom-control-label" for="statusHinduUndividedFamily">Hindu
                    Undivided
                    Family</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="employer_name" class="col-sm-2 col-form-label font-weight-bold">Name
            of the
            employer/business <small>(where
                applicable)</small></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="employer_name" value=""
                   name="employer_name"
                   placeholder="Name of the employer/business" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="spouse_name" class="col-sm-2 col-form-label font-weight-bold">Wife/Husband's
            Name
            <small>(if assessee,
                please
                mention TIN)</small></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="spouse_name"
                   value="{{!empty($customerInfo->spouse_name) ? $customerInfo->spouse_name : ''}}"
                   name="spouse_name"
                   placeholder="Wife/Husband's Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="fatherName" class="col-sm-2 col-form-label font-weight-bold">Father's
            Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fatherName"
                   value="{{!empty($customerInfo->father_name) ? $customerInfo->father_name : ''}}"
                   name="father_name"
                   placeholder="Father's Name" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="motherName" class="col-sm-2 col-form-label font-weight-bold">Mother's
            Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="motherName"
                   value="{{!empty($customerInfo->mother_name) ? $customerInfo->mother_name : ''}}"
                   name="mother_name"
                   placeholder="Mother's Name" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="dob" class="col-sm-2 col-form-label font-weight-bold">Date of Birth
            <small>(in case of
                individual)</small></label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="dob"
                   value="{{!empty($customerInfo->dob) ? $customerInfo->dob : ''}}" name="dob"
                   placeholder="Date of Birth" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="presentAddress" class="col-sm-2 col-form-label font-weight-bold">Present
            Address</label>
        <div class="col-sm-10">
                    <textarea required class="form-control" id="presentAddress" rows="3" name="present_address"
                              placeholder="Present Address">{{!empty($customerInfo->present_address) ? $customerInfo->present_address : ''}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="permanentAddress" class="col-sm-2 col-form-label font-weight-bold">Permanent
            Address</label>
        <div class="col-sm-10">
                    <textarea required class="form-control" id="permanentAddress" rows="3" name="permanent_address"
                              placeholder="Permanent Address">{{!empty($customerInfo->permanent_address) ? $customerInfo->permanent_address : ''}}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label for="telephoneOffice" class="col-sm-2 col-form-label font-weight-bold">Telephone
            <small>Office/Business</small></label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="telephoneOffice" value=""
                   name="telephone_office"
                   placeholder="Telephone (Office/Business)">
        </div>
        <label for="telephoneResidential"
               class="col-sm-2 col-form-label font-weight-bold">Residential</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="telephoneResidential"
                   value="{{!empty($customerInfo->telephone_residential) ? $customerInfo->telephone_residential : ''}}"
                   name="telephone_residential"
                   placeholder="Telephone Residential">
        </div>
    </div>
    <div class="form-group row">
        <label for="vatRegistrationNumber"
               class="col-sm-2 col-form-label font-weight-bold">Vat Registration
            Number <small>(in
                any)</small></label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="vatRegistrationNumber"
                   value="{{!empty($customerInfo->vat_registration_no) ? $customerInfo->vat_registration_no : ''}}"
                   name="vat_registration_no" placeholder="Vat Registration Number">
        </div>
    </div>
</div>

