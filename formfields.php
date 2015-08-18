<?php
return array(
  'enabled' => array(
        'title' => __('Enable/Disable', 'woocommerce-ozpost'),
        'type' => 'checkbox',
        'label' => __('Enable this shipping method', 'woocommerce-ozpost'),
        'default' => 'no',
    ),
    'origin_postcode' => array(
        'title' => __('Shipping From Postcode', 'woocommerce-ozpost'),
        'type' => 'text', 'css' => 'width: 45px;',
        'default' => '0000',
    ),    
    
        'origin_suburb' => array(
        'title' => __('Shipping From Suburb', 'woocommerce-ozpost'),
        'type' => 'text',
        'css' => 'width: 200px;',
        'default' => '',
        'placeholder' => __('based on the Shipping From Postcode', 'woocommerce-ozpost'),
    ),
    
       'store_postcode' => array(
        'title' => __('Store PostCode<br>(if different from Shipping)', 'woocommerce-ozpost'),
        'type' => 'text', 'css' => 'width: 45px;',
        'default' => '',
    ),
    
        'subscriptions_email' => array(
        'title' => __('Subscription Reminders to ', 'woocommerce-ozpost'),
        'type' => 'text',
        'css' => 'width: 350px;',
        'default' => get_option('admin_email'),        
        'placeholder' => __( get_option('admin_email'), 'woocommerce-ozpost'),
    ),
    
    'letter_methods' => array(
        'title' => __('Letters & parcels @letter rates', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => array('Aust Standard', 'Aust Priority'),
        'options' => array('Aust Standard' => "Aust Standard",
            'Aust Standard Insured' => "Aust Standard Insured",
            'Aust Priority' => "Aust Priority",
            'Aust Priority Insured' => "Aust Priority Insured",
            'Aust Registered' => "Aust Registered",
            'Aust Insured' => "Aust Insured",
            'Aust Express' => "Aust Express",
            'Overseas Standard' => "Overseas Standard",
            'Overseas Registered' => "Overseas Registered",
            'Overseas Express' => "Overseas Express",
            'Overseas Express EPI' => "Overseas Express EPI",
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'letter_handling' => array(
        'title' => __('Handling Fee for letters', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;','css' => 'color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '0.50'
    ),
    'hide_parcel_if_domestic_letter' => array(
        'title' => __('Hide parcels if letter sized (domestic)', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => 'If the items can be sent as a Domestic Letter would you like to hide the parcel rates? Note: Has no effect if debug is enabled',
        'default' => 'no',
    ),
    'hide_parcel_if_international_letter' => array(
        'title' => __('Hide parcels if letter sized (Overseas)', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => 'If the items can be sent as an International Letter would you like to hide the parcel rates? Note: Has no effect if debug is enabled',
        //  'desc_tip' => true,
        'default' => 'no',
    ),
    'satchel_methods' => array(
        'title' => __('Australia Post Satchels', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => array('PPS5', 'PPS3' , 'PPS5K'),
        'options' => array('PPS5' => "500g",
            'PPS3' => "3Kg",
            'PPS5K' => "5kg",
            'PPS5r' => "500g + Signature",
            'PPS3r' => "3Kg + Signature",
            'PPS5Kr' => "5kg + Signature",
            'PPS5i' => "500g Insured + Signature",
            'PPS3i' => "3kg Insured + Signature",
            'PPS5Ki' => "5kg Insured + Signature",
            'PPSE5' => "500g Express",
            'PPSE3' => "3Kg Express",
            'PPSE5K' => "5Kg Express",
            'PPSP5' => "500g Express + Signature",
            'PPSP3' => "3kg Express + Signature",
            'PPSP5K' => "5kg Express + Signature",
            'PPSP3i' => "3kg Insured Express + Signature",
            'PPSP5i' => "500g Insured Express + Signature",
            'PPSP5Ki' => "5kg Insured Express + Signature"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'pps_handling' => array(
        'title' => __('Handling Fee Satchels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.00'
    ),
    'ppse_handling' => array(
        'title' => __('Handling Fee Express Satchels ', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.50'
    ),
    'ppsi_handling' => array(
        'title' => __('Handling Fee Insured Express Satchels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '2.00'
    ),
    'ap_discount_1r' => array(
        'title' => __('Use Discount rate for Regular 500g Satchels?', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 80px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'No',
        'options' => array(
            'No' => __('No', 'woocommerce-ozpost'),
            '5' => __('5%', 'woocommerce-ozpost'),
            '12.5' => __('12.5%')
        ),
    ),
    'ap_discount_2r' => array(
        'title' => __('Use Discount rate for Regular 3kg Satchels?', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 80px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'No',
        'options' => array(
            'No' => __('No', 'woocommerce-ozpost'),
            '5' => __('5%', 'woocommerce-ozpost'),
            '12.5' => __('12.5%')
        ),
    ),
    'ap_discount_3r' => array(
        'title' => __('Use Discount rate for Regular 5kg Satchels?', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 80px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'No',
        'options' => array(
            'No' => __('No', 'woocommerce-ozpost'),
            '5' => __('5%', 'woocommerce-ozpost'),
            '12.5' => __('12.5%')
        ),
    ),
    'ap_discount_1e' => array(
        'title' => __('Use Discount rate for Express 500g Satchels?', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 80px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'No',
        'options' => array(
            'No' => __('No', 'woocommerce-ozpost'),
            '5' => __('5%', 'woocommerce-ozpost'),
            '12.5' => __('12.5%')
        ),
    ),
    'ap_discount_2e' => array(
        'title' => __('Use Discount rate for Express 3kg Satchels?', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 80px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'No',
        'options' => array(
            'No' => __('No', 'woocommerce-ozpost'),
            '5' => __('5%', 'woocommerce-ozpost'),
            '12.5' => __('12.5%')
        ),
    ),
    'ap_discount_3e' => array(
        'title' => __('Use Discount rate for Express 5kg Satchels?', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 80px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'No',
        'options' => array(
            'No' => __('No', 'woocommerce-ozpost'),
            '5' => __('5%', 'woocommerce-ozpost'),
            '12.5' => __('12.5%')
        ),
    ),
    'hide_parcel_if_satchel' => array(
        'title' => __('Hide parcels if Satchel sized', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => 'If the items will fit into a satchel would you like to hide the parcel rates?',
        'default' => 'no',
    ),
    'parcel_methods' => array(
        'title' => __('Australia Post Parcels', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => array('RPP', 'RPPi'),
        'options' => array(
            'RPP' => "Regular",
            'REG' => "Regular + Signature",
            'EXP' => "Express",
            'RPPi' => "Insured",
            'PLT' => "Express + Signature",
            'PLTi' => "Insured Express (inc signature)",
            'COD' => "Cash on Delivery",
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'rpp_handling' => array(
        'title' => __('Handling Fee for parcels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.00'
    ),
    'exp_handling' => array(
        'title' => __('Handling Fee for Express parcels', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.50'
    ),
    'clicknsend_methods' => array(
        'title' => __('Click n Send', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('CNS500' => "500g Satchel",
            'CNS3K' => "3kg Satchel",
            'CNS5K' => "5kg Satchel",
            'CNS500e' => "500g Satchel +Signature",
            'CNS3Ke' => "3kg Satchel +Signaturee",
            'CNS5Ke' => "5kg Satchel +Signature",
            'CNSbx1' => "Small box 1kg",
            'CNSbx2' => "Medium box 3kg",
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'cnss_handling' => array(
        'title' => __('Handling Fee Click n Send Satchels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.00'
    ),
    'cnsb_handling' => array(
        'title' => __('Handling Fee Click n Send Boxes', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.00'
    ),
    'overseas_parcel_methods' => array(
        'title' => __('Australia Post Overseas Parcels', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => array('AIR', 'AIRi', 'PAT'),
        'options' => array('AIR' => "Air",
            'AIRr' => "Registered Air",
            'AIRi' => "Insured Air",
            'RPIPP5' => "Registered Air 500g Prepaid bag",
            'RPIPP1' => "Registered Air 1kg Prepaid bag",
            'PAT' => "Pack and Track Parcels",
            'PATPPS' => "Pack and Track 1kg Prepaid Satchel",
            'EPI' => "Express Parcel International (EPI)",
            'EPIi' => "Insured Express Parcel International (EPI)",
            'EPIP2' => "EPI 2kg Prepaid Satchel",
            'EPIP3' => "EPI 3kg Prepaid Satchel",
            'EPIP5' => "EPI 5kg Prepaid Box",
            'EPIP10' => "EPI 10kg Prepaid Box",
            'EPIP20' => "EPI 20kg Prepaid Box",
            'SEA' => "Sea",
            'SEAi' => "Insured Sea",
            'ECId' => "Express Courier International Documents (ECI)",
            'ECIdi' => "Express Courier International Documents insured (ECI)",
            'ECIm' => "Express Courier International Merchandise (ECI)",
            'ECImi' => "Express Courier International Merchandise insured (ECI)",
            'ECIp' => "Express Courier International Platinum (ECI)",
            'ECIpi' => "Express Courier International Merchandise insured (ECI)",
            'ECIP500g' => "ECI 500gm Prepaid Satchel",
            'ECIP1' => "ECI 1Kg Prepaid Satchel",
            'ECIP2' => "ECI 2Kg Prepaid Satchel",
            'ECIP3' => "ECI 3Kg Prepaid Satchel",
            'ECIP5k' => "ECI 5Kg Prepaid Box",
            'ECIP10' => "ECI 10Kg Prepaid Box",
            'ECIP20' => "ECI 20Kg Prepaid Box",
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'overseas_handling' => array(
        'title' => __('Handling Fee Overseas Parcels', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'eci_documents_handling' => array(
        'title' => __('Handling Fee ECI Documents', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '2.00'
    ),
    'eci_merchandise_handling' => array(
        'title' => __('Handling Fee ECI Merchandise', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'epi_handling' => array(
        'title' => __('Handling Fee EPI Merchandise ', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'hide_courier_if_ap_can_handle' => array(
        'title' => __('Hide Couriers if Australia Post can handle it?', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => 'If the items can be sent via Australia Post would you like to hide the Courier rates?  Note: Has no effect if debug is enabled',
        'default' => 'no',
    ),
      'cpl_methods' => array(
        'title' => __('Couriers Please Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('CPL' => "Parcels (account needed)",
            'CPLi' => "Insured Parcels (account needed)",
            'CPL1' => "1kg Satchel (account not needed for quotes)",
            'CPL3' => "3kg Satchel (account not needed for quotes)",
            'CPL5' => "5kg Satchel (account not needed for quotes)",
            'CPLlab' => "EZY Quote (account not needed for quotes)"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'cpl_account' => array(
        'title' => __('Couriers Please Account', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('Only needed if \'Account needed\' methods have been selected', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('Account', 'woocommerce-ozpost')
    ),
    'cpl_cust' => array(
        'title' => __('Couriers Please Customer', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('Only needed if \'Account needed\' methods have been selected', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('Customer', 'woocommerce-ozpost')
    ),
    'cpl_ref' => array(
        'title' => __('Couriers Please Ref#', 'woocommerce-ozpost'),
        'type' => 'input',
        'description' => __('Only needed if \'Account needed\' methods have been selected', 'woocommerce-ozpost'),
        'default' => '', 'css' => 'width: 170px;',
        'desc_tip' => false,
        'placeholder' => __('Reference#', 'woocommerce-ozpost')
    ),
    'cpl_handling' => array(
        'title' => __('Handling Fee Couriers Please Parcels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;', 'description' => __('', 'woocommerce-ozpost'),
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'cpl_satchel_handling' => array(
        'title' => __('Handling Fee Couriers Please Satchels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;', 'description' => __('', 'woocommerce-ozpost'),
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'cpl_metro_labels' => array(
        'title' => __('Couriers Please Metro labels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: green;', 'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
        'placeholder' => wc_format_localized_price(0),
        'default' => '0.00'
    ),
    'cpl_ezy_labels' => array(
        'title' => __('Couriers Please EZY link labels', 'woocommerce-ozpost'),
        'type' => 'price',  'css' => 'width: 50px;color: green;', 'description' => __('Leave at 0.00 for Standard rates, else enter your custom rates', 'woocommerce-ozpost'),
        'placeholder' => wc_format_localized_price(0),
        'default' => '0.00'
    ),
    'ego_methods' => array(
        'title' => __('E-Go.com.au Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('EGO' => "Parcels",
            'EGOi' => "Insured Parcels"),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'ego_handling' => array(
        'title' => __('Handling Fee E-Go ', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;', 'description' => __('', 'woocommerce-ozpost'),
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    
    'fastway_methods' => array(
        'title' => __('Fastway Courier Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect', 'description' => 'No account needed for quotes', 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('FWL_RED' => "Red Label",
            'FWL_ORANGE' => "Orange Label",
            'FWL_GREEN' => "Green Label",
            'FWL_WHITE' => "White Label",
            'FWL_GREY' => "Grey Label",
            'FWL_BROWN' => "Brown Label",
            'FWL_BLACK' => "Black Label",
            'FWL_BLUE' => "Blue Label",
            'FWL_YELLOW' => "Yellow Label",
            'FWL_LIME' => "Lime Label",
            'FWL_PINK' => "Pink Label",
            'FWS1' => "A5 Satchel (1Kg)",
            'FWS3l' => "A3 Satchel (local)",
            'FWS3' => "A3 Satchel (3Kg)",
            'FWS5' => "A2 Satchel (5Kg)",
            'FWB1' => "Small Box",
            'FWB2' => "Medium Box",
            'FWB3' => "Large Box",
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'fastway_city' => array(
        'title' => __('Fastway Distributor', 'woocommerce-ozpost'),
        'type' => 'select',
        'class' => 'wc-enhanced-select',
        'css' => 'width: 150px;',
        'default' => '',
        'options' => array('DIS' => __("Disabled"),
            'ADL' => __("Adelaide"),
            'ALB' => __("Albury"),
            'BEN' => __("Bendigo"),
            'BRI' => __("Brisbane"),
            'CNS' => __("Cairns"),
            'CBR' => __("Canberra"),
            'CAP' => __("Capricorn Coast"),
            'CCT' => __("Central Coast"),
            'CFS' => __("Coffs Harbour"),
            'GEE' => __("Geelong"),
            'GLD' => __("Gold Coast"),
            'TAS' => __("Hobart"),
            'LAU' => __("Launceston"),
            'MKY' => __("Mackay"),
            'MEL' => __("Melbourne"),
            'NEW' => __("Newcastle"),
            'NTH' => __("Northern Rivers"),
            'PER' => __("Perth"),
            'PQQ' => __("Port Macquarie"),
            'SUN' => __("Sunshine Coast"),
            'SYD' => __("Sydney"),
            'TOO' => __("Toowoomba"),
            'TVL' => __("Townsville"),
            'BDB' => __("Wide Bay"),
            'WOL' => __("Wollongong"),
            'custom_attributes' => array(
                'data-placeholder' => __('Select City', 'woocommerce-ozpost')
            )
        ),
    ),
    'fastway_frequentUser' => array(
        'title' => __('Fastway frequent user rates', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => 'Frequent users have lower rates, but requires a minimum monthly spend.',
        'default' => 'no'
    ),
    'fastway_labels_handling' => array(
        'title' => __('Handling Fee Fastway Labels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '2.00'
    ),
    'fastway_satchels_handling' => array(
        'title' => __('Handling Fee Fastway Satchels', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.00'
    ),
    'fastway_boxes_handling' => array(
        'title' => __('Handling Fee Fastway Boxes', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '1.00'
    ),
    'fastway_special_baseweight' => array(
        'title' => __('Special user Base weight (kg)', 'woocommerce-ozpost'),
        'type' => 'input',
        'description' => __('If you don\'t know what this is for leave it blank', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
        'css' => 'width: 50px;',
        'placeholder' => 'Weight in Kgs',
        'default' => '0'
    ),
       'skp_methods' => array(
        'title' => __('Skippy Post (Overseas only)', 'woocommerce-ozpost'),
        'type' => 'multiselect', 'description' => __('Account not needed for quotes', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('SKP' => "Air",
            'SKPp' => "Air +Proof of postage",
            'SKPt' => "Air with Tracking",
            'SKPti' => "Air with Tracking and Insurance",
            'SKPtip' => "Air with Tracking +Insurance +Proof of post",
            'SKPtp' => "Air with Tracking +Proof of postage"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'skp_customerId' => array(
        'title' => __('Skippy Post Customer Identifier', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('Optional: Cheaper rates if supplied', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('CustomerID', 'woocommerce-ozpost')
    ),
    'skp_handling' => array(
        'title' => __('Handling Fee SkippyPost', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'sms_methods' => array(
        'title' => __('SmartSend Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect', 'description' => __('A SmartSend Customer email address is required for VALID quotes. These quotes can take a while to be returned. This is due to the SmartSend Servers, not the ozpost servers. ', 'woocommerce-ozpost'), //'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array(
            'SMSCPR' => "Couriers Please Road",
            'SMSCPRr' => "Couriers Please Road (receipted)",
            'SMSCPRi' => "Couriers Please Road (insured)",
            'SMSCPRri' => "Couriers Please Road (receipted + insured)",
            'SMSAAE1K' => "AAE 1kg Prepaid Satchel",
            'SMSAAE1Kr' => "AAE 1kg Prepaid Satchel (receipted)",
            'SMSAAE1Ki' => "AAE 1kg Prepaid Satchel (insured)",
            'SMSAAE1Kri' => "AAE 1kg Prepaid Satchel (receipted + insured)",
            'SMSAAE3K' => "AAE 3kg Prepaid Satchel",
            'SMSAAE3Kr' => "AAE 3kg Prepaid Satchel (receipted",
            'SMSAAE3Ki' => "AAE 3kg Prepaid Satchel (insured)",
            'SMSAAE3Kri' => "AAE 3kg Prepaid Satchel (receipted + insured)",
            'SMSAAE5K' => "SMSAAE5K	AAE 5kg Prepaid Satchel",
            'SMSAAE5Kr' => "AAE 5kg Prepaid Satchel (receipted)",
            'SMSAAE5Ki' => "AAE 5kg Prepaid Satchel (insured)",
            'SMSAAE5Kri' => "AAE 5kg Prepaid Satchel (receipted + insured)",
            'SMSAAER' => "AAE : Road",
            'SMSAAERr' => "AAE : Road (receipted)",
            'SMSAAERi' => "AAE : Road (insured)",
            'SMSAAERri' => "AAE : Road (receipted + insured)",
            'SMSAAEP' => "AAE : Express Premium",
            'SMSAAEPr' => "AAE : Express Premium (receipted)",
            'SMSAAEPi' => "AAE : Express Premium (insured)",
            'SMSAAEPri' => "AAE : Express Premium (receipted + insured)",
            'SMSAAES' => "AAE : Express Saver",
            'SMSAAESr' => "AAE : Express Saver (receipted)",
            'SMSAAESi' => "AAE : Express Saver (insured)",
            'SMSAAESri' => "AAE : Express Saver (receipted + insured)",
            'SMSFW' => "Fastway : National Road",
            'SMSFWr' => "Fastway : National Road (receipted)",
            'SMSFWi' => "Fastway : National Road (insured)",
            'SMSFWri' => "Fastway : National Road (receipted + insured)",
            'SMSFWL' => "Fastway : Local",
            'SMSFWLr' => "Fastway : Local (receipted)",
            'SMSFWLi' => "Fastway : Local (insured)",
            'SMSFWLri' => "Fastway : Local (receipted + insured)",
            'SMSFWSr' => "Fastway : Satchels (receipted)",
            'SMSFWSi' => "Fastway : Satchels (insured)",
            'SMSFWSri' => "Fastway : Satchels (receipted + insured)",
            'SMSTNT9' => "TNT : Overnight by 9am",
            'SMSTNT9r' => "TNT : Overnight by 9am (receipted)",
            'SMSTNT9i' => "TNT : Overnight by 9am (insured)",
            'SMSTNT9ri' => "TNT : Overnight by 9am (receipted + insured)",
            'SMSTNT12' => "TNT : Overnight by 12pm",
            'SMSTNT12r' => "TNT : Overnight by 12pm (receipted)",
            'SMSTNT12i' => "TNT : Overnight by 12pm (insured)",
            'SMSTNT12ri' => "TNT : Overnight by 12pm (receipted + insured)",
            'SMSTNT5' => "TNT : Overnight by 5pm",
            'SMSTNT5r' => "TNT : Overnight by 5pm (receipted)",
            'SMSTNT5i' => "TNT : Overnight by 5pm (insured)",
            'SMSTNT5ri' => "TNT : Overnight by 5pm (receipted + insured)",
            'SMSTNTR' => "TNT : Road",
            'SMSTNTRr' => "TNT : Road (receipted)",
            'SMSTNTRi' => "TNT : Road (insured)",
            'SMSTNTRri' => "TNT : Road (receipted + insured)"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'sms_email' => array(
        'title' => __('Email Address', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 250px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('Acct Email Address. hint: Try \'Demo\'', 'woocommerce-ozpost')
    ),
    'sms_password' => array(
        'title' => __('Password', 'woocommerce-ozpost'),
        'type' => 'password', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
    //  'placeholder' => __('********', 'woocommerce-ozpost')
    ),
    'sms_customer_type' => array(
        'title' => __('Customer Type', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 130px;',
        'description' => __('Your Choice.', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'VIP',
        'options' => array(
            'VIP' => __('VIP', 'woocommerce-ozpost'),
            'CASUAL' => __('CASUAL', 'woocommerce-ozpost'),
            'EBAY' => __('EBAY', 'woocommerce-ozpost'),
            'CORPORATE' => __('CORPORATE', 'woocommerce-ozpost'),
            'PROMOTION' => __('PROMOTION', 'woocommerce-ozpost'),
            'REFERRAL' => __('REFERRAL', 'woocommerce-ozpost')
        ),
    ),
        
    'sms_handling' => array(
        'title' => __('Handling Fee SmartSend', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
     'sta_methods' => array(
        'title' => __('StarTrack Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect', 'description' => __('A StarTrack Account is required for these quotes.  These quotes can take a while to be returned. This is due to the StarTrack Servers, not the ozpost servers.', 'woocommerce-ozpost'),
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('STA1k' => "1kg Satchel",
            'STA3k' => "3kg Satchel",
            'STA5k' => "5kg Satchel",
            'STAexp' => "Road Express",
            'STAexpi' => "Road Express Insured",
            'STAprm' => "Air Express",
            'STAprmi' => "Air Express Insured"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'sta_account' => array(
        'title' => __('StarTrack Account', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('Account', 'woocommerce-ozpost')
    ),
    'sta_username' => array(
        'title' => __('StarTrack UserName', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('UserName.  hint: Try \'Demo\'', 'woocommerce-ozpost')
    ),
    'sta_password' => array(
        'title' => __('StarTrack Password', 'woocommerce-ozpost'),
        'type' => 'password', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
    //      'placeholder' => __('Password', 'woocommerce-ozpost')
    ),
    'sta_key' => array(
        'title' => __('StarTrack Key', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('', 'woocommerce-ozpost')
    ),
    'sta_handling' => array(
        'title' => __('Handling Fee StarTrack', 'woocommerce-ozpost'),
        'type' => 'price', 'css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    
    'tnt_methods' => array(
        'title' => __('TNT Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect', 'description' => __('You need a valid TNT account. You *must* also contact them to activate the \'RTT\' service for the account. Sign up at: https://www.tntexpress.com.au/', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('TNT76' => "Road Express",
            'TNT75' => "Overnight Express by 5pm",
            'TNTEX12' => "Overnight Express by Midday",
            'TNTEX10' => "Overnight Express by 10:00am",
            'TNT712' => "Overnight Express by 9:00am",
            'TNT717B' => "Technology Express - Sensitive Express",
            'TNT73' => "ONFC Satchel"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'tnt_account' => array(
        'title' => __('TNT Account', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('12345678', 'woocommerce-ozpost')
    ),
    'tnt_login' => array(
        'title' => __('TNT Login', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('Existing TNT customers may need to use thier email address here. New customers should use thier CITiD.  hint: Try \'Demo\'', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('CIT00000000000000000', 'woocommerce-ozpost')
    ),
    'tnt_password' => array(
        'title' => __('TNT Password', 'woocommerce-ozpost'),
        'type' => 'password', 'css' => 'width: 170px;',
        'description' => __('', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
    //    'placeholder' => __('********', 'woocommerce-ozpost')
    ),
    'tnt_handling' => array(
        'title' => __('Handling Fee TNT', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    'trd_methods' => array(
        'title' => __('Transdirect Methods', 'woocommerce-ozpost'),
        'type' => 'multiselect', 'description' => __('Account not needed for quotes', 'woocommerce-ozpost'), 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'css' => 'width: 450px;',
        'default' => '',
        'options' => array('TRDae' => "Allied Express",
            'TRDaei' => "Allied Express Insured",
            'TRDcp' => "Couriers Please",
            'TRDcpi' => "Couriers Please Insured",
            'TRDfw' => "Fastway",
            'TRDfwi' => "Fastway Insured",
            'TRDti' => "Toll/Ipec",
            'TRDtii' => "Toll/Ipec Insured",
            'TRDtp' => "Toll Priority Overnight",
            'TRDtpi' => "Toll Priority Overnight Insured",
            'TRDts' => "Toll Priority Same Day",
            'TRDtsi' => "Toll Priority Same Day Insured",
            'TRDnl' => "Northline",
            'TRDnli' => "Northline Insured",
            'TRDmf' => "Mainfreight",
            'TRDmfi' => "Mainfreight Insured",
            'TRDtntr' => "TNT Road",
            'TRDtntri' => "TNT Road Insured",
            'TRDtnt5' => "TNT Overnight Express by 5pm",
            'TRDtnt5i' => "TNT Overnight Express by 5pm Insured",
            'TRDtnt9' => "TNT Overnight Express by 9am",
            'TRDtnt9i' => "TNT Overnight Express by 9am Insured",
            'TRDtnt10' => "TNT Overnight Express by 10am",
            'TRDtnt10i' => "TNT Overnight Express by 10am Insured",
            'TRDtnt12' => "TNT Overnight Express by 12pm",
            'TRDtnt12i' => "TNT Overnight Express by 12pm Insured"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select Methods', 'woocommerce-ozpost')
        )),
    'trd_username' => array(
        'title' => __('TransDirect Username', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('Transdirect username (optional - account holders get better rates)', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('UserName', 'woocommerce-ozpost')
    ),
    'trd_password' => array(
        'title' => __('Transdirect Password', 'woocommerce-ozpost'),
        'type' => 'password', 'css' => 'width: 170px;',
        'description' => __('Password required if username is set.', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
    //  'placeholder' => __('********', 'woocommerce-ozpost')
    ),
    'trd_member' => array(
        'title' => __('Transdirect Member', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 170px;',
        'description' => __('Currently unused', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => true,
        'placeholder' => __('Member', 'woocommerce-ozpost')
    ),
    'trd_handling' => array(
        'title' => __('Handling Fee TransDirect', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),

    'ri_handling' => array(
        'title' => __('Handling Fee Registered or Insured items (This is in ADDITION to other handling fees.)', 'woocommerce-ozpost'),
        'type' => 'price','css' => 'width: 50px;color: blue;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '5.00'
    ),
    
    'hp_surcharge' => array(
        'title' => __('Surchrage for Heavy Parcels (pallet fee).)', 'woocommerce-ozpost'),
        'type' => 'price',  'css' => 'width: 50px;color: green;',
        'placeholder' => wc_format_localized_price(0),
        'default' => '20.00'
    ),
    
   'hp_weight' => array(
        'title' => __('How heavy is a \'heavy\' parcel (kg)', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 50px; ',
        'placeholder' => '35',
        'default' => '35'
    ),
    
        'cost_on_error_method' => array(
        'title' => __('Action on Error', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 240px;',
        'description' => __('Action to be taken if no \'live\' quotes are available for some reason. eg: server offline, network glitches, no suitable methods avialable, etc.', 'woocommerce-ozpost'), 'desc_tip' => false,
        'class' => 'wc-enhanced-select',
        'default' => 'TBA',
        'options' => array(
            'DIS' => __('Do nothing', 'woocommerce-ozpost'),
            'TBA' => __('Display TBA Message', 'woocommerce-ozpost'),
            'CPP' => __('Quote based on Cost Per Parcel', 'woocommerce-ozpost'),
            'CPI' => __('Quote based on Cost Per Item', 'woocommerce-ozpost'),
            'CPK' => __('Quote based on Cost Per Kg', 'woocommerce-ozpost'),
            'TBL' => __('Use Table Rates', 'woocommerce-ozpost')
        ),
    ),
    
    'static_rates' => array(
        'title' => __('Static Rates', 'woocommerce-ozpost'),
        'type' => 'input',  'css' => 'width: 100px;color: blue;',
        'description' => __('Two comma separated values. The 1st is the cost for Australian Deliveries, the 2nd for Overseas. Used in conjuction with the \'Action on Error\'. These amounts will be used in conjuction with the \'Quote based on....\' settings above.', 'woocommerce-ozpost'),
        'default' => '15.00, 30.00',
        'desc_tip' => false,
        'placeholder' => __('Example: 15.00, 30.00', 'woocommerce-ozpost')
    ),

    
    'table_rates' => array(
        'title' => __('Table Rates ', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 800px;;color: blue;',
        'description' => __('These table rates are used if \'Action on Error\' = "Use Table Rates". '
                . 'They are only shown when no other methods are available, eg: server offline, network glitches, etc.  '
                . 'Two SPACE separated SETS. The 1st SET is the cost for Australia, the 2nd SET is for overseas. Each SET consists of a number of comma separated pairs. '
                . 'Each pair consists of \'value:price\' where \'value\' equals a weight, price or item count to be compared with (from the cart contents). If the \'value\' is less than '
                . 'less than cart content amount the \'price\' is used. If the content amount is greater, then the next \'value:price\' pair is checked. '
                . 'This process repeats until a price is set or the end of the SET is reached.'
                . ' In the example given, using \'Weight\' for Austrlaian delivery, <500gm = $6.35, 500gm-3kg = $7.50 , 3.001kg-5kg = $9.90, 5.001kg-10kg = $10.50, 10.001kg-15kg+ = $15.00  '
                . '', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('Example: 0.5:6.35,3:7.50,5:9.90,10:10.50,15:15.00 <space> 0.5:20.00,3:25.00,5:30.00,10:40.00,15:50.00', 'woocommerce-ozpost')
    ),
    'table_type' => array(
        'title' => __('Table Rate Method', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 140px;',
        'description' => __('The table rates can be based on Price, Weight or per Item. Your choice.', 'woocommerce-ozpost'), // 'desc_tip' => true,
        'class' => 'wc-enhanced-select',
        'default' => 'WGT',
        'options' => array(
            'PRC' => __('Price', 'woocommerce-ozpost'),
            'WGT' => __('Weight', 'woocommerce-ozpost'),
            'ITM' => __('Item', 'woocommerce-ozpost')
        ),
    ),
    'tba_text' => array(
        'title' => __('To Be Advised Message', 'woocommerce-ozpost'),
        'type' => 'input',
        'description' => __('Displayed to customer if no shipping methods are available and \'Action on Error\' is set to TBA.', 'woocommerce-ozpost'),
        'default' => 'Please contact us for shipping costs.',
        'desc_tip' => false,
        'placeholder' => __('Please contact us for shipping costs.', 'woocommerce-ozpost')
    ),
    'default_weight' => array(
        'title' => __('Default Weight', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 100px;',
        'description' => __('Used if individual products don\'t have their own weight assigned (in grams)', 'woocommerce-ozpost'),
        'default' => '',
        'desc_tip' => false,
        'placeholder' => __('Ex: 250 ', 'woocommerce-ozpost')
    ),
    'default_dimensions' => array(
        'title' => __('Default Dimensions', 'woocommerce-ozpost'),
        'type' => 'input',
        'description' => __('These dimensions are used for products with no dimensions defined (format: L,W,H measured in mm)', 'woocommerce-ozpost'),
        'default' => '', 'css' => 'width: 120px;',
        'desc_tip' => false,
        'placeholder' => __('Ex: 20,30,40', 'woocommerce-ozpost')
    ),
    'tare_weight' => array(
        'title' => __('Tare Weight', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 120px;',
        'description' => __('All packaging has a weight. 10% works well in most cases (format: xx% or +gm) ', 'woocommerce-ozpost'),
        'default' => '10%',
        'desc_tip' => false,
        'placeholder' => __('Ex: 10% or +500 ', 'woocommerce-ozpost')
    ),
    'tare_dimensions' => array(
        'title' => __('Tare Dimensions', 'woocommerce-ozpost'),
        'type' => 'input', 'css' => 'width: 100px;',
        'description' => __('These dimensions are added to the total parcel size (format: L,W,H measured in mm)', 'woocommerce-ozpost'),
        'default' => '2,2,2',
        'desc_tip' => false,
        'placeholder' => __('Ex: 2,2,2', 'woocommerce-ozpost')
    ),
    'restrain_dimensions' => array(
        'title' => __('Restrain dimensions', 'woocommerce-ozpost'),
        'type' => 'checkbox',
        'description' => __('Selecting this will limit the parcel dimensions to the maximum allowable by Australia Post. Quotes will effectively be based on weight alone. ENABLE WITH CAUTION as you may end up quoting for parcel too large to mail.'),
        'default' => 'no',
    ),
    'mail_days' => array(
        'title' => __('What days do you mail?', 'woocommerce-ozpost'),
        'type' => 'multiselect',
        'class' => 'wc-enhanced-select',
        'default' => array('MON', 'WED', 'FRI'),
        'options' => array(
            'MON' => "MON",
            'TUE' => "TUE",
            'WED' => "WED",
            'THU' => "THU",
            'FRI' => "FRI",
            'SAT' => "SAT",
            'SUN' => "SUN"
        ),
        'custom_attributes' => array(
            'data-placeholder' => __('Select the Days you do mailings', 'woocommerce-ozpost')
        )),
    'lead_time' => array(
        'title' => __('Lead time', 'woocommerce-ozpost'),
        'type' => 'text', 'css' => 'width: 45px;',
        'description' => __('Set this is you need time to order products in, or need to manufacture before you can post. If your products are in stock this is best left at zero. You should probably be using the \'mail days\' for your postage delay instead.', 'woocommerce-ozpost'),
        'default' => '0',
    ),
    'deadline' => array(
        'title' => __('Deadline for same day postage', 'woocommerce-ozpost'),
        'type' => 'text', 'css' => 'width: 45px;',
        'description' => 'Hour 1 - 24. Uses the store localtime', 'woocommerce-ozpost',
        'default' => '10',
    ),
    'tax_status' => array('title' => __('Inlcude GST?', 'woocommerce-ozpost'),
        'type' => 'checkbox', 
        'label' => 'If unticked the GST must be added elsewhere otherwise you will be under-quoting',
        'default' => 'yes',
    ),
    'show_handling_fee' => array(
        'title' => __('Show Handling Fees', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => ' tick to show handling fees along with the quotes.', 
        'description' => 'For display purposes only. These are always included in the quote price','desc_tip' => true,
        'default' => 'yes',
    ),
    
        'show_insurance_cost' => array(
        'title' => __('Show the Insurance cost', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => ' tick to show insurance cost along with the quotes', 
        'description' => 'For display purposes only. These are always included in the quote price','desc_tip' => true,
        'default' => 'yes',
    ),
    
    'show_otherfee' => array(
        'title' => __('Show cost of any other fees', 'woocommerce-ozpost'),
        'type' => 'checkbox', 'label' => ' tick to show any other fees that make up the quotes (eg: Registration and COD charges) ', 
        'description' => 'For display purposes only.These are always included in the quote price','desc_tip' => true,
        'default' => 'yes',
    ),
    
    'estimated_delivery_format' => array(
        'title' => __('Estimated Days Format', 'woocommerce-ozpost'),
        'type' => 'select', 'css' => 'width: 280px;',
        'label' => __('Your Choice.', 'woocommerce-ozpost'), 
        'class' => 'wc-enhanced-select',
        'default' => 'Date',
        'options' => array(
            'Date' => __('Show the estimated Date', 'woocommerce-ozpost'),
            'Days' => __('Show the estimated number of Days', 'woocommerce-ozpost'),
            'None' => __('Show Nothing', 'woocommerce-ozpost')
        ),
    ),
    
    'handling_text_pre' => array(
        'title' => __('Text to be displayed BEFORE the handling fee', 'woocommerce-ozpost'),
        'type' => 'input',        
        'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'), 'desc_tip' => true,
        'default' => '&nbsp;Includes $', 
        'placeholder' => __(' Includes $', 'woocommerce-ozpost')
    ),
    
    'handling_text_post' => array(
        'title' => __('Text to be displayed AFTER the handling fee', 'woocommerce-ozpost'),
        'type' => 'input',
         'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'), 'desc_tip' => true,
        'default' => '&nbsp;Packaging & Handling.',
        'placeholder' => __('&nbsp;Packaging & Handling.', 'woocommerce-ozpost')
    ),
    
      'insurancefee_text_pre' => array(
        'title' => __('Text to be displayed BEFORE the INSURANCE cost', 'woocommerce-ozpost'),
         'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'),
        'type' => 'input',
        'default' => '&nbsp;Includes $', 
        'placeholder' => __('&nbsp;Includes $', 'woocommerce-ozpost'),
            'desc_tip' => true
          ),
    
    'insurancefee_text_post' => array(
        'title' => __('Text to be displayed AFTER the INSURANCE cost', 'woocommerce-ozpost'),
        'type' => 'input',
         'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'), 'desc_tip' => true,
        'default' => '&nbsp;Service Charges.',
        'placeholder' => __(' Insurance charge.', 'woocommerce-ozpost')
    ),
    
       'otherfee_text_pre' => array(
        'title' => __('Text to be displayed BEFORE the OTHER fee cost', 'woocommerce-ozpost'),
         'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'),
        'type' => 'input',
        'default' => '&nbsp;Includes $', 
        'placeholder' => __('&nbsp;Includes $', 'woocommerce-ozpost'),
            'desc_tip' => true
          ),
    
    'otherfee_text_post' => array(
        'title' => __('Text to be displayed AFTER the OTHER fee cost', 'woocommerce-ozpost'),
        'type' => 'input',
         'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'), 'desc_tip' => true,
        'default' => '&nbsp;Service Charges.',
        'placeholder' => __(' Fee.', 'woocommerce-ozpost')
    ),
    
    'estimation_text_date' => array(
        'title' => __('Text to be displayed BEFORE the estimated DATE', 'woocommerce-ozpost'),
        'type' => 'input',        
        'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'), 'desc_tip' => true,
        'default' => 'Est Delivery Date :',
        'placeholder' => __('Est Delivery Date : ', 'woocommerce-ozpost')
    ),
    
    'estimation_text_days' => array(
        'title' => __('Text to be displayed AFTER the estimated delivery DAYS', 'woocommerce-ozpost'),
        'type' => 'input',        
        'description' => __('Hint: To enter a leading or trailing space, enter a html non=breaking space', 'woocommerce-ozpost'), 'desc_tip' => true,
        'default' => '&nbsp;Days Estimated Delivery',
        'placeholder' => __('&nbsp;Days Estimated Delivery', 'woocommerce-ozpost')
    ),
    
    'show_errors' => array(
        'title' => __('Show Error Messages', 'woocommerce-ozpost'),
        'type' => 'checkbox',
        'label' => __('Enabling this will show \'friendly\' error messages, such as oversize parcels, invalid destinations, etc, etc', 'woocommerce-ozpost'),
        'default' => 'yes',
    ),
    'enable_debug' => array(
        'title' => __('Enable DEBUG Output', 'woocommerce-ozpost'),
        'type' => 'checkbox','desc_tip' => true,
        'description' => __('The output may not be pretty, but it will provide some detailed information about what is going on \'behind the scenes\'.', 'woocommerce-ozpost'),
        'default' => 'no',
        'label' => __('If the quotes are not what is expected then enabling this may help provide a clue why.', 'woocommerce-ozpost')
    ),
);  //   End formfields array