<?php
/**
 * Created By: Amit Sarker
 * Created Date: 01-09-2020
 */
?>
    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{getCompanyName()}}</title>
    @include('admin.reports.assessment.pdfDesign.customCssForPdf')
    <style>
        @media print {
            .pageBreak {
                page-break-after: always !important;
            }
        }
    </style>
</head>
<body>
@if(!empty($assessmentDetails))
    <?php
    $customerId = !empty($assessmentDetails->customer_id) ? intval($assessmentDetails->customer_id) : 0;
    $customerName = !empty($assessmentDetails->customer_name) ? strtoupper($assessmentDetails->customer_name) : '';
    $customerGender = !empty($assessmentDetails->gender) ? $assessmentDetails->gender : '';
    $customerIsNewTaxPayer = !empty($assessmentDetails->is_new_tax_payer) ? intval($assessmentDetails->is_new_tax_payer) : 0;
    $email = !empty($assessmentDetails->email) ? $assessmentDetails->email : '';
    $mobile = !empty($assessmentDetails->mobile) ? $assessmentDetails->mobile : '';
    $nid = !empty($assessmentDetails->nid) ? $assessmentDetails->nid : '';
    $utin = !empty($assessmentDetails->utin) ? $assessmentDetails->utin : '';
    $tin = !empty($assessmentDetails->tin) ? $assessmentDetails->tin : '';
    $etin = !empty($assessmentDetails->etin) ? $assessmentDetails->etin : '';
    $taxCircle = !empty($assessmentDetails->tax_circle) ? $assessmentDetails->tax_circle : '';
    $taxZone = !empty($assessmentDetails->tax_zone) ? $assessmentDetails->tax_zone : '';
    $taxZoneId = array_search($taxZone, array_column(getTaxZoneWithCode(), 'zone'));
    $taxZoneKey = $taxZoneId;//array_search($taxZoneId, array_column(getTaxZoneWithCode(), 'zone'));
    $taxZoneWithCode = getTaxZoneWithCode();
    $taxZoneCode = ($taxZoneWithCode[$taxZoneKey]['zoneCode']);
    $taxZoneCode = !empty($taxZoneCode) ? str_replace("-", "", $taxZoneCode) : '';
    $taxPlace = !empty($taxZone) ? explode(',', $taxZone) : '';
    $taxPlace = !empty($taxPlace) ? trim(end($taxPlace)) : '';
    $taxAreaId = !empty($assessmentDetails->tax_area_id) ? $assessmentDetails->tax_area_id : '';
    $taxAreaWiseAmount = !empty($assessmentDetails->tax_area_wise_amount) ? getFloat($assessmentDetails->tax_area_wise_amount) : getFloat(0);
    $employerName = !empty($assessmentDetails->employer_name) ? $assessmentDetails->employer_name : '';
    $spouseName = !empty($assessmentDetails->spouse_name) ? $assessmentDetails->spouse_name : '';
    $fatherName = !empty($assessmentDetails->father_name) ? $assessmentDetails->father_name : '';
    $motherName = !empty($assessmentDetails->mother_name) ? $assessmentDetails->mother_name : '';
    $dob = !empty($assessmentDetails->dob) ? $assessmentDetails->dob : '';
    $residentialStatus = !empty($assessmentDetails->residential_status) ? $assessmentDetails->residential_status : '';
    $residentialStatusText = ($residentialStatus == 1) ? 'Resident' : 'Non-resident';
    $status = !empty($assessmentDetails->status) ? $assessmentDetails->status : '';
    $presentAddress = !empty($assessmentDetails->present_address) ? $assessmentDetails->present_address : '';
    $permanentAddress = !empty($assessmentDetails->permanent_address) ? $assessmentDetails->permanent_address : '';
    $telephoneOffice = !empty($assessmentDetails->telephone_office) ? $assessmentDetails->telephone_office : '';
    $telephoneResidential = !empty($assessmentDetails->telephone_residential) ? $assessmentDetails->telephone_residential : '';
    $vatRegistrationNo = !empty($assessmentDetails->vat_registration_no) ? $assessmentDetails->vat_registration_no : '';

    $assessmentYear = !empty($assessmentDetails->assessment_year) ? $assessmentDetails->assessment_year : '';
    $assessmentYearArray = !empty($assessmentDetails->assessment_year) ? explode('-', $assessmentDetails->assessment_year) : '';
    $assessmentYearFirst = !empty($assessmentYearArray) ? intval(current($assessmentYearArray)) - 1 : '';
    $assessmentYearLast = !empty($assessmentYearArray) ? intval(end($assessmentYearArray)) - 1 : '';
    $taxPayerTypeId = !empty($assessmentDetails->tax_payer_type_id) ? intval($assessmentDetails->tax_payer_type_id) : 0;
    $employerName = !empty($assessmentDetails->employer_name) ? $assessmentDetails->employer_name : '';
    $basicPay = !empty($assessmentDetails->basic_pay) ? doubleval($assessmentDetails->basic_pay) : 0;
    $assessmentYearLabel = 'For the month of July ' . $assessmentYearFirst . ' to June ' . $assessmentYearLast;
    $houseAllowanceTotal = !empty($assessmentDetails->house_allowance_total) ? doubleval($assessmentDetails->house_allowance_total) : 0;
    $houseAllowanceDeduction = !empty($assessmentDetails->house_allowance_deduction) ? doubleval($assessmentDetails->house_allowance_deduction) : 0;
    $houseAllowancePayable = !empty($assessmentDetails->house_allowance_payable) ? doubleval($assessmentDetails->house_allowance_payable) : 0;
    $leaveFareAssistance = !empty($assessmentDetails->leave_fare_assistance) ? doubleval($assessmentDetails->leave_fare_assistance) : 0;
    $pfContributionCompanyPart = !empty($assessmentDetails->pf_contribution_company_part) ? doubleval($assessmentDetails->pf_contribution_company_part) : 0;
    $pfContributionSelf = !empty($assessmentDetails->pf_contribution_self) ? doubleval($assessmentDetails->pf_contribution_self) : 0;
    $pfTotal = ($pfContributionSelf + $pfContributionCompanyPart);
    $medicalAllowanceTotal = !empty($assessmentDetails->medical_allowance_total) ? $assessmentDetails->medical_allowance_total : 0;
    $medicalAllowanceDeduction = !empty($assessmentDetails->medical_allowance_deduction) ? doubleval($assessmentDetails->medical_allowance_deduction) : 0;
    $medicalAllowancePayable = !empty($assessmentDetails->medical_allowance_payable) ? doubleval($assessmentDetails->medical_allowance_payable) : 0;
    $festivalBonus = !empty($assessmentDetails->festival_bonus) ? doubleval($assessmentDetails->festival_bonus) : 0;
    $conveyanceTotal = !empty($assessmentDetails->conveyance_total) ? doubleval($assessmentDetails->conveyance_total) : 0;
    $conveyanceDeduction = !empty($assessmentDetails->conveyance_deduction) ? doubleval($assessmentDetails->conveyance_deduction) : 0;
    $conveyancePayable = !empty($assessmentDetails->conveyance_payable) ? doubleval($assessmentDetails->conveyance_payable) : 0;
    $incentive = !empty($assessmentDetails->incentive) ? doubleval($assessmentDetails->incentive) : 0;
    $otherAllowance = !empty($assessmentDetails->other_allowance) ? doubleval($assessmentDetails->other_allowance) : 0;
    $totalTaxableIncome = !empty($assessmentDetails->total_taxable_income) ? doubleval($assessmentDetails->total_taxable_income) : 0;
    $cpfSelf = !empty($assessmentDetails->cpf_self) ? doubleval($assessmentDetails->cpf_self) : 0;
    $cpfCompany = !empty($assessmentDetails->cpf_company) ? doubleval($assessmentDetails->cpf_company) : 0;
    $cpfTotal = !empty($assessmentDetails->cpf_total) ? doubleval($assessmentDetails->cpf_total) : 0;
    $bspTotal = !empty($assessmentDetails->bsp_total) ? doubleval($assessmentDetails->bsp_total) : 0;
    $dpsInvestment = !empty($assessmentDetails->dps_investment) ? doubleval($assessmentDetails->dps_investment) : 0;
    $dpsMaxAllow = !empty($assessmentDetails->dps_max_allow) ? doubleval($assessmentDetails->dps_max_allow) : 0;
    $dpsTotal = !empty($assessmentDetails->dps_total) ? doubleval($assessmentDetails->dps_total) : 0;
    $insuranceTotal = !empty($assessmentDetails->insurance_total) ? doubleval($assessmentDetails->insurance_total) : 0;
    $shareBusinessTotal = !empty($assessmentDetails->share_business_total) ? doubleval($assessmentDetails->share_business_total) : 0;
    $otherInvestmentTotal = !empty($assessmentDetails->other_investment_total) ? doubleval($assessmentDetails->other_investment_total) : 0;
    $investmentTotal = !empty($assessmentDetails->investment_total) ? doubleval($assessmentDetails->investment_total) : 0;
    //$interestAmount = getInterestAmount($totalTaxableIncome, $customerGender);
    $grossTax = !empty($assessmentDetails->gross_tax) ? doubleval($assessmentDetails->gross_tax) : 0;
    $rebateInvestment = !empty($assessmentDetails->rebate_investment) ? doubleval($assessmentDetails->rebate_investment) : 0;
    $rebateInvestmentTotal = !empty($assessmentDetails->rebate_investment_total) ? doubleval($assessmentDetails->rebate_investment_total) : 0;
    $taxAreaId = !empty($assessmentDetails->tax_area_id) ? intval($assessmentDetails->tax_area_id) : 0;
    $netTax = !empty($assessmentDetails->net_tax) ? doubleval($assessmentDetails->net_tax) : 0;
    $totalTaxAmount = ($grossTax - $rebateInvestmentTotal);
    $aitAdvanceTax = !empty($assessmentDetails->ait_advance_tax) ? doubleval($assessmentDetails->ait_advance_tax) : 0;
    $advanceTaxForNextYear = !empty($assessmentDetails->advance_tax_for_next_year) ? doubleval($assessmentDetails->advance_tax_for_next_year) : 0;
    $totalPayableTax = ($netTax - $aitAdvanceTax); // field
    $totalPayableTaxInWords = convertNumberToWords($totalPayableTax);
    $longLifeSavings = 0;
    $cashAndBankBalance = 0;
    if (boolval($customerIsNewTaxPayer)) {
        $longLifeSavings = !empty($assessmentDetails->long_life_savings) ? doubleval($assessmentDetails->long_life_savings) : 0;
    } else {
        $cashAndBankBalance = !empty($assessmentDetails->cash_and_bank_balance) ? doubleval($assessmentDetails->cash_and_bank_balance) : 0;
    }
    $totalTaxFreeIncome = !empty($assessmentDetails->tax_free_income) ? doubleval($assessmentDetails->tax_free_income) : 0;
    $incomeFromSalary = !empty($assessmentDetails->income_from_salary) ? doubleval($assessmentDetails->income_from_salary) : 0;;
    $loanReceivedFromBank = !empty($assessmentDetails->loan_received_from_bank) ? doubleval($assessmentDetails->loan_received_from_bank) : 0;
    $encashmentOfAnyInvestment = !empty($assessmentDetails->encashment_of_any_investment) ? doubleval($assessmentDetails->encashment_of_any_investment) : 0;
    $interestReceivedFromBank = !empty($assessmentDetails->interest_received_from_bank) ? doubleval($assessmentDetails->interest_received_from_bank) : 0;
    $otherLoanReceive = !empty($assessmentDetails->other_loan_receive) ? doubleval($assessmentDetails->other_loan_receive) : 0;
    $anyAssetSale = !empty($assessmentDetails->any_asset_sale) ? doubleval($assessmentDetails->any_asset_sale) : 0;
    $cashInHandAddSum = !empty($assessmentDetails->cash_in_hand_add_sum) ? doubleval($assessmentDetails->cash_in_hand_add_sum) : 0;
    $totalAfterAdd = $cashInHandAddSum + $longLifeSavings + $cashAndBankBalance;
    $personalAndFamilyExpenditure = !empty($assessmentDetails->personal_and_family_expenditure) ? doubleval($assessmentDetails->personal_and_family_expenditure) : 0;
    $totalExpenditureCalculation = getTotalExpenditureCalculation($personalAndFamilyExpenditure);
    $PersonalAndFamilyExpenses = round($totalExpenditureCalculation['PersonalAndFamilyExpenses']);
    $taxDeductedAtSourceFromLastFinancialYear = round($totalExpenditureCalculation['taxDeductedAtSourceFromLastFinancialYear']);
    $accommodationExpenses = round($totalExpenditureCalculation['accommodationExpenses']);
    $transportExpenses = round($totalExpenditureCalculation['transportExpenses']);
    $electricityBillForResidence = round($totalExpenditureCalculation['electricityBillForResidence']);
    $wasaBillForResidence = round($totalExpenditureCalculation['wasaBillForResidence']);
    $gasBillForResidence = round($totalExpenditureCalculation['gasBillForResidence']);
    $telephoneBillForResidence = round($totalExpenditureCalculation['telephoneBillForResidence']);
    $festivalAndOtherSpecialExpenses = round($totalExpenditureCalculation['festivalAndOtherSpecialExpenses']);

    $bankInterestPaid = !empty($assessmentDetails->bank_interest_paid) ? doubleval($assessmentDetails->bank_interest_paid) : 0;
    $bankLoanPaid = !empty($assessmentDetails->bank_loan_paid) ? doubleval($assessmentDetails->bank_loan_paid) : 0;
    $investmentInPfSelfAndCompany = !empty($assessmentDetails->investment_in_pf_self_and_company) ? doubleval($assessmentDetails->investment_in_pf_self_and_company) : 0;
    $investmentInBsp = !empty($assessmentDetails->investment_in_bsp) ? doubleval($assessmentDetails->investment_in_bsp) : 0;
    $investmentInDps = !empty($assessmentDetails->investment_in_dps) ? doubleval($assessmentDetails->investment_in_dps) : 0;
    $investmentInInsurance = !empty($assessmentDetails->investment_in_insurance) ? doubleval($assessmentDetails->investment_in_insurance) : 0;
    $investmentInShareBusiness = !empty($assessmentDetails->investment_in_share_business) ? doubleval($assessmentDetails->investment_in_share_business) : 0;
    $anyOtherInvestment = !empty($assessmentDetails->any_other_investment) ? doubleval($assessmentDetails->any_other_investment) : 0;
    $anyAssetPurchase = !empty($assessmentDetails->any_asset_purchase) ? doubleval($assessmentDetails->any_asset_purchase) : 0;
    $anyAssetPurchaseDescription = !empty($assessmentDetails->any_asset_purchase_description) ? ($assessmentDetails->any_asset_purchase_description) : '';
    $cashInHandLessSum = !empty($assessmentDetails->cash_in_hand_less_sum) ? doubleval($assessmentDetails->cash_in_hand_less_sum) : 0;
    $yearEndCahInHand = !empty($assessmentDetails->year_end_cah_in_hand) ? doubleval($assessmentDetails->year_end_cah_in_hand) : 0;
    $businessCapitalClosingBalance = !empty($assessmentDetails->business_capital_closing_balance) ? doubleval($assessmentDetails->business_capital_closing_balance) : 0;
    $companyName1 = !empty($assessmentDetails->company_name_1) ? $assessmentDetails->company_name_1 : '';
    $numberOfShare1 = !empty($assessmentDetails->number_of_share_1) ? doubleval($assessmentDetails->number_of_share_1) : 0;
    $amountOfShare1 = !empty($assessmentDetails->amount_of_share_1) ? doubleval($assessmentDetails->amount_of_share_1) : 0;
    $companyName2 = !empty($assessmentDetails->company_name_2) ? $assessmentDetails->company_name_2 : '';
    $numberOfShare2 = !empty($assessmentDetails->number_of_share_2) ? doubleval($assessmentDetails->number_of_share_2) : 0;
    $amountOfShare2 = !empty($assessmentDetails->amount_of_share_2) ? doubleval($assessmentDetails->amount_of_share_2) : 0;
    $companyName3 = !empty($assessmentDetails->company_name_3) ? $assessmentDetails->company_name_3 : '';
    $numberOfShare3 = !empty($assessmentDetails->number_of_share_3) ? doubleval($assessmentDetails->number_of_share_3) : 0;
    $amountOfShare3 = !empty($assessmentDetails->amount_of_share_3) ? doubleval($assessmentDetails->amount_of_share_3) : 0;
    $amountOfShareTotal = ($amountOfShare1 + $amountOfShare2 + $amountOfShare3);
    $nonAgriculturalPropertyExpenseDescription1 = !empty($assessmentDetails->non_agricultural_property_expense_description_1) ? ($assessmentDetails->non_agricultural_property_expense_description_1) : '';
    $nonAgriculturalPropertyExpenseAmount1 = !empty($assessmentDetails->non_agricultural_property_expense_amount_1) ? doubleval($assessmentDetails->non_agricultural_property_expense_amount_1) : 0;
    $nonAgriculturalPropertyExpenseDescription2 = !empty($assessmentDetails->non_agricultural_property_expense_description_2) ? $assessmentDetails->non_agricultural_property_expense_description_2 : '';
    $nonAgriculturalPropertyExpenseAmount2 = !empty($assessmentDetails->non_agricultural_property_expense_amount_2) ? doubleval($assessmentDetails->non_agricultural_property_expense_amount_2) : 0;
    $nonAgriculturalPropertyExpenseDescription3 = !empty($assessmentDetails->non_agricultural_property_expense_description_3) ? $assessmentDetails->non_agricultural_property_expense_description_3 : '';
    $nonAgriculturalPropertyExpenseAmount3 = !empty($assessmentDetails->non_agricultural_property_expense_amount_3) ? doubleval($assessmentDetails->non_agricultural_property_expense_amount_3) : 0;
    $nonAgriculturalPropertyExpenseAmountTotal = !empty($assessmentDetails->non_agricultural_property_expense_amount_total) ? doubleval($assessmentDetails->non_agricultural_property_expense_amount_total) : 0;
    $agriculturalPropertyExpenseDescription1 = !empty($assessmentDetails->agricultural_property_expense_description_1) ? $assessmentDetails->agricultural_property_expense_description_1 : '';
    $agriculturalPropertyExpenseAmount1 = !empty($assessmentDetails->agricultural_property_expense_amount_1) ? doubleval($assessmentDetails->agricultural_property_expense_amount_1) : 0;
    $agriculturalPropertyExpenseDescription2 = !empty($assessmentDetails->agricultural_property_expense_description_2) ? $assessmentDetails->agricultural_property_expense_description_2 : '';
    $agriculturalPropertyExpenseAmount2 = !empty($assessmentDetails->agricultural_property_expense_amount_2) ? doubleval($assessmentDetails->agricultural_property_expense_amount_2) : 0;
    $agriculturalPropertyExpenseDescription3 = !empty($assessmentDetails->agricultural_property_expense_description_3) ? $assessmentDetails->agricultural_property_expense_description_3 : '';
    $agriculturalPropertyExpenseAmount3 = !empty($assessmentDetails->agricultural_property_expense_amount_3) ? doubleval($assessmentDetails->agricultural_property_expense_amount_3) : 0;
    $agriculturalPropertyExpenseAmountTotal = !empty($assessmentDetails->agricultural_property_expense_amount_total) ? doubleval($assessmentDetails->agricultural_property_expense_amount_total) : 0;
    $providentFundBf = !empty($assessmentDetails->provident_fund_bf) ? doubleval($assessmentDetails->provident_fund_bf) : 0;
    $providentFundThisYear = !empty($assessmentDetails->provident_fund_this_year) ? doubleval($assessmentDetails->provident_fund_this_year) : 0;
    $providentFundNet = !empty($assessmentDetails->provident_fund_net) ? doubleval($assessmentDetails->provident_fund_net) : 0;
    $bspPurchaseBf = !empty($assessmentDetails->bsp_purchase_bf) ? doubleval($assessmentDetails->bsp_purchase_bf) : 0;
    $bspPurchaseThisYear = !empty($assessmentDetails->bsp_purchase_this_year) ? doubleval($assessmentDetails->bsp_purchase_this_year) : 0;
    $bspPurchaseNet = !empty($assessmentDetails->bsp_purchase_net) ? doubleval($assessmentDetails->bsp_purchase_net) : 0;
    $dpsBf = !empty($assessmentDetails->dps_bf) ? doubleval($assessmentDetails->dps_bf) : 0;
    $dpsThisYear = !empty($assessmentDetails->dps_this_year) ? doubleval($assessmentDetails->dps_this_year) : 0;
    $dpsNet = !empty($assessmentDetails->dps_net) ? doubleval($assessmentDetails->dps_net) : 0;
    $insuranceBf = !empty($assessmentDetails->insurance_bf) ? doubleval($assessmentDetails->insurance_bf) : 0;
    $insuranceThisYear = !empty($assessmentDetails->insurance_this_year) ? doubleval($assessmentDetails->insurance_this_year) : 0;
    $insuranceNet = !empty($assessmentDetails->insurance_net) ? doubleval($assessmentDetails->insurance_net) : 0;
    $otherInvestment = !empty($assessmentDetails->other_investment) ? doubleval($assessmentDetails->other_investment) : 0;
    $investmentNet = ($providentFundNet + $bspPurchaseNet + $dpsNet + $insuranceNet); //filed
    $lessEncashmentThisYear = !empty($assessmentDetails->less_encashment_this_year) ? doubleval($assessmentDetails->less_encashment_this_year) : 0;
    $motorVehicleDetails = !empty($assessmentDetails->motor_vehicle_details) ? ($assessmentDetails->motor_vehicle_details) : '';
    $motorVehicle = !empty($assessmentDetails->motor_vehicle) ? doubleval($assessmentDetails->motor_vehicle) : 0;
    $jewelleryDetails = !empty($assessmentDetails->jewellery_details) ? $assessmentDetails->jewellery_details : '';
    $jewellery = !empty($assessmentDetails->jewellery) ? doubleval($assessmentDetails->jewellery) : 0;
    $jewelleryBfValueText = ($jewellery > 0) ? '' : 'B/F value not known';
    $furniture = !empty($assessmentDetails->furniture) ? doubleval($assessmentDetails->furniture) : 0;
    $electricEquipment = !empty($assessmentDetails->electric_equipment) ? doubleval($assessmentDetails->electric_equipment) : 0;
    $cashAssetOutsideBusiness = !empty($assessmentDetails->cash_asset_outside_business) ? doubleval($assessmentDetails->cash_asset_outside_business) : 0;
    $anyOtherAssetDetails = !empty($assessmentDetails->any_other_asset_details) ? doubleval($assessmentDetails->any_other_asset_details) : '';
    $anyOtherAssetAmount = !empty($assessmentDetails->any_other_asset_amount) ? doubleval($assessmentDetails->any_other_asset_amount) : 0;
    $totalAssets = !empty($assessmentDetails->total_assets) ? doubleval($assessmentDetails->total_assets) : 0;
    $securedLoanBf = empty($assessmentDetails->secured_loan_bf) ? doubleval($assessmentDetails->secured_loan_bf) : 0;
    $securedLoanThisYear = !empty($assessmentDetails->secured_loan_this_year) ? doubleval($assessmentDetails->secured_loan_this_year) : 0;
    $securedLoanLessPaid = !empty($assessmentDetails->secured_loan_less_paid) ? doubleval($assessmentDetails->secured_loan_less_paid) : 0;
    $securedLoanNet = !empty($assessmentDetails->secured_loan_net) ? doubleval($assessmentDetails->secured_loan_net) : 0;
    $bankLoanBf = !empty($assessmentDetails->bank_loan_bf) ? doubleval($assessmentDetails->bank_loan_bf) : 0;
    $bankLoanThisYear = !empty($assessmentDetails->bank_loan_this_year) ? doubleval($assessmentDetails->bank_loan_this_year) : 0;
    $bankLoanLessPaid = !empty($assessmentDetails->bank_loan_less_paid) ? doubleval($assessmentDetails->bank_loan_less_paid) : 0;
    $bankLoanNet = !empty($assessmentDetails->bank_loan_net) ? doubleval($assessmentDetails->bank_loan_net) : 0;
    $othersLoanBf = !empty($assessmentDetails->others_loan_bf) ? doubleval($assessmentDetails->others_loan_bf) : 0;
    $othersLoanThisYear = !empty($assessmentDetails->others_loan_this_year) ? doubleval($assessmentDetails->others_loan_this_year) : 0;
    $othersLoanLessPaid = !empty($assessmentDetails->others_loan_less_paid) ? doubleval($assessmentDetails->others_loan_less_paid) : 0;
    $othersLoanNet = !empty($assessmentDetails->others_loan_net) ? doubleval($assessmentDetails->others_loan_net) : 0;
    $totalLiabilities = !empty($assessmentDetails->total_liabilities) ? doubleval($assessmentDetails->total_liabilities) : 0;
    $netWealthThisYear = !empty($assessmentDetails->net_wealth_this_year) ? doubleval($assessmentDetails->net_wealth_this_year) : 0;
    $netWealthPreviousYear = !empty($assessmentDetails->net_wealth_previous_year) ? doubleval($assessmentDetails->net_wealth_previous_year) : 0;
    $accretionWealth = !empty($assessmentDetails->accretion_wealth) ? doubleval($assessmentDetails->accretion_wealth) : 0;
    $surcharge = !empty($assessmentDetails->surcharge) ? doubleval($assessmentDetails->surcharge) : 0;
    $familyExpenditure = !empty($assessmentDetails->family_expenditure) ? doubleval($assessmentDetails->family_expenditure) : 0;
    $bankInterest = !empty($assessmentDetails->bank_interest) ? doubleval($assessmentDetails->bank_interest) : 0;
    $totalAccretionWealth = !empty($assessmentDetails->total_accretion_wealth) ? doubleval($assessmentDetails->total_accretion_wealth) : 0;
    $adultChildren = !empty($assessmentDetails->adult_children) ? intval($assessmentDetails->adult_children) : 0;
    $childChildren = !empty($assessmentDetails->child_children) ? intval($assessmentDetails->child_children) : 0;
    $shownReturnIncome = !empty($assessmentDetails->shown_return_income) ? doubleval($assessmentDetails->shown_return_income) : 0;
    $taxFreeIncome = !empty($assessmentDetails->tax_free_income) ? doubleval($assessmentDetails->tax_free_income) : 0;
    $fixedAsset = !empty($assessmentDetails->fixed_asset) ? doubleval($assessmentDetails->fixed_asset) : 0;
    $totalSourceOfFund = !empty($assessmentDetails->total_source_of_fund) ? doubleval($assessmentDetails->total_source_of_fund) : 0;
    $difference = !empty($assessmentDetails->difference) ? doubleval($assessmentDetails->difference) : 0;
    $annualRentalIncome = !empty($assessmentDetails->annual_rental_income) ? doubleval($assessmentDetails->annual_rental_income) : 0;
    $repairCollection = !empty($assessmentDetails->repair_collection) ? doubleval($assessmentDetails->repair_collection) : 0;
    $municipalOrLocalTax = !empty($assessmentDetails->municipal_or_local_tax) ? doubleval($assessmentDetails->municipal_or_local_tax) : 0;
    $landRevenue = !empty($assessmentDetails->land_revenue) ? doubleval($assessmentDetails->land_revenue) : 0;
    $interestOnLoanMortgageCapital = !empty($assessmentDetails->interest_on_loan_mortgage_capital) ? doubleval($assessmentDetails->interest_on_loan_mortgage_capital) : 0;
    $insurancePremium = !empty($assessmentDetails->insurance_premium) ? doubleval($assessmentDetails->insurance_premium) : 0;
    $vacancyAllowance = !empty($assessmentDetails->vacancy_allowance) ? doubleval($assessmentDetails->vacancy_allowance) : 0;
    $otherClaimedExpenses = !empty($assessmentDetails->other_claimed_expenses) ? doubleval($assessmentDetails->other_claimed_expenses) : 0;
    $totalClaimedExpenses = !empty($assessmentDetails->total_claimed_expenses) ? doubleval($assessmentDetails->total_claimed_expenses) : 0;
    $diffAnnualRentalIncomeClaimedExpenses = !empty($assessmentDetails->diff_annual_rental_income_claimed_expenses) ? doubleval($assessmentDetails->diff_annual_rental_income_claimed_expenses) : 0;
    $tickImage = "assets/images/tick_box.png";
    $tickBlankImage = "assets/images/tick_box_blank.png";
    ?>
    <?php
    $tdHeight = 'height=30';
    ?>
    <div style="height: 50px;"></div>
    @include('admin.reports.assessment.pdfDesign.frontPageHeaderPdf')
    <div class="w-100 border-1" style="margin-top: 20px; padding: 20px; height: 750px;">
        <div id="personalInfo" class="personalInfo w-100" style="">
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}><label>1. Name of the Assessee:&nbsp;</label></td>
                    <td {{$tdHeight}}><label><strong>{{$customerName}}</strong></label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}><label>2. National ID No <small>(if any):&nbsp;</small></label></td>
                    <td {{$tdHeight}}><label>{{$nid}}</label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td><label>3. UTIN <small>(if any):&nbsp;&nbsp;&nbsp;</small></label></td>
                    <td>{{$utin}}</td>
                </tr>
                <tr>
                    <td><label>4. TIN:&nbsp;&nbsp;&nbsp;</label></td>
                    <td>{{$tin}}</td>
                </tr>
                <tr>
                    <td><label>5. E-TIN:&nbsp;&nbsp;&nbsp;</label></td>
                    <td><label>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    @if(!empty($etin))
                                        <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">{{(!empty($etin[0]) ? $etin[0] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[1]) ? $etin[1] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[2]) ? $etin[2] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[3]) ? $etin[3] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[4]) ? $etin[4] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[5]) ? $etin[5] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[6]) ? $etin[6] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[7]) ? $etin[7] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[8]) ? $etin[8] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[9]) ? $etin[9] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[10]) ? $etin[10] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[11]) ? $etin[11] : '0')}}</td>
                                    @else
                                        <td {{$tdHeight}} style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td><label>6. (a) Taxes Circle:&nbsp;</label></td>
                    <td><label>{{$taxCircle}}</label></td>
                    <td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b)
                            Taxes Zone:</label></td>
                    <td><label>{{$taxZone}}</label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}} class="w-30"><label>7. Assessment Year:&nbsp;</label></td>
                    <td><label>{{$assessmentYear}}</label></td>
                    @if($residentialStatus == 1)
                        <td><label>8. Residential Status: Resident <span class=""><img class="imgTickBox"
                                                                                       src="{{$tickImage}}"
                                                                                       alt=""/></span>&nbsp;/&nbsp;Non-resident
                                <span
                                    class="" style="color: transparent"><img class="imgTickBox"
                                                                             src="{{$tickBlankImage}}" alt=""/></span>
                            </label></td>
                    @else
                        <td><label>Residential Status: Resident <span class=""><img class="imgTickBox"
                                                                                    src="{{$tickBlankImage}}"
                                                                                    alt=""/></span>&nbsp;/&nbsp;Non-resident
                                <span
                                    class=""><img class="imgTickBox" src="{{$tickImage}}" alt=""/></span>
                            </label></td>
                    @endif
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}><label>9. Status:&nbsp;Individual&nbsp;<span
                                class=""><img class="imgTickBox" src="{{($status == 1) ? $tickImage : $tickBlankImage}}"
                                              alt=""/></span></label></td>
                    <td><label>Firm&nbsp;<span class=""><img class="imgTickBox"
                                                             src="{{($status == 2) ? $tickImage : $tickBlankImage}}"
                                                             alt=""/></span></label></td>
                    <td><label>Association of Persons&nbsp;<span
                                class=""><img class="imgTickBox" src="{{($status == 3) ? $tickImage : $tickBlankImage}}"
                                              alt=""/></span></label></td>
                    <td><label>Hindu Undivided Family&nbsp;<span
                                class=""><img class="imgTickBox" src="{{($status == 4) ? $tickImage : $tickBlankImage}}"
                                              alt=""/></span></label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}><label>10. Name of the employer/business <small>(where applicable)</small>:&nbsp;</label>
                    </td>
                    <td><label>{{$employerName}}</label></td>
                    <td><label></label></td>
                </tr>
                <tr>
                    <td {{$tdHeight}}><label>11. Wife/Husband's Name <small>(if assessee, please mention TIN)</small>:&nbsp;</label>
                    </td>
                    <td><label>{{$spouseName}}</label></td>
                    <td><label></label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}><label>12. Father's Name:&nbsp;</label></td>
                    <td><label>{{$fatherName}}</label></td>
                </tr>
                <tr>
                    <td {{$tdHeight}}><label>13. Mother's Name:&nbsp;</label></td>
                    <td><label>{{$motherName}}</label></td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td><label>14. Date of Birth <small>(in case of individual)</small>:&nbsp;</label></td>
                    <td>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[8]}}</td>
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[9]}}</td>
                                {{--                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[4]}}</td>--}}
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[5]}}</td>
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[6]}}</td>
                                {{--                                <td style="padding: 5px 10px 5px 10px;">{{$dob[7]}}</td>--}}
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[0]}}</td>
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[1]}}</td>
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[2]}}</td>
                                <td style="padding: 5px 10px 5px 10px;" class="border-1">{{$dob[3]}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">Day</td>
                                <td colspan="2" class="text-center">Month</td>
                                <td colspan="4" class="text-center">Year</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}>15. Address (a) Present:&nbsp;</td>
                    <td>{{$presentAddress}}</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b)
                        Permanent:&nbsp;
                    </td>
                    <td>{{$permanentAddress}}</td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}} style="width: 300px;">16. Telephone: Office/Business:&nbsp;</td>
                    <td style="">{{$telephoneOffice}}</td>
                    <td style="">Residential:&nbsp;</td>
                    <td style=";">{{$telephoneResidential}}</td>
                </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                <tr>
                    <td {{$tdHeight}}>17. VAT Registration Number <small>(if any)</small>:&nbsp;</td>
                    <td>{{$telephoneOffice}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="pageBreak"></div>
    <div class="w-100" style="margin-top: 20px; padding: 20px; height: 1300px;">
        <table class="w-100">
            <tbody>
            <tr>
                <td class="text-center"><label><u><strong>Statement of income of the Assessee</strong></u></label></td>
            </tr>
            <tr>
                <td class="text-center"><label><strong>Statement of income during the income year ending on
                            (30-06-{{$assessmentYearLast}}
                            )</strong></label></td>
            </tr>
            </tbody>
        </table>
        <table class="w-100 table table-bordered">
            <thead>
            <tr>
                <th class="text-center font-weight-bold">Serial No.</th>
                <th class="text-center font-weight-bold" colspan="3">Heads of Income</th>
                <th class="text-center font-weight-bold">Amount in {{getCurrency()}}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">1</td>
                <td colspan="3" class="font-weight-bold">Salaries : u/s 21 (as per schedule 1)</td>
                <td class="text-right">{{getFloat($totalTaxableIncome)}}</td>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td colspan="3">Interest on Securities : u/s 22</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td colspan="3">Income from house property : u/s 24 (as per schedule 2)</td>
                <td class="text-right">{{getFloat($diffAnnualRentalIncomeClaimedExpenses)}}</td>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td colspan="3">Agricultural income : u/s 26</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">5</td>
                <td colspan="3">Income from business or profession : u/s 28</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">6</td>
                <td colspan="3">Share of profit in a firm :</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">7</td>
                <td colspan="3">Income of the spouse or minor child as applicable : u/s 43(4)</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">8</td>
                <td colspan="3">Capital Gains : u/s 31</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">9</td>
                <td colspan="3">Income from other source : u/s 33</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">10</td>
                <td colspan="3">Total ( serial no. 1 to 9)</td>
                <td class="text-right">{{getFloat($totalTaxableIncome + $diffAnnualRentalIncomeClaimedExpenses)}}</td>
            </tr>
            <tr>
                <td class="text-center">11</td>
                <td colspan="3">Foreign Income:</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td class="text-center">12</td>
                <td colspan="3">Total income ( serial no. 10 and 11)</td>
                <td class="text-right">{{getFloat($totalTaxableIncome + $diffAnnualRentalIncomeClaimedExpenses)}}</td>
            </tr>
            <tr>
                <td class="text-center">13</td>
                <td colspan="3">Tax leviable on total income</td>
                <td class="text-right">{{getFloat($grossTax)}}</td>
            </tr>
            <tr>
                <td class="text-center">14</td>
                <td colspan="3">Tax rebate : u/s 44(2)(b)(as per schedule 3)</td>
                <td class="text-right">{{getFloat($rebateInvestment)}}</td>
            </tr>
            <tr>
                <td class="text-center">15</td>
                <td colspan="3">Tax payable (difference between serial no. 13 and 14)</td>
                <td class="text-right">{{getFloat($netTax)}}</td>
            </tr>
            <tr>
                <td rowspan="7" class="text-center">16</td>
                <td colspan="3">Tax Payments:</td>
                <td class="text-right" rowspan="7"></td>
            </tr>
            <tr>
                <td colspan="2">(a) Tax Deducted at Source from Bank Interest</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AIT deducted at source from Salary {{getCurrency()}}
                    .
                </td>
                <td class="text-right">{{getFloat($aitAdvanceTax)}}</td>
            </tr>
            <tr>
                <td colspan="2">(b) Advance tax u/s 64/68 (Please attach chalan) {{getCurrency()}}.</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td colspan="2">(c) Tax paid on the basis of this return (u/s 74)</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td colspan="2">(d) Adjustment of Tax Refund (For A.Y.) {{getCurrency()}}</td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Total of (a),(b),(c) and (d)</td>
            </tr>
            <tr>
                <td class="text-center">17</td>
                <td colspan="3">Difference between serial no. 15 and 16 (if any) <strong>Excess Tax Paid</strong></td>
                <td class="text-right">{{getFloat($totalPayableTax)}}</td>
            <tr>
                <td class="text-center">18</td>
                <td colspan="3">Tax exempted and Tax free income {{getCurrency()}}</td>
                <td class="text-right">{{getFloat($taxFreeIncome)}}</td>
            </tr>
            <tr>
                <td class="text-center">19</td>
                <td colspan="3">Income tax paid in the last assessment year {{getCurrency()}}.</td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <table class="w-100">
            <tbody>
            <tr>
                <td>* <small>If needed,please use separate sheet.</small></td>
            </tr>
            <tr>
                <td class="text-center" height="30"><u><strong>Verification</strong></u></td>
            </tr>
            <tr>
                <td class="text-justify" height="50">
                    <label>I <strong>{{$customerName}}</strong> Son/Daughter of {{$fatherName}}
                        UTIN/E-TIN :&nbsp;{{$etin}}. Solemnly declare that to the best of my knowledge and
                        belief the information given in this return and statements and documents annexed herewith is
                        correct
                        and complete.</label>
                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <div style="float: right; width: 40%;">
                <div class="text-center" style="margin-top: 30px;">
                    Signature<br/>
                    <strong>{{($customerName)}}</strong><br/>
                    <small>(Name in block letters)<br/>
                        Designation and<br/>
                        Seal (for other than individual)</small>
                </div>
            </div>

            <div style="float: left; width: 54%;">
                <div class="w-100" style="margin-top: 70px; margin-bottom: 5px;">Place:&nbsp;{{$taxPlace}}</div>
                <div class="w-100">Date:&nbsp;{{''}}</div>
            </div>

            <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
        </div>
    </div>
    <div class="pageBreak"></div>
    <div class="w-100" style="margin-top: 20px; padding: 20px;">
        <table class="w-100">
            <tbody>
            <tr>
                <td class="text-center" height="30"><label><strong>SCHEDULES SHOWING DETAILS OF INCOME</strong></label>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="w-100">
            <tbody>
            <tr>
                <td class="text-left"><strong>Name of the Assessee:&nbsp;{{$customerName}}</strong></td>
                <td class="text-right">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            @if(!empty($etin))
                                <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">E-TIN</td>
                                <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">{{(!empty($etin[0]) ? $etin[0] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[1]) ? $etin[1] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[2]) ? $etin[2] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[3]) ? $etin[3] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[4]) ? $etin[4] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[5]) ? $etin[5] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[6]) ? $etin[6] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[7]) ? $etin[7] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[8]) ? $etin[8] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[9]) ? $etin[9] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[10]) ? $etin[10] : '0')}}</td>
                                <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[11]) ? $etin[11] : '0')}}</td>
                            @else
                                <td {{$tdHeight}} style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                                <td style="padding: 15px;"></td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="w-100">
            <tbody>
            <tr>
                <td class="text-center"><label><strong><u>Schedule-1 (Salaries)</u></strong></label></td>
            </tr>
            </tbody>
        </table>
        <table class="w-100 table table-bordered">
            <tbody>
            <tr>
                <th>Pay & Allowance</th>
                <th>Amount of Income {{getCurrency()}}</th>
                <th>Amount of exempted Income {{getCurrency()}}</th>
                <th>Net taxable Income {{getCurrency()}}</th>
            </tr>
            <tr>
                <td>Basic pay</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Special pay</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Dearness allowance</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Conveyance allowance</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>House rent allowane</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Medical allowance</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Servant allowance</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Leave allowance</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Honorarium / Reward / Fee</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Overtime allowance</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Bonus / Ex-gratia</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Other allowances</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Employer's contribution to Recognized Provident Fund</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Interest accrued on Recognized Provident Fund</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Deemed income for transport facility</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Deemed income for free furnished/unfurnished accommodation</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Other,if any (give detail)</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            <tr>
                <td>Net taxable income from salary</td>
                <td class="text-right"></td>
                <td class="text-right"></td>
                <td class="text-right"></td>
            </tr>
            </tbody>
        </table>
        <table class="w-100">
            <tbody>
            <tr>
                <td class="text-center" height="30"><label><strong><u>Schedule-2 (House Property
                                income</u></strong></label></td>
            </tr>
            </tbody>
        </table>
        <table class="w-100 table table-bordered">
            <thead>
            <tr>
                <th width="120">Location and description of property</th>
                <th>Particulars</th>
                <th width="120">{{getCurrency()}}</th>
                <th colspan="3">{{getCurrency()}}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td rowspan="11"></td>
                <td colspan="2">1. Annual rental income</td>
                <td colspan="3"></td>

            </tr>
            <tr>
                <td colspan="5">2. Claimed Expenses:</td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Repair,Collection,etc.</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Municipal or Local Tax</td>
                <td colspan="1"></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Land Revenue</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Interest on Loan/Mortgage/Capital Charge</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Insurance Premium</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Vacancy Allowance</td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;&nbsp;Other, if any</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">Total =</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="2">3. Net income (difference between item 1 and 2)</td>
                <td colspan="3"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="pageBreak"></div>
    <div class="w-100" style="margin-top: 20px; padding: 20px; height: 1300px;">
        <table class="w-100">
            <tbody>
            <tr>
                <td class="text-center" height="30"><label><strong><u>Schedule-3 (Investment tax
                                credit</u></strong></label></td>
            </tr>
            <tr>
                <td class="text-center" height="30"><label>(Section 44(2)(b) read with part 'B' of Sixth
                        Schedule)</label></td>
            </tr>
            </tbody>
        </table>
        <div class="w-100 border-1" style="margin-top: 20px; padding: 20px;">
            <table class="w-100">
                <tbody>
                <tr>
                    <td>1.</td>
                    <td>Life insurance premium</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Contribution to deferred annuity</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Contribution to Provident Fund to which Provident Fund Act, 1925 applies</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Self contribution and employer's contribution to Recognized Provident Fund</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($cpfTotal)}}</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Contribution to Super Annuation Fund</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Investment in approved debenture or debenture stock, Stock or Shares</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Contribution to deposit pension scheme</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>Contribution to Benevolent Fund and Group Insurance premium</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td>Contribution to Zakat Fund</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>10.</td>
                    <td>Others, if any (give details)</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <td>{{getCurrency()}}</td>
                    <td class="text-right"
                        style="border-top: 1px solid black;border-bottom: 1px solid black;">{{getFloat(0)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <table class="w-100">
            <tbody>
            <tr>
                <td>* Please attach certificates / documents of investment.</td>
            </tr>
            <tr>
                <td height="40" class="text-center"><strong><u>List of documents furnished</u></strong></td>
            </tr>
            </tbody>
        </table>
        <div class="w-100 border-1" style="padding: 20px;">
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="font-weight-bold pb-50">1. Salary Certificate with TDS Challan <span>&nbsp;<img
                                class="imgTickBox" src="assets/images/tick_box_blank.png" alt=""/></span></td>
                    <td class="font-weight-bold pb-50">6. Investment Prove Doc<span>&nbsp;<img class="imgTickBox"
                                                                                               src="assets/images/tick_box_blank.png"
                                                                                               alt=""/></span></td>
                </tr>
                <tr>
                    <td class="font-weight-bold pb-50">2. Tax calculation sheet<span>&nbsp;<img class="imgTickBox"
                                                                                                src="assets/images/tick_box_blank.png"
                                                                                                alt=""/></span></td>
                    <td class="font-weight-bold pb-50">7. Land Purchase Deed<span>&nbsp;<img class="imgTickBox"
                                                                                             src="assets/images/tick_box_blank.png"
                                                                                             alt=""/></span></td>
                </tr>
                <tr>
                    <td class="font-weight-bold pb-50">3. Cash outside business<span>&nbsp;<img class="imgTickBox"
                                                                                                src="assets/images/tick_box_blank.png"
                                                                                                alt=""/></span></td>
                    <td class="font-weight-bold pb-50">8.</td>
                </tr>
                <tr>
                    <td class="font-weight-bold pb-50">4. Advance tax from salary automatic doc<span>&nbsp;<img
                                class="imgTickBox" src="assets/images/tick_box_blank.png" alt=""/></span></td>
                    <td class="font-weight-bold pb-50">9.</td>
                </tr>
                <tr>
                    <td class="font-weight-bold pb-50">5. Loan Sanction letter<span>&nbsp;<img class="imgTickBox"
                                                                                               src="assets/images/tick_box_blank.png"
                                                                                               alt=""/></span></td>
                    <td class="font-weight-bold pb-50">10.</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="pageBreak"></div>
        <div id="assetLiabilitiesBlock" class="w-100">
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="text-right font-weight-bold">I.T.10B</td>
                </tr>
                </tbody>
            </table>
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="text-center"><strong>Statement of Assets and Liabilities (as on
                            30.06.{{$assessmentYearLast}})</strong></td>
                </tr>
                </tbody>
            </table>
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="text-left font-weight-bold">Name of the Assessee: {{($customerName)}}</td>
                    <td class="text-right"><label>
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    @if(!empty($etin))
                                        <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">E-TIN</td>
                                        <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">{{(!empty($etin[0]) ? $etin[0] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[1]) ? $etin[1] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[2]) ? $etin[2] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[3]) ? $etin[3] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[4]) ? $etin[4] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[5]) ? $etin[5] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[6]) ? $etin[6] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[7]) ? $etin[7] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[8]) ? $etin[8] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[9]) ? $etin[9] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[10]) ? $etin[10] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[11]) ? $etin[11] : '0')}}</td>
                                    @else
                                        <td {{$tdHeight}} style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </label></td>
                </tr>
                </tbody>
            </table>
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="font-weight-bold">1. (a) Business Capital (Closing balance)</td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($businessCapitalClosingBalance)}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">(b) Directors Shareholdings in Limited Companies (at cost)
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td><u>Name of Companies</u></td>
                                <td><u>Number of shares</u></td>
                                <td><u>Values of shares</u></td>
                            </tr>
                            <tr>
                                <td>{{$companyName1}}</td>
                                <td>{{$numberOfShare1}}</td>
                                <td>{{getFloat($amountOfShare1)}}</td>
                            </tr>
                            <tr>
                                <td>{{$companyName2}}</td>
                                <td>{{$numberOfShare2}}</td>
                                <td>{{getFloat($amountOfShare2)}}</td>
                            </tr>
                            <tr>
                                <td>{{$companyName3}}</td>
                                <td>{{$numberOfShare3}}</td>
                                <td>{{getFloat($amountOfShare3)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($amountOfShareTotal)}}</td>
                </tr>
                <tr>
                    <td><strong>2. Non-Agricultural Property (at cost with legal expenses)</strong><br/>
                        <small>Land/House property (Description and location of property)</small>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td><u>Description</u></td>
                                <td><u>Amount</u></td>
                            </tr>
                            <tr>
                                <td>{{$nonAgriculturalPropertyExpenseDescription1}}</td>
                                <td>{{getFloat($nonAgriculturalPropertyExpenseAmount1)}}</td>
                            </tr>
                            <tr>
                                <td>{{$nonAgriculturalPropertyExpenseDescription2}}</td>
                                <td>{{{getFloat($nonAgriculturalPropertyExpenseAmount2)}}}</td>
                            </tr>
                            <tr>
                                <td>{{$nonAgriculturalPropertyExpenseDescription3}}</td>
                                <td>{{getFloat($nonAgriculturalPropertyExpenseAmount3)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($nonAgriculturalPropertyExpenseAmountTotal)}}</td>
                </tr>
                <tr>
                    <td><strong>3. Agricultural Property (at cost with legal expenses):</strong><br/>
                        <small>Land (Total land and location of land property)</small>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td><u>Description</u></td>
                                <td><u>Amount</u></td>
                            </tr>
                            <tr>
                                <td>{{$agriculturalPropertyExpenseDescription1}}</td>
                                <td>{{getFloat($agriculturalPropertyExpenseAmount1)}}</td>
                            </tr>
                            <tr>
                                <td>{{$agriculturalPropertyExpenseDescription2}}</td>
                                <td>{{{getFloat($agriculturalPropertyExpenseAmount2)}}}</td>
                            </tr>
                            <tr>
                                <td>{{$agriculturalPropertyExpenseDescription3}}</td>
                                <td>{{getFloat($agriculturalPropertyExpenseAmount3)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($agriculturalPropertyExpenseAmountTotal)}}</td>
                </tr>
                <tr>
                    <td><strong>4. Investments</strong></td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($investmentNet)}}</td>
                </tr>
                <tr>
                    <td><label>(a) Provided Fund (Self & Company)</label></td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($providentFundBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($providentFundThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($providentFundNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><label>(b) BSP Purchase</label></td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($bspPurchaseBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($bspPurchaseThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($bspPurchaseNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><label>(c) DPS</label></td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($dpsBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($dpsThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($dpsNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><label>(d) Insurance</label></td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($insuranceBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($insuranceThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($insuranceNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><label>Other Investment</label></td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td></td>
                                <td class="text-right">{{getFloat($otherInvestment)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><label>Share Investment</label></td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td></td>
                                <td class="text-right">{{getFloat($investmentInShareBusiness)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><label><span>LESS:</span> Encashment this year</label></td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($lessEncashmentThisYear)}}</td>
                </tr>
                <tr>
                    <td>
                        <label><strong>5. Motor Vehicles:<small>(at cost)</small></strong><br>
                            <small>{{($motorVehicleDetails)}}</small>
                        </label>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($motorVehicle)}}</td>
                </tr>
                <tr>
                    <td>
                        <label><strong>6. Jewellery <small>(Quantity and Cost)</small></strong><br>
                            <small>{{($jewelleryDetails)}}</small>
                        </label>
                    </td>
                    <td><label>{{$jewelleryBfValueText}}</label></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{(($jewellery <= 0) ? '' : getFloat($jewellery))}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>7. Furniture <small>(Residence) (at cost)</small></strong>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($furniture)}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>8. Electric Equipment <small>(at cost)</small></strong>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($electricEquipment)}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>9. Cash Asset Outside Business</strong>
                    </td>
                    <td><label>As per separated sheet enclosed</label></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($cashAssetOutsideBusiness)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-weight-bold">Total</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($totalAssets - $anyOtherAssetAmount)}}</td>
                </tr>
                </tbody>
            </table>
            <div class="pageBreak"></div>
            <table class="w-100">
                <tbody>
                <tr>
                    <td></td>
                    <td class="font-weight-bold">B/F</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($totalAssets - $anyOtherAssetAmount)}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>10. Any Other Asset <small>(With details)</small></strong><br/>
                        <small>{{$anyOtherAssetDetails}}</small>
                    </td>
                    <td><label></label></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($anyOtherAssetAmount)}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="font-weight-bold">Total Assets</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($totalAssets)}}</td>
                </tr>
                <tr>
                    <td>
                        <strong>11. Less Liabilities</strong><br/>
                        <label>(a) secured Loan</label>
                    </td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($securedLoanBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($securedLoanThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Less Paid</td>
                                <td class="text-right">{{getFloat($securedLoanLessPaid)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($securedLoanNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td>
                        <label>(b) Bank Loan</label>
                    </td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($bankLoanBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($bankLoanThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Less Paid</td>
                                <td class="text-right">{{getFloat($bankLoanLessPaid)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($bankLoanNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td>
                        <label>(c) others</label>
                    </td>
                    <td>
                        <table class="w-100">
                            <tbody>
                            <tr>
                                <td>BF</td>
                                <td class="text-right">{{getFloat($othersLoanBf)}}</td>
                            </tr>
                            <tr>
                                <td>This Year</td>
                                <td class="text-right">{{getFloat($othersLoanThisYear)}}</td>
                            </tr>
                            <tr>
                                <td>Less Paid</td>
                                <td class="text-right">{{getFloat($othersLoanLessPaid)}}</td>
                            </tr>
                            <tr>
                                <td>Net</td>
                                <td class="text-right">{{getFloat($othersLoanNet)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>Total Liabilities</strong></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($totalLiabilities)}}</td>
                </tr>
                <tr>
                    <td><strong>12. Net wealth as on last date of this
                            income year</strong><br/><small>Difference between total assets and total laities</small>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($netWealthThisYear)}}</td>
                </tr>
                <tr>
                    <td><strong>13. Net wealth as on last date of previous income year</strong> <br/><small>(Difference
                            between total assets and total laities)</small>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($netWealthPreviousYear)}}</td>
                </tr>
                <tr>
                    <td><strong>14. Accretion in wealth</strong><small>(Difference
                            between serial serial no. 12 and 13)</small>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($accretionWealth)}}</td>
                </tr>
                <tr>
                    <td>15. (a) Family Expenditure<small>((Total expenditure as per form IT 10 BB))</small>
                    </td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($familyExpenditure)}}</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) Bank Interest</td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($bankInterest)}}</td>
                </tr>
                <tr>
                    <td>(c) Number of dependant children of the family<br/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <table>
                            <tbody>
                            <tr>
                                <td class="text-center border-1">{{$adultChildren}}</td>
                                <td class="text-center border-1">{{$childChildren}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">Adult</td>
                                <td class="text-center">Child</td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                    <td class="text-right">{{''}}</td>
                    <td class="text-right">{{''}}</td>
                </tr>
                <tr>
                    <td><strong>16. Total Accretion of wealth</strong><small>(Total
                            of serial 14 and 15)</small></td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($totalAccretionWealth)}}</td>
                </tr>
                <tr>
                    <td><strong>17. Source Of Fund</strong><br/>(a) Shown Return Income</td>
                    <td class="text-right">{{getFloat($shownReturnIncome)}}</td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>(b) Tax exempted/Tax free income</td>
                    <td class="text-right">{{getFloat($taxFreeIncome)}}</td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td>(c) Fixed asset long life saving and PF</td>
                    <td class="text-right">{{getFloat($fixedAsset)}}</td>
                    <td class="text-right"></td>
                    <td class="text-right"></td>
                </tr>
                <tr>
                    <td></td>
                    <td class=""><strong>Total Source Of Fund</strong></td>
                    <td class="text-right"></td>
                    <td class="text-right">{{getFloat($totalSourceOfFund)}}</td>
                </tr>
                <tr>
                    <td class=""><strong>18. Difference</strong><small>(Between serial 16 and 17)</small></td>
                    <td></td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($difference)}}</td>
                </tr>
                </tbody>
            </table>
            <div class="w-100 text-justify">I solemnly declare that to the best of my
                knowledge and belief the information given in the <strong>IT-10B</strong> is correct and complete.
            </div>
            <div>
                <div style="float: right; width: 30%;">
                    <div class="text-left" style="margin-top: 50px;">
                        <strong>{{($customerName)}}</strong><br/>
                        Name & signature of the Assessee<br/>
                        Date:<br/>
                    </div>
                </div>

                <div style="float: left; width: 54%;">

                </div>

                <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
            </div>
            <div class="w-100 text-justify font-weight-bold">Assets and liabilities of self,
                spouse (if she/he
                is not an assessee), minor children and
                dependant(s) to be shown in the above statements.
            </div>
            <div class="w-100 text-justify font-weight-bold">
                <small>* If needed,please use separate sheet.</small>
            </div>
        </div>
        <div class="pageBreak"></div>
        <div class="w-100">
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="text-right font-weight-bold">Form No. IT-10BB</td>
                </tr>
                <tr>
                    <td class="text-center font-weight-bold">Form</td>
                </tr>
                <tr>
                    <td class="text-left font-weight-bold">
                        <small>Statement under section 75(2(d)(i) and section 80 of the
                            Income Tax Ordinance, 1984<br/> ( XXXVI of 1984) regarding particulars of life style</small>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="w-100">
                <tbody>
                <tr>
                    <td class="text-left"><strong>Name of the Assessee:&nbsp;{{$customerName}}</strong></td>
                    <td class="text-right">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                @if(!empty($etin))
                                    <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">E-TIN</td>
                                    <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">{{(!empty($etin[0]) ? $etin[0] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[1]) ? $etin[1] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[2]) ? $etin[2] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[3]) ? $etin[3] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[4]) ? $etin[4] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[5]) ? $etin[5] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[6]) ? $etin[6] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[7]) ? $etin[7] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[8]) ? $etin[8] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[9]) ? $etin[9] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[10]) ? $etin[10] : '0')}}</td>
                                    <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[11]) ? $etin[11] : '0')}}</td>
                                @else
                                    <td {{$tdHeight}} style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                    <td style="padding: 15px;"></td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="w-100 table table-bordered">
                <thead>
                <tr>
                    <th>Serial</th>
                    <th>Particulars of Expenditure</th>
                    <th colspan="2">Amount of {{getCurrency()}}</th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-center">1</td>
                    <td class="text-left">Personal and family expenses</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($PersonalAndFamilyExpenses)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td class="text-left">Tax Deducted at Source from last financial year</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{($taxDeductedAtSourceFromLastFinancialYear > 0) ? getFloat($taxDeductedAtSourceFromLastFinancialYear) : ''}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td class="text-left">Accommodation expenses</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($accommodationExpenses)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td class="text-left">Transport expenses</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($transportExpenses)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td class="text-left">Electricity Bill for residence</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($electricityBillForResidence)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td class="text-left">Wasa Bill for residence</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($wasaBillForResidence)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">7</td>
                    <td class="text-left">Gas Bill for residence</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($gasBillForResidence)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">8</td>
                    <td class="text-left">Telephone Bill for residence</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($telephoneBillForResidence)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">9</td>
                    <td class="text-left">Festival and other special expenses, if any</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($festivalAndOtherSpecialExpenses)}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-left">Total Expenditure</td>
                    <td class="text-right">{{getCurrency()}}</td>
                    <td class="text-right">{{getFloat($personalAndFamilyExpenditure)}}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <div class="w-100 text-justify">
                I solemnly declare that to the best of my knowledge and belif the information given in the <strong>IT-10BB</strong>
                is correct and complete.

            </div>
            <div>
                <div style="float: right; width: 30%;">
                    <div class="text-left" style="margin-top: 30px;">
                        <strong>{{($customerName)}}</strong><br/>
                        Name & signature of the Assessee<br/>
                        Date:<br/>
                    </div>
                </div>

                <div style="float: left; width: 54%;">

                </div>

                <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
            </div>
            <div class="w-100 text-justify font-weight-bold">* If needed,please use separate sheet.</div>
            <div class="w-100 text-justify font-weight-bold" style="margin-top: 20px;">
                ✂.........................................................................................................................................
            </div>
            <div class="w-100">
                <table class="w-100" style="margin-top: 20px;">
                    <tbody>
                    <tr>
                        <td class="text-center font-weight-bold"><u>Acknowledgement Receipt of Income Tax Return
                            </u></td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td class="text-left"><strong>Name of the Assessee:&nbsp;{{$customerName}}</strong></td>
                        <td class="text-right"><strong>Assessment Year:&nbsp;</strong>{{$assessmentYear}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td class="text-left">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    @if(!empty($etin))
                                        <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">E-TIN</td>
                                        <td {{$tdHeight}} style="padding: 5px 10px 5px 10px;">{{(!empty($etin[0]) ? $etin[0] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[1]) ? $etin[1] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[2]) ? $etin[2] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[3]) ? $etin[3] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[4]) ? $etin[4] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[5]) ? $etin[5] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[6]) ? $etin[6] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[7]) ? $etin[7] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[8]) ? $etin[8] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[9]) ? $etin[9] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[10]) ? $etin[10] : '0')}}</td>
                                        <td style="padding: 5px 10px 5px 10px;">{{(!empty($etin[11]) ? $etin[11] : '0')}}</td>
                                    @else
                                        <td {{$tdHeight}} style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                        <td style="padding: 15px;"></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </td>
                        <td class="text-left"><strong>Tax Circle:&nbsp;</strong>{{$taxCircle}}</td>
                        <td class="text-right"><strong>Tax Zone:&nbsp;</strong>{{$taxZone}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td>Total income shown in Return:&nbsp;</td>
                        <td class="text-right font-weight-bold">{{getCurrency()}}</td>
                        <td class="text-right font-weight-bold">{{getFloat($totalTaxableIncome)}}</td>
                        <td></td>
                        <td>Tax paid:</td>
                        <td class="text-right font-weight-bold">{{getCurrency()}}</td>
                        <td class="text-right font-weight-bold">{{getFloat($netTax)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Net Wealth of Assessee:&nbsp;</td>
                        <td class="text-right font-weight-bold">{{getCurrency()}}</td>
                        <td class="text-right font-weight-bold">{{getFloat($netWealthThisYear)}}</td>
                        <td class="text-left"></td>
                        <td class="text-left">Tax paid:&nbsp;</td>
                        <td class="text-right font-weight-bold"></td>
                        <td class="text-right font-weight-bold"></td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td>Date of receipt of return:&nbsp;</td>
                        <td>Serial No. in return register:&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-70">
                    <tbody>
                    <tr>
                        <td class="text-left">Nature of Return:&nbsp;</td>
                        <td class="border-1 text-center">Self</td>
                        <td class="border-1 text-center">√&nbsp;Universal Self</td>
                        <td class="border-1 text-center">Normal</td>
                    </tr>
                    </tbody>
                </table>
                <div class="w-100">
                    <div style="float: right; width: 30%;">
                        <div class="text-left" style="margin-top: 50px;">
                            Signature of Receiving<br/>
                            Officer with seal.<br/>
                        </div>
                    </div>

                    <div style="float: left; width: 54%;">

                    </div>

                    <div style="clear: both; margin: 0pt; padding: 0pt; "></div>
                </div>
                <div class="w-100 text-left"><small>B.G.P-2007/08-18021F- 1 00 000 Copy, (C-26) 2008.</small></div>
            </div>
        </div>
        <div class="pageBreak"></div>
        <div class="w-100">
            <div class="w-100 text-center pb-10"><u><strong>Instructions to fill up the Return Form
                    </strong></u></div>
            <div class="w-100 border-1 text-justify" style="padding: 5px; font-size: 14px;">
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(1)&nbsp;</span>
                            This return of income shall be signed and verified by the individual assessee or person as
                            prescribed u/s 75 of the Income Tax Ordinance, 1984.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <span>(2)&nbsp;<u>Enclose where applisable:</u></span>
                        <p class="col-xl-12">(a) Salary statement for salary income; Bank statement for interest;
                            Certificate for interest on
                            savings instruments; Rent agreement, receipts of municipal tax and land revenue,
                            statement of house property loan interest, insurance premium for house property income;
                            Statement of professional income as per IT Rule-8; Copy of assessment/ income stasement
                            and balance sheet for partner ship income; Documents of cap[ital gain; Dividend warrant
                            for dividend income; Statement of other income; Document in support of investments in
                            savings certificates, LIP, DPS, Zakat, stock/share etc.</p>
                        <p class="col-xl-12">(b) Statement of income and expenditure; Manufacturing A/C, Trading and
                            Profit
                            & Loss
                            A/C and Balance sheet;</p>
                        <p class="col-xl-12">(c) Depreciation chart claiming depreciation as per THIRD SCHEDULE of the
                            Income Tax
                            Ordinance, 1984;</p>
                        <p class="col-xl-12">(d) Computation of income according to Income tax Law.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <span>(3)&nbsp;<u>Enclose separate statement for:</u></span>
                        <div class="col-xl-12">(a) Any income of the spouse of the assessee (if she/he is not an
                            assessee),
                            minor children and dependant;
                        </div>
                        <div class="col-xl-12">(b) Tax exempted/ tax free income.</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(4)&nbsp;</span>
                            Fullfillment of the conditions laid down in rule-38 is mandatory for submission of a return
                            under
                            "Self Assessment".</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(5)&nbsp;</span>
                            Documents furnished to support the declaration should be signed by the assessee or his/her
                            authorized representative.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(6)&nbsp;</span>
                            The assessee shall submit his/her photograph with return after every five years.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <span>(7)&nbsp;<u>Furnish the following information:</u></span>
                        <div class="col-xl-12">(a) Name, address and TIN of the partners if the assessee is a firm;
                        </div>
                        <div class="col-xl-12">(b) Name of firm, address and TIN if the assessee is a partner;</div>
                        <div class="col-xl-12">(c) Name of the company, address and TIN if the assessee is a director.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(8)&nbsp;</span>
                            Assets and Liabilities of self, spouse (if she/he is not an assessee), minor children and
                            dependant(s) to be shown in the IT-10B.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(9)&nbsp;</span>
                            Signature is mandatory for all the assessee or his/her authorized representative. For
                            individual,
                            signature is also mandatory in I.T-10B and I.T-10BB.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <p><span>(10)&nbsp;</span>
                            If needed, please use sepsrate sheet.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="pageBreak"></div>
        <div class="w-100 border-1">
            <div id="taxCalculation" class="taxCalculation w-100">
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td class="text-center">Computation of Total Income & Tax Liability of</td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold">{{$customerName}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">For the year ended June 30, {{$assessmentYearLast}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-100 table">
                    <thead>
                    <tr>
                        <th class="border-1">Particulars:</th>
                        <th class="border-1">Per Month</th>
                        <th class="border-1">Months</th>
                        <th class="border-1">{{getCurrency()}}</th>
                        <th class="border-1">{{getCurrency()}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left"><strong>(a) Basic Pay</strong><br/>
                            <small>{{$assessmentYearLabel}}</small>
                        </td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($basicPay)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(b) House Allowance</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($houseAllowanceTotal)}}
                            <br/>({{getFloat($houseAllowanceDeduction)}})
                        </td>
                        <td class="text-right">{{getFloat($houseAllowancePayable)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(c) Leave Fare Assistance</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($leaveFareAssistance)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(d) Employer's Cont to PF</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($pfContributionCompanyPart)}}</td>
                        <td class="text-right">{{getFloat($pfContributionSelf)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(e) Medical
                                Allowance</strong><br/><small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($medicalAllowanceTotal)}}
                            <br/>({{getFloat($medicalAllowanceDeduction)}})
                        </td>
                        <td class="text-right">{{getFloat($medicalAllowancePayable)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(f) Festival Bonus</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($festivalBonus)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(g) Conveyance</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($conveyanceTotal)}}<br/>({{getFloat($conveyanceDeduction)}})
                        </td>
                        <td class="text-right">{{getFloat($conveyancePayable)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(h) Incentive</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($incentive)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(i) Other Allowance</strong><br/>
                            <small>{{$assessmentYearLabel}}</small></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($otherAllowance)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Total Taxable Income</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right" style="border-top: 1px solid black; border-bottom: 1px solid
black;">{{getFloat($totalTaxableIncome)}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center" style="border-top: 1px solid black; border-bottom: 1px solid
black;"><strong>Investment(s):</strong></td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(a) C.P.F (Self & Company)</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"><strong>Org</strong><br/>{{getFloat($cpfCompany)}}</td>
                        <td class="text-right"><strong>Self</strong><br/>{{getFloat($cpfSelf)}}</td>
                        <td class="text-right"><strong>Total</strong><br/>{{getFloat($cpfTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(b) BSP</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($bspTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(c) DPS</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right">{{getFloat($dpsInvestment)}}</td>
                        <td class="text-right">{{getFloat($dpsMaxAllow)}}</td>
                        <td class="text-right">{{getFloat($dpsTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(d) Insurance</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($insuranceTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(e) Share Business</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($shareBusinessTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(f) Other Investment</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($otherInvestmentTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong></strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right" style="border-top: 1px solid black; border-bottom: 1px solid
black;">{{getFloat($investmentTotal)}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center" style="border-top: 1px solid black; border-bottom: 1px solid
black;"><strong>Tax Calculation:</strong></td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Total Taxable Income</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right" style="border-top: 1px solid black; border-bottom: 1px solid
black;">{{getFloat($totalTaxableIncome)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Gross Tax</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($grossTax)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Tax Rebate On Investment
                                (Maximum {{getTaxRebateOnInvestmentPercentage(true)}})</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($rebateInvestment)}}</td>
                        <td class="text-right">{{getFloat($rebateInvestmentTotal)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Total Tax</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($totalTaxAmount)}}</td>
                    </tr>
                    @if($surcharge > 0)
                        <tr>
                            <td class="text-left"><strong>Surcharge</strong></td>
                            <td class="text-left"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right">{{getFloat($surcharge)}}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="text-left"><strong>Net Tax</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($netTax + $surcharge)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>(AIT) Advance Tax</strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($aitAdvanceTax)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Tax liability for the A/Y {{$assessmentYear}}
                            </strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right" style="border-top: 1px solid black; border-bottom: 1px solid
black;">{{getFloat($totalPayableTax)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong>Excess Tax Paid for the A.Y {{$assessmentYear}} has been
                                adjusted </strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat(0)}}</td>
                    </tr>
                    <tr>
                        <td class="text-left"><strong> Excess Tax Paid for the A.Y {{$assessmentYear}} </strong></td>
                        <td class="text-left"></td>
                        <td class="text-right"></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($advanceTaxForNextYear)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pageBreak"></div>
        <div class="w-100 border-1">
            <div class="w-100" style="padding: 5px;">
                <table class="w-100">
                    <tbody>
                    <tr>
                        <td class="text-center font-weight-bold">{{$customerName}}</td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold">Income Year: {{$assessmentYearFirst}}
                            -{{$assessmentYearLast}}</td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold">Assessment Year: {{$assessmentYear}}</td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold">Cash For The Year Ended 30<sup>th</sup>
                            June {{$assessmentYearLast}}</td>
                    </tr>
                    </tbody>
                </table>
                <table class="w-100 table">
                    <thead>
                    <tr>
                        <th class="border-1">Particulars</th>
                        <th class="border-1">Amount in {{getCurrency()}}</th>
                        <th class="border-1">Amount in {{getCurrency()}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @if(boolval($customerIsNewTaxPayer))
                            <td><strong>Long life savings</strong></td>
                            <td></td>
                            <td class="text-right">{{getFloat($longLifeSavings)}}</td>
                        @else
                            <td>Cash & Bank Balance (as per last a/c)</td>
                            <td></td>
                            <td class="text-right">{{getFloat($cashAndBankBalance)}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td><u><strong>ADD:</strong></u><br/><strong>Income from Salary</strong></td>
                        <td class="text-right">{{getFloat($incomeFromSalary)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Loan received from bank</strong></td>
                        <td class="text-right">{{getFloat($loanReceivedFromBank)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Encashment of Any Investment</strong></td>
                        <td class="text-right">{{getFloat($encashmentOfAnyInvestment)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Interest received from Bank</strong></td>
                        <td class="text-right">{{getFloat($interestReceivedFromBank)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Other Loan Receive</strong></td>
                        <td class="text-right">{{getFloat($otherLoanReceive)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Any Asset Sale</strong></td>
                        <td class="text-right">{{getFloat($anyAssetSale)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong></strong></td>
                        <td class="text-right"></td>
                        <td class="text-right">{{getFloat($cashInHandAddSum)}}</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td class="text-right"></td>
                        <td class="text-right" style="border-top: 1px solid black;">
                            <strong>{{getFloat($totalAfterAdd)}}</strong></td>
                    </tr>
                    <tr>
                        <td><u><strong>LESS:</strong></u><br/><strong>Personal & Family Expenditure</strong></td>
                        <td class="text-right">{{getFloat($personalAndFamilyExpenditure)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Bank Interest Paid</strong></td>
                        <td class="text-right">{{getFloat($bankInterestPaid)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Bank Loan Paid</strong></td>
                        <td class="text-right">{{getFloat($bankLoanPaid)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Investment In PF Self And Company</strong></td>
                        <td class="text-right">{{getFloat($investmentInPfSelfAndCompany)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Investment in BSP</strong></td>
                        <td class="text-right">{{getFloat($investmentInBsp)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Investment in DPS</strong></td>
                        <td class="text-right">{{getFloat($investmentInDps)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Investment in Share Business</strong></td>
                        <td class="text-right">{{getFloat($investmentInShareBusiness)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Investment in Insurance</strong></td>
                        <td class="text-right">{{getFloat($investmentInInsurance)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Any Other Investment</strong></td>
                        <td class="text-right">{{getFloat($anyOtherInvestment)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong>Any Asset Purchase</strong><br/><small>{{$anyAssetPurchaseDescription}}</small></td>
                        <td class="text-right">{{getFloat($anyAssetPurchase)}}</td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td><strong></strong></td>
                        <td class="text-right"></td>
                        <td class="text-right"><strong>{{getFloat($cashInHandLessSum)}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Cash & Bank Balance as at 30<sup>th</sup> June {{$assessmentYearLast}}</strong>
                        </td>
                        <td class="text-right"></td>
                        <td class="text-right" style="border-top: 1px solid black;">
                            <strong>{{getFloat($yearEndCahInHand)}}</strong></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pageBreak"></div>
        <div class="w-100">
            <table class="w-100" style="margin-bottom: 10px;">
                <tbody>
                <tr>
                    <td class="text-center font-weight-bold">CHALLAN FORM</td>
                </tr>
                </tbody>
            </table>
            <table class="w-100 table">
                <tbody>
                <tr>
                    <td class="text-left font-weight-bold">T.R FORM NO 6 (N.B: S.R 37)
                    </td>
                    <td class="text-center border-1" width="50">1<sup>st</sup>Copy</td>
                    <td class="text-center border-1" width="50">2<sup>nd</sup>Copy</td>
                    <td class="text-center border-1" width="50">3<sup>rd</sup>Copy</td>
                </tr>
                </tbody>
            </table>
            <table class="w-100 table" style="margin-top: 30px;">
                <tbody>
                <tr>
                    <td class="text-left">Challan No:........................................</td>
                    <td class="text-left">Date:........................................</td>
                </tr>
                </tbody>
            </table>
            <table class="w-100 table" style="margin-top: 30px;">
                <tbody>
                <tr>
                    <td class="text-left">Bangladesh Bank/ Sonali Bank ............................. Branch Cash
                        Deposit.
                    </td>
                </tr>
                </tbody>
            </table>
            <div id="challanForm" class="w-100" style="margin-top: 20px;">
                <table class="w-80 table" style="margin-bottom: 20px;">
                    <tbody>
                    <tr>
                        @if(!empty($taxZoneCode))
                            <td width="100">Code No:</td>
                            <td class="border-1 text-center">{{$taxZoneCode[0]}}</td>
                            <td class=""></td>
                            <td class="border-1 text-center">{{$taxZoneCode[1]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[2]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[3]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[4]}}</td>
                            <td class=""></td>
                            <td class="border-1 text-center">{{$taxZoneCode[5]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[6]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[7]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[8]}}</td>
                            <td class=""></td>
                            <td class="border-1 text-center">{{$taxZoneCode[9]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[10]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[11]}}</td>
                            <td class="border-1 text-center">{{$taxZoneCode[12]}}</td>
                    @else
                        <tr>
                            <td width="100">Code No:</td>
                            <td class="border-1 text-center"></td>
                            <td class=""></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class=""></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class=""></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                            <td class="border-1 text-center"></td>
                        </tr>
                        @endif
                        </tr>
                    </tbody>
                </table>
                <table class="w-100 table table-bordered" style="font-size: 12px;">
                    <thead>
                    <tr>
                        <th colspan="4">TO BE FILLED IN BY THE DEPOSITOR</th>
                        <th colspan="2">Amount of Money</th>
                        <th rowspan="2">Name of Division and Name, Designation and department of endorsement Officer of
                            Challan
                        </th>
                    </tr>
                    <tr>
                        <th>Name and address by which the money is deposited.</th>
                        <th>Name, designation and address of Me Person 1 institution for which money has been
                            deposited.
                        </th>
                        <th>Description for what purpose the money has been deposited.</th>
                        <th>Description of Coin & Note / Draft Pay-order & Cheque</th>
                        <th>{{getCurrency()}}</th>
                        <th>Paisa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td height="200"><strong>{{''}}</strong></td>
                        <td><strong>{{$customerName}}</strong><br/>{{$presentAddress}}<br/>{{'Cell: '. $mobile}}<br/>
                            <strong>E-TIN:&nbsp;{{$etin}}</strong>
                        </td>
                        <td>Income Tax Fee<br/>Tax Year&nbsp;{{$assessmentYear}}</td>
                        <td>Cash</td>
                        <td class="text-right">{{getFloat($totalPayableTax)}}</td>
                        <td></td>
                        <td>Deputy Commissioner of Taxes.<br/><br/>Circle:&nbsp;{{$taxCircle}}<br/>Tax
                            Zone:&nbsp;{{$taxZone}}
                        </td>
                    </tr>
                    <tr>
                        <td height="30" colspan="3"></td>
                        <td>Total {{getCurrency()}}</td>
                        <td class="text-right">{{getFloat($totalPayableTax)}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td height="30" colspan="4">Amount <small>(In
                                Word)</small>:&nbsp;{{ucwords($totalPayableTaxInWords)}} {{getCurrency()}} Only
                        </td>
                        <td colspan="3" rowspan="3" style="vertical-align:bottom;text-align:center;">Manager<br/>Bangladesh
                            Bank/Sonali Bank
                        </td>
                    </tr>
                    <tr>
                        <td height="30" colspan="4">Money Received</td>
                    </tr>
                    <tr>
                        <td height="30" colspan="4">Date:</td>
                    </tr>
                    </tbody>
                </table>
                <div class="w-100 text-justify" style="margin-top: 10px;">
                    <small>NOTE 1. please ensure the exam Code by contacting with the respective Department if necessary
                        <br/>2 Endorsement is applicable for those cases only where it is necessary by an
                        officer.</small>
                </div>
            </div>
        </div>
    </div>
@else
    <div>No Data Found</div>
@endif
</body>
</html>

