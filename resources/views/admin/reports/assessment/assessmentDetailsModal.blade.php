<?php
/**
 * Created By: Amit Sarker
 * Created Date: 28-08-2020
 */
?>

<div id="assessmentDetailsModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                @if(!empty($assessmentDetails))
                    <?php
                    $customerId = !empty($assessmentDetails->customer_id) ? intval($assessmentDetails->customer_id) : 0;
                    $customerName = !empty($assessmentDetails->customer_name) ? $assessmentDetails->customer_name : '';
                    $customerGender = !empty($assessmentDetails->gender) ? $assessmentDetails->gender : '';
                    $customerIsNewTaxPayer = !empty($assessmentDetails->is_new_tax_payer) ? intval($assessmentDetails->is_new_tax_payer) : 0;
                    $assessmentYear = !empty($assessmentDetails->assessment_year) ? $assessmentDetails->assessment_year : '';
                    $assessmentYearArray = !empty($assessmentDetails->assessment_year) ? explode('-', $assessmentDetails->assessment_year) : '';
                    $assessmentYearFirst = !empty($assessmentYearArray) ? intval(current($assessmentYearArray)) - 1 : '';
                    $assessmentYearLast = !empty($assessmentYearArray) ? intval(end($assessmentYearArray)) - 1 : '';
                    $taxPayerTypeId = !empty($assessmentDetails->tax_payer_type_id) ? intval($assessmentDetails->tax_payer_type_id) : 0;
                    $employerName = !empty($assessmentDetails->employer_name) ? $assessmentDetails->employer_name : '';
                    $basicPay = !empty($assessmentDetails->basic_pay) ? doubleval($assessmentDetails->basic_pay) : 0;
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
                    $aitAdvanceTax = !empty($assessmentDetails->ait_advance_tax) ? doubleval($assessmentDetails->ait_advance_tax) : 0;
                    $advanceTaxForNextYear = !empty($assessmentDetails->advance_tax_for_next_year) ? doubleval($assessmentDetails->advance_tax_for_next_year) : 0;
                    $totalPayableTax = ($netTax - $aitAdvanceTax); // field
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
                    $bankInterestPaid = !empty($assessmentDetails->bank_interest_paid) ? doubleval($assessmentDetails->bank_interest_paid) : 0;
                    $bankLoanPaid = !empty($assessmentDetails->bank_loan_paid) ? doubleval($assessmentDetails->bank_loan_paid) : 0;
                    $investmentInPfSelfAndCompany = !empty($assessmentDetails->investment_in_pf_self_and_company) ? doubleval($assessmentDetails->investment_in_pf_self_and_company) : 0;
                    $investmentInBsp = !empty($assessmentDetails->investment_in_bsp) ? doubleval($assessmentDetails->investment_in_bsp) : 0;
                    $investmentInDps = !empty($assessmentDetails->investment_in_dps) ? doubleval($assessmentDetails->investment_in_dps) : 0;
                    $investmentInInsurance = !empty($assessmentDetails->investment_in_insurance) ? doubleval($assessmentDetails->investment_in_insurance) : 0;
                    $investmentInShareBusiness = !empty($assessmentDetails->investment_in_share_business) ? doubleval($assessmentDetails->investment_in_share_business) : 0;
                    $anyOtherInvestment = !empty($assessmentDetails->any_other_investment) ? doubleval($assessmentDetails->any_other_investment) : 0;
                    $anyAssetPurchase = !empty($assessmentDetails->any_asset_purchase) ? doubleval($assessmentDetails->any_asset_purchase) : 0;
                    $anyAssetPurchaseDescription = !empty($assessmentDetails->any_asset_purchase_description) ? ($assessmentDetails->any_asset_purchase_description) : 0;
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
                    $furniture = !empty($assessmentDetails->furniture) ? doubleval($assessmentDetails->furniture) : 0;
                    $electricEquipment = !empty($assessmentDetails->electric_equipment) ? doubleval($assessmentDetails->electric_equipment) : 0;
                    $cashAssetOutsideBusiness = !empty($assessmentDetails->cash_asset_outside_business) ? doubleval($assessmentDetails->cash_asset_outside_business) : 0;
                    $anyOtherAssetDetails = !empty($assessmentDetails->any_other_asset_details) ? doubleval($assessmentDetails->any_other_asset_details) : 0;
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
                    ?>
                    {{--Step 1 Start--}}
                    <div id="taxCalculation" class="taxCalculation w-100">
                        <div class="form-group row">
                            <label for="basicPay" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(a) Basic Pay</span>
                                <p><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </p>
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($basicPay)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="houseAllowanceTotal" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(b) House Allowance</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                                <div><small>Less Exempted (Maximum)</small></div>
                            </label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($houseAllowanceTotal)}}</div>
                                <div class="col-form-label text-right">{{getFloat($houseAllowanceDeduction)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($houseAllowancePayable)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leaveFareAssistance" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(c) Leave Fare Assistance</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($leaveFareAssistance)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pfContributionCompanyPart" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(d) Employer's Cont to PF</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                            </label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($pfContributionCompanyPart)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($pfContributionSelf)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="medicalAllowanceTotal" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(e) Medical Allowance</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                                <div><small>Less Exempted 10% on Basic</small></div>
                            </label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($medicalAllowanceTotal)}}</div>
                                <div class="col-form-label text-right">{{getFloat($medicalAllowanceDeduction)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($medicalAllowancePayable)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="festivalBonus" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(f) Festival Bonus</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                            </label>
                            <div class="col-sm-3">
                                {{--            <input type="number" min="0" class="form-control text-right" id="festivalBonus"--}}
                                {{--                   value="0.00"--}}
                                {{--                   name="festival_bonus" placeholder="Festival Bonus">--}}
                                {{--            <input type="number" min="0" class="form-control text-right"--}}
                                {{--                   id="festivalBonusAdd" value="0.00"--}}
                                {{--                   name="festival_bonus_add"--}}
                                {{--                   placeholder="Festival Bonus">--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($festivalBonus)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="conveyanceAllowanceTotal" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(g) Conveyance</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                            </label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($conveyanceTotal)}}</div>
                                <div class="col-form-label text-right">{{getFloat($conveyanceDeduction)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($conveyancePayable)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="incentive" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(h) Incentive</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($incentive)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="otherAllowance" class="col-sm-6 col-form-label"><span
                                    class="font-weight-bold">(i) Other Allowance</span>
                                <div><small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </div>
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($otherAllowance)}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="totalTaxableIncome" class="col-sm-6 col-form-label font-weight-bold">Total
                                Taxable Income
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($totalTaxableIncome)}}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <p for="" class="col-sm-12 col-form-label font-weight-bold text-center border">
                                Investment</p>
                        </div>
                        <div class="form-group row">
                            <label for="cpf" class="col-sm-3 col-form-label">(a) C.P.F (Self & Company)
                            </label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($cpfCompany)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($cpfSelf)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($cpfTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bsp" class="col-sm-3 col-form-label">(b) BSP
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($bspTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dpsInvestment" class="col-sm-3 col-form-label">(c) DPS
                            </label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($dpsInvestment)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($dpsMaxAllow)}}</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($dpsTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dps" class="col-sm-3 col-form-label">(d) Insurance
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($insuranceTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dps" class="col-sm-3 col-form-label">(e) Share Business
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($shareBusinessTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dps" class="col-sm-3 col-form-label">(f) Other Investment
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($otherInvestmentTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label font-weight-bold">
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($investmentTotal)}}</div>
                                <small id="investmentTotalNotification" class="error"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <p for="" class="col-sm-12 col-form-label font-weight-bold text-center border">
                                Tax Calculation</p>
                        </div>
                        <div class="form-group row">
                            <label for="totalTaxableIncomeForInterestAmountCalculation"
                                   class="col-sm-6 col-form-label font-weight-bold">Total
                                Taxable Income

                            </label>
                            <div class="col-sm-3">

                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($totalTaxableIncome)}}</div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="onFirstTaka" class="col-sm-4 col-form-label">On First Taka
                            </label>
                            <div class="col-sm-3">
                                <input type="number" min="0" class="form-control text-right" id="onFirstTaka"
                                       value="0.00"
                                       name="on_first_taka" placeholder="On First Taka">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="onFirstTakaParcent" value="0%"
                                       name="on_first_taka_parcent"
                                       placeholder="On First Taka %">
                            </div>
                            <div class="col-sm-3">

                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="next_balance_taka" class="col-sm-4 col-form-label">Next Balance Taka
                            </label>
                            <div class="col-sm-3">
                                <input type="number" min="0" class="form-control text-right" id="nextBalanceTaka"
                                       value="0.00"
                                       name="next_balance_taka" placeholder="Next Balance Taka">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="nextBalanceTakaParcent" value="0%"
                                       name="next_balance_taka_parcent" placeholder="Next Balance Taka %">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="nextBalanceTakaTotal" value="0.00"
                                       name="next_balance_taka_total" placeholder="Next Balance Taka Total">
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="total_tax" class="col-sm-4 col-form-label">Total Tax
                            </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="nextBalanceTakaTotal" value=""
                                       name="next_balance_taka_total" placeholder="Next Balance Taka Total">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="nextBalanceTakaParcent15" value="15%"
                                       name="next_balance_taka_parcent15" placeholder="Next Balance Taka %">
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Gross Tax
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($grossTax)}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="totalInvestment" class="col-sm-6 col-form-label font-weight-bold">Total
                                Investment
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($investmentTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">Tax Rebate On Investment
                                (Maximum {{getTaxRebateOnInvestmentPercentage(true)}})<p>
                                    <small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </p>
                            </label>

                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($rebateInvestment)}}</div>
                                <small class="error">Actual Investment or {{getTaxRebateOnInvestmentPercentage(true)}}
                                    of Taxable
                                    Income</small>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($rebateInvestmentTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="netTax" class="col-sm-6 col-form-label font-weight-bold">Net Tax
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right font-weight-bold">{{getFloat($netTax)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4 col-form-label">(AIT) Advance Tax<p>
                                    <small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </p>
                            </label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($aitAdvanceTax)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalPayableTax" class="col-sm-4 col-form-label font-weight-bold">Total Payable
                                Tax<p>
                                    <small><span
                                            class="assessmentYearLabel">For the month of July {{$assessmentYearFirst}} to June {{$assessmentYearLast}}</span></small>
                                </p>
                            </label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($totalPayableTax)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="advanceTaxForNextYear" class="col-sm-4 col-form-label">Advance Tax For Next
                                Year</label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($advanceTaxForNextYear)}}</div>
                            </div>
                        </div>
                    </div>
                    {{--Step 1 End--}}
                    {{--Step 2 Start--}}
                    <div id="cashInHandDetails" class="cashInHandDetails w-100">
                        @if(boolval($customerIsNewTaxPayer))
                            <div class="form-group row">
                                <label for="longLifeSavings" class="col-sm-6 col-form-label">Long Life Savings
                                </label>
                                <div class="col-sm-3">
                                    <label for="" class="col-sm-6 col-form-label">BF
                                    </label>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-form-label text-right">{{getFloat($longLifeSavings)}}</div>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <label for="cashAndBankBalance" class="col-sm-6 col-form-label">Cash & Bank Balance (as
                                    per last
                                    a/c)
                                </label>
                                <div class="col-sm-3">
                                    <label for="" class="col-sm-12 col-form-label">BF
                                    </label>
                                </div>
                                <div class="col-sm-3">
                                    <div class="col-form-label text-right">{{getFloat($cashAndBankBalance)}}</div>
                                </div>
                            </div>
                        @endif
                        {{--Add Section start--}}
                        <div class="form-group row">
                            <div for="" class="col-sm-12 col-form-label font-weight-bold"><u>ADD:</u></div>
                            <label for="incomeFromSalary" class="col-sm-6 col-form-label">Income from Salary</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($incomeFromSalary)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="loanReceivedFromBank" class="col-sm-6 col-form-label">Loan received from
                                bank</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($loanReceivedFromBank)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="encashmentOfAnyInvestment" class="col-sm-6 col-form-label">Encashment of Any
                                Investment</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($encashmentOfAnyInvestment)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="interestReceivedFromBank" class="col-sm-6 col-form-label">Interest received from
                                Bank</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($interestReceivedFromBank)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="otherLoanReceive" class="col-sm-6 col-form-label">Other Loan Receive</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($otherLoanReceive)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="anyAssetSale" class="col-sm-6 col-form-label">Any Asset Sale</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($anyAssetSale)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cashInHandAddSum" class="col-sm-6 col-form-label"></label>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($cashInHandAddSum)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        {{--Add Section end--}}

                        <div class="form-group row">
                            <label for="totalAfterAdd" class="col-sm-6 col-form-label font-weight-bold">Total</label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($totalAfterAdd)}}</div>
                            </div>
                        </div>

                        {{--Less Section start--}}
                        <div class="form-group row">
                            <div for="" class="col-sm-12 col-form-label font-weight-bold"><u>LESS:</u></div>
                            <label for="personalAndFamilyExpenditure" class="col-sm-6 col-form-label">Personal & Family
                                Expenditure</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($personalAndFamilyExpenditure)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bankInterestPaid" class="col-sm-6 col-form-label">Bank Interest Paid</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($bankInterestPaid)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bankLoanPaid" class="col-sm-6 col-form-label">Bank Loan Paid</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($bankLoanPaid)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="investmentInPfSelfAndCompany" class="col-sm-6 col-form-label">Investment In PF
                                Self And
                                Company</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($investmentInPfSelfAndCompany)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="investmentInBsp" class="col-sm-6 col-form-label">Investment in BSP</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($investmentInBsp)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="investmentInDps" class="col-sm-6 col-form-label">Investment in DPS</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($investmentInDps)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="investmentInInsurance" class="col-sm-6 col-form-label">Investment in
                                Insurance</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($investmentInInsurance)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="investmentInShareBusiness" class="col-sm-6 col-form-label">Investment in Share
                                Business</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($investmentInShareBusiness)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="anyOtherInvestment" class="col-sm-6 col-form-label">Any Other Investment</label>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($anyOtherInvestment)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="anyAssetPurchase" class="col-form-label">Any Asset Purchase</label>
                                <div class="col-form-label text-left"><small>{{($anyAssetPurchaseDescription)}}</small>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-form-label text-right">{{getFloat($anyAssetPurchase)}}</div>
                            </div>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cashInHandLessSum" class="col-sm-6 col-form-label"></label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($cashInHandLessSum)}}</div>
                            </div>
                        </div>
                        {{--Less Section end--}}
                        <hr>
                        <div class="form-group row">
                            <label for="yearEndCashInHand"
                                   class="col-sm-6 col-form-label font-weight-bold"><span id="yearEndCashInHandLabel">Cash For The Year Ended 30<sup>th</sup>
            June {{$assessmentYearLast}}</span>
                            </label>
                            <div class="col-sm-3">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-3">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($yearEndCahInHand)}}</div>
                            </div>
                        </div>
                    </div>
                    {{--Step 2 End--}}
                    {{--Step 3 Start--}}
                    <div id="assetLiabilityDetails" class="assetLiabilityDetails w-100">
                        <div class="form-group row">
                            <label for="businessCapitalClosingBalance" class="col-sm-8 col-form-label font-weight-bold">1.
                                (a)
                                Business Capital (Closing Balance)</label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div
                                    class="col-form-label text-right">{{getFloat($businessCapitalClosingBalance)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="loanReceivedFromBank" class="col-sm-12 col-form-label font-weight-bold">(b)
                                Directors
                                Shareholdings in Limited
                                Companies (at cost)</label>
                            <div class="col-sm-8">
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-6 mb-1">
                                        <label for="nameOfCompany1" class="col-form-label"><small><u>Name of
                                                    Companies</u></small></label>
                                        <div class="col-form-label text-left">{{($companyName1)}}</div>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <label for="numberOfShare1" class="col-form-label"><small><u>Number of
                                                    Shares</u></small></label>
                                        <div class="col-form-label text-right">{{getFloat($numberOfShare1)}}</div>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <label for="amountOfShare1" class="col-form-label"><small><u>Values of
                                                    Shares</u></small></label>
                                        <div class="col-form-label text-right">{{getFloat($amountOfShare1)}}</div>
                                    </div>
                                </div>
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-6 mb-1">
                                        <div class="col-form-label text-left">{{($companyName2)}}</div>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <div class="col-form-label text-right">{{getFloat($numberOfShare2)}}</div>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <div class="col-form-label text-right">{{getFloat($amountOfShare2)}}</div>
                                    </div>
                                </div>
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-6 mb-1">
                                        <div class="col-form-label text-left">{{($companyName3)}}</div>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <div class="col-form-label text-right">{{getFloat($numberOfShare3)}}</div>
                                    </div>
                                    <div class="col-sm-3 mb-1">
                                        <div class="col-form-label text-right">{{getFloat($amountOfShare3)}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <label for="" class="col-form-label"><u></u></label>
                                <div class="col-form-label text-right">{{getFloat($amountOfShareTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nonAgriculturalPropertyExpense"
                                   class="col-sm-12 col-form-label font-weight-bold">2.
                                Non-Agricultural
                                Property (at cost with
                                legal expenses)<br><small>Land/House
                                    property (Description and location of property)</small></label>
                            <div class="col-sm-8">
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-8 mb-1">
                                        <label for="nonAgriculturalPropertyExpenseDescription"
                                               class="col-form-label"><u>Description</u></label>
                                        <div
                                            class="col-form-label text-left">{{($nonAgriculturalPropertyExpenseDescription1)}}</div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <label for="nonAgriculturalPropertyExpenseAmount" class="col-form-label"><u>Amount</u></label>
                                        <div
                                            class="col-form-label text-right">{{getFloat($nonAgriculturalPropertyExpenseAmount1)}}</div>
                                    </div>
                                </div>
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-8 mb-1">
                                        <div
                                            class="col-form-label text-left">{{($nonAgriculturalPropertyExpenseDescription2)}}</div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <div
                                            class="col-form-label text-right">{{getFloat($nonAgriculturalPropertyExpenseAmount2)}}</div>
                                    </div>
                                </div>
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-8 mb-1">
                                        <div
                                            class="col-form-label text-left">{{($nonAgriculturalPropertyExpenseDescription3)}}</div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <div
                                            class="col-form-label text-right">{{getFloat($nonAgriculturalPropertyExpenseAmount3)}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <label for="" class="col-form-label"><u></u></label>
                                <div
                                    class="col-form-label text-right">{{getFloat($nonAgriculturalPropertyExpenseAmountTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agriculturalPropertyExpense" class="col-sm-12 col-form-label font-weight-bold">3.
                                Agricultural
                                Property (at
                                cost with
                                legal expenses)<br><small>Land (Total land
                                    and location of land property)</small></label>
                            <div class="col-sm-8">
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-8 mb-1">
                                        <label for="agriculturalPropertyExpenseDescription"
                                               class="col-form-label"><u>Description</u></label>
                                        <div
                                            class="col-form-label text-left">{{($agriculturalPropertyExpenseDescription1)}}</div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <label for="agriculturalPropertyExpenseAmount"
                                               class="col-form-label"><u>Amount</u></label>
                                        <div
                                            class="col-form-label text-right">{{getFloat($agriculturalPropertyExpenseAmount1)}}</div>
                                    </div>
                                </div>
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-8 mb-1">
                                        <div
                                            class="col-form-label text-left">{{($agriculturalPropertyExpenseDescription2)}}</div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <div
                                            class="col-form-label text-right">{{getFloat($agriculturalPropertyExpenseAmount2)}}</div>
                                    </div>
                                </div>
                                <div class="form-row col-sm-12">
                                    <div class="col-sm-8 mb-1">
                                        <div
                                            class="col-form-label text-left">{{($agriculturalPropertyExpenseDescription3)}}</div>
                                    </div>
                                    <div class="col-sm-4 mb-1">
                                        <div
                                            class="col-form-label text-right">{{getFloat($agriculturalPropertyExpenseAmount3)}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <label for="" class="col-form-label"><u></u></label>
                                <div
                                    class="col-form-label text-right">{{getFloat($agriculturalPropertyExpenseAmountTotal)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="investmentNet" class="col-sm-8 col-form-label font-weight-bold">4.
                                Investments</label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($investmentNet)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="providentFundBf" class="col-sm-7 col-form-label">(a) Providend Fund (Self
                                &Company)</label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($providentFundBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($providentFundThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($providentFundNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bspPurchaseBf" class="col-sm-7 col-form-label">(b) BSP Purchase <small>(Whole
                                    BSP where
                                    inheret from Mother)</small></label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($bspPurchaseBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($bspPurchaseThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($bspPurchaseNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dpsBf" class="col-sm-7 col-form-label">(c) DPS</label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($dpsBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($dpsThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($dpsNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="insuranceBf" class="col-sm-7 col-form-label">(d) Insurance</label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($insuranceBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($insuranceThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($insuranceNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="otherInvestment" class="col-sm-8 col-form-label">Other Investment</label>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($otherInvestmentTotal)}}</div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lessEncashmentThisYear" class="col-sm-8 col-form-label"><span>LESS:</span>
                                Encashment
                                this year</label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($lessEncashmentThisYear)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="motorVehicle" class="col-sm-8 col-form-label font-weight-bold">5. Motor
                                Vehicles:
                                <small>(at
                                    cost)</small><br>
                                <div class="col-form-label text-left"><small>{{($motorVehicleDetails)}}</small></div>
                            </label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($motorVehicle)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jewelleryDetails" class="col-sm-8 col-form-label font-weight-bold">6. Jewellery
                                <small>(Quantity and
                                    Cost)</small><br>
                                <div class="col-form-label text-left"><small>{{($jewelleryDetails)}}</small></div>
                            </label>
                            <div class="col-sm-2">
                                <label for="" id="jewelleryBfValueText" class="col-form-label">
                                    @if($jewellery <= 0)
                                        B/F value not known
                                    @endif
                                </label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($jewellery)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="furniture" class="col-sm-8 col-form-label font-weight-bold">7. Furniture <small>(Residence)
                                    (at
                                    cost)</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($furniture)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="electricEquipment" class="col-sm-8 col-form-label font-weight-bold">8. Electric
                                Equipment <small>(at
                                    cost)</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($electricEquipment)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cashAssetOutsideBusiness" class="col-sm-8 col-form-label font-weight-bold">9.
                                Cash Asset
                                Outside
                                Business</label>
                            <div class="col-sm-2">
                                <label for="" class="col-form-label">As per separated sheet
                                    enclosed</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($cashAssetOutsideBusiness)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <label for="anyOtherAsset" class="col-form-label font-weight-bold">10. Any Other Asset
                                    <small>(With
                                        details)</small></label>
                                <div class="form-row">
                                    <div class="col">
                                        <div class="col-form-label text-left"><small>{{($anyOtherAssetDetails)}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="" class="col-form-label w-100">B/F</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($anyOtherAssetAmount)}}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="" class="col-sm-8 col-form-label"></label>
                            <div class="col-sm-2">
                                <label for="totalAssets" class="col-form-label font-weight-bold">Total Assets</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($totalAssets)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lessLiabilities" class="col-sm-12 col-form-label font-weight-bold">11. Less
                                Liabilities</label>
                            <label for="securedLoan" class="col-sm-7 col-form-label">(a) secured Loan</label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($securedLoanBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($securedLoanThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Less Paid</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($securedLoanLessPaid)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($securedLoanNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bankLoan" class="col-sm-7 col-form-label">(b) Bank Loan</label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($bankLoanBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($bankLoanThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Less Paid</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($bankLoanLessPaid)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($bankLoanNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="others" class="col-sm-7 col-form-label">(c) others</label>
                            <div class="col-sm-3">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>BF</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($othersLoanBf)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>This Year</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($othersLoanThisYear)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Less Paid</td>
                                        <td>
                                            <div
                                                class="col-form-label text-right">{{getFloat($othersLoanLessPaid)}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Net</td>
                                        <td>
                                            <div class="col-form-label text-right">{{getFloat($othersLoanNet)}}</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="" class="col-sm-8 col-form-label"></label>
                            <div class="col-sm-2">
                                <label for="totalLiabilities" class="col-form-label font-weight-bold">Total
                                    Liabilities</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($totalLiabilities)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="netWealthThisYear" class="col-sm-8 col-form-label"><span
                                    class="font-weight-bold">12. Net wealth as on last date of this
                        income year</span><br><small>Difference between total assets and total laities</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($netWealthThisYear)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="netWealthPreviousYear" class="col-sm-8 col-form-label"><span
                                    class="font-weight-bold">13. Net wealth as on last date of
                        previous
                        income year</span><br><small>Difference between total assets and total laities</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($netWealthPreviousYear)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="accretionWealth" class="col-sm-8 col-form-label"><span class="font-weight-bold">14. Accretion in wealth</span>
                                <small>(Difference
                                    between serial serial no. 12 and 13)</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($accretionWealth)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="familyExpenditure" class="col-sm-8 col-form-label"><span
                                    class="font-weight-bold">15. (a) Family Expenditure</span>
                                <small>(Total
                                    expenditure as per form IT 10 BB)</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($familyExpenditure)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bankInterest" class="col-sm-8 col-form-label"><span
                                    class="font-weight-bold">(b) Bank Interest</span>
                                <small></small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($bankInterest)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="numberOfChildren" class="col-sm-8 col-form-label">(b) Number of dependant
                                children of
                                the
                                family</label>
                            <br>
                            <div class="w-100 col-xs-12">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="col-form-label text-left">Adult: {{getFloat($adultChildren)}}</div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-group">
                                        <div class="col-form-label text-right">Child: {{getFloat($childChildren)}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">

                            </div>
                            <div class="col-sm-2">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="totalAccretionWealth" class="col-sm-8 col-form-label"><span
                                    class="font-weight-bold">16. Total Accretion of wealth</span>
                                <small>(Total
                                    of serial 14 and 15)</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($totalAccretionWealth)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sourceOfFund" class="col-sm-12 col-form-label font-weight-bold">17. Source Of
                                Fund</label>
                            <label for="shownReturnIncome" class="col-sm-8 col-form-label">(a) Shown Return
                                Income</label>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($shownReturnIncome)}}</div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="taxFreeIncome" class="col-sm-8 col-form-label">(b) Tax exempted/Tax free
                                income</label>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($taxFreeIncome)}}</div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fixedAsset" class="col-sm-8 col-form-label">(c) Fixed asset long life saving and
                                PF</label>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($fixedAsset)}}</div>
                            </div>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-8 col-form-label"></label>
                            <div class="col-sm-2">
                                <label for="totalSourceOfFund" class="col-form-label font-weight-bold">Total Source Of
                                    Fund</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-right">{{getFloat($totalSourceOfFund)}}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="difference" class="col-sm-8 col-form-label"><span
                                    class="font-weight-bold">18. Difference</span> <small>(Between serial 16 and
                                    17)</small></label>
                            <div class="col-sm-2">
                                {{--Blank--}}
                            </div>
                            <div class="col-sm-2">
                                <div
                                    class="col-form-label text-right font-weight-bold">{{getFloat($difference)}}</div>
                            </div>
                        </div>
                    </div>
                    {{--Step 3 End--}}
                    {{--Step 4 Start--}}
                    @if($annualRentalIncome > 0)
                        <div id="housePropertyIncome" class="form-group row table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><label for="annualRentalIncome" class="col-form-label">1. Annual rental
                                            income</label></td>
                                    <td></td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($annualRentalIncome)}}</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="" class="col-form-label">2. Claimed Expenses:</label></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="repairCollection"
                                               class="col-form-label">Repair,Collection,etc.</label></td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($repairCollection)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="municipalOrLocalTax" class="col-form-label">Municipal or Local
                                            Tax</label></td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($municipalOrLocalTax)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="landRevenue" class="col-form-label">Land Revenue</label></td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($landRevenue)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="interestOnLoanMortgageCapital" class="col-form-label">Interest on
                                            Loan/Mortgage/Capital
                                            Charge</label></td>
                                    <td>
                                        <div
                                            class="col-form-label text-right">{{getFloat($interestOnLoanMortgageCapital)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="insurancePremium" class="col-form-label">Insurance Premium</label>
                                    </td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($insurancePremium)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="vacancyAllowance<" class="col-form-label">Vacancy Allowance</label>
                                    </td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($vacancyAllowance)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="otherClaimedExpenses" class="col-form-label">Other, if any</label>
                                    </td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($otherClaimedExpenses)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="totalClaimedExpenses" class="col-form-label font-weight-bold">Total
                                            =</label></td>
                                    <td>
                                        <div class="col-form-label text-right">{{getFloat($totalClaimedExpenses)}}</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><label for="diffAnnualRentalIncomeClaimedExpenses" class="col-form-label">3. Net
                                            income (difference
                                            between item 1 and 2)</label></td>
                                    <td></td>
                                    <td>
                                        <div
                                            class="col-form-label text-right">{{getFloat($diffAnnualRentalIncomeClaimedExpenses)}}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    {{--Step 4 End--}}
                @else
                    <div>No Data Found</div>
                @endif
            </div>
            <div class="modal-footer">
                <button id="printPdfButton" type="button" class="btn btn-info d-none">Print Pdf</button>
                <button id="closeButton" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
