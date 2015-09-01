<?php
/*
Plugin Name: ozpost-multiquote 
Plugin URI: http://ozpost.net.au/
Description: Provides real time shipping quotes from Australia Post, TNT, TransDirect, SmartSend, StarTrack, Couriers Please and Others.. 
Author: Rod Gasson
Author URI: http://ozpost.net.au
Version: 1.0.3
Copyright: © 2015 VCSWEB (email : support@ozpost.net.au)
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
if ( ! defined( 'ABSPATH' ) ) {exit;  } // Exit if accessed directly

 // Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    //  Hook into woo 
    add_action( 'woocommerce_shipping_init', 'ozpost_init' ); // intialise me 
    add_filter( 'woocommerce_shipping_methods', 'ozpost' );   // Give it an ID 
    function ozpost( $methods ) {   $methods[] = 'WC_Shipping_Ozpost'; return $methods; } // Send new methods array back to Woo (registered it) 
     // end Hook 
    
 function ozpost_init() {   
     
class WC_Shipping_Ozpost extends WC_Shipping_Method {

public function __construct() {   
    $this->id = 'ozpost';
    $this->version = '1.0.3';
    $this->host = urlencode(preg_replace('/[^A-Za-z0-9\s\s+\.\'\"\-\&]/', '', get_option( 'blogname' )))  ; // Settings->General->Site Title 
    $this->method_title     = __( 'Ozpost', 'woocommerce-ozpost' );
    $this->title            = __( 'Ozpost MultiQuote', 'woocommerce-ozpost') ; 
    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
    $this->init(); 
}  // end construct // 


function init() {         
    $this->form_fields = include( 'formfields.php' ); 

    $options = array(
        'enabled','origin_postcode','origin_suburb','store_postcode','subscriptions_email',
        'letter_methods','letter_handling',
        'hide_parcel_if_domestic_letter', 'hide_parcel_if_international_letter','hide_parcel_if_satchel','hide_courier_if_ap_can_handle',
        'satchel_methods', 
            'pps_handling','ppse_handling','ppsi_handling',
            'ap_discount_1r','ap_discount_2r','ap_discount_3r','ap_discount_1e','ap_discount_2e','ap_discount_3e',   
        'parcel_methods','rpp_handling','exp_handling',
        'clicknsend_methods','cnss_handling','cnsb_handling',
        'overseas_parcel_methods','overseas_handling','eci_documents_handling','eci_merchandise_handling','epi_handling',            
        'fastway_methods','fastway_city','fastway_frequentUser','fastway_labels_handling','fastway_satchels_handling','fastway_boxes_handling','fastway_special_baseweight',
        'tnt_methods','tnt_account','tnt_login','tnt_password','tnt_handling',
        'trd_methods','trd_username','trd_password','trd_member','trd_handling',
        'skp_methods','skp_customerId','skp_handling',
        'cpl_methods','cpl_handling','cpl_satchel_handling','cpl_cust','cpl_account','cpl_ref','cpl_ezy_labels','cpl_metro_labels',
        'ego_methods','ego_handling',
        'sta_methods','sta_account','sta_username','sta_password','sta_key','sta_handling',
        'sms_methods','sms_email','sms_password','sms_customer_type','sms_handling',
        'ri_handling',
        'hp_weight','hp_surcharge',
        'static_rates',
        'cost_on_error_method',
        'table_rates', 'table_type',        
        'default_dimensions', 'default_weight',
        'tare_weight','tare_dimensions',
        'restrain_dimensions',
        'mail_days',
        'lead_time', 'deadline',
        'estimated_delivery_format',
        'show_handling_fee','show_insurance_fee', 'show_insurance_cost','show_otherfee',
        'tba_text','handling_text_pre','handling_text_post','insurancefee_text_pre','insurancefee_text_post','otherfee_text_pre','otherfee_text_post',
        'estimation_text_date','estimation_text_days',
        'tax_status','enable_debug','show_errors','test_servers') ;
    
foreach ( $options as $option ) $this->$option =  $this->get_option($option); 

$this->$option =  $this->get_option($option); 

if ( empty( $this->subscriptions_email ) )  $this->subscriptions_email = get_option('admin_email') ;    // If the subscription email hasn't been set then use the admin email address // 
}

//  FUNCTION admin_options
function admin_options() { 
?> 
<style>
.ozpostHeadings{ color: blue ;   background-color: rgb(160, 216, 245); }  
.ozpostHeadings:hover{ color: black; cursor: crosshair; }    
p.ozpostHeadings { margin: 3px; padding: 1px ;padding-left: 10px ;width: 205px ;}  
.form-table td { margin: 0; padding: 0; }
 th.titledesc { padding: 0px ; padding-top: 8px;} 
</style>
<script type="text/javascript">
<!--
function toggle_visibility(id) {
   var e = document.getElementById(id);
   if(e.style.display === 'block')  e.style.display = 'none';
   else  e.style.display = 'block';
return true;
}
//-->
</script>

<?php      
//$msg = "" ;
 //  Do Subscription expiration check.Disabling this prevents merchant feedback only. It has no effect on the actual subscription status  

$storecode = (isset($this->store_postcode) && ($this->store_postcode !== "")) ? $this->store_postcode:$this->origin_postcode; 
$expires = (isset($_SESSION['ozpostExp'])) ? $_SESSION['ozpostExp']:$this->_get_from_ozpostnet("/postage.php?flags=expires&host=$this->host&fromcode=".$storecode ) ; 
    if(($expires) && ($expires !== " ") && ($expires !== "") && ((substr($expires, 0, 7)) != "<error>"))  {
    $_SESSION['ozpostExp'] = $expires ; 
?><h3><?php     
    $expires = (int)$expires ;  
        if      ($expires > 0)  { _e('<a href="http://shop.vcsweb.com/subscriptions/" target=_blank >Subscription</a> expires in '.$expires. ' days','woocommerce-ozpost'); } 
        elseif  ($expires < 0)  { _e('Subscription expired '. abs($expires) . ' days ago' ,'woocommerce-ozpost'); } 
        else    { _e('Subscription expires TODAY!!' ,'woocommerce-ozpost');  } 
        } else { unset($_SESSION['ozpostExp']) ;}  
?></h3>
    
<?php
 // Do ozpost server tests (if indicated)    
 if((isset($_GET['testservers'])) && ($_GET['testservers'] === "1")) { _e($this->_ozpost_network_test(),'woocommerce-ozpost'); $text = 'Refresh'; 
 ?>
  <!--Do the clear button -->  
<a class="button-primary" href="<?php echo esc_url($_SERVER['REQUEST_URI'] . "&testservers=0"); ?>"><?php _e( 'Clear', 'woocommerce-ozpost' ); ?></a>
<?php } else { $text = 'Test the ozpost servers'; } 
?>
  <!--Do the test/refresh button -->  
<a class="button-primary" href="<?php echo esc_url($_SERVER['REQUEST_URI'] . "&testservers=1" ); ?>"><?php _e( $text, 'woocommerce-ozpost' ); ?></a>
<?php 
$this->_generate_settings_html( $form_fields = array() ); 
 
 } //  ! FUNCTION admin_options
 
/////////////////////////////////////////////////////////////////////////////////////
// FUNCTION calculate_shipping 
public function calculate_shipping( $package = array() ) {
 
 $this->host = urlencode(preg_replace('/[^A-Za-z0-9\s\s+\.\'\"\-\&]/', '', get_option( 'blogname' )))  ; // Settings->General->Site Title   
 $storecode = (isset($this->store_postcode) && ($this->store_postcode !== "")) ? $this->store_postcode:$this->origin_postcode ;   

$fromcode = $this->origin_postcode ; 
$topcode = $package['destination']['postcode'] ;   
$dest_country = ($package['destination']['country']) ? $package['destination']['country']: "AU";
$dcode = ($dest_country == "AU") ? $topcode:$dest_country ;
$flags = 0 ; 
$maildays = $deadline =  $leadtime = $Osub = $Dsub = $fwvars = $tntvars =  $transvars =  $egovars = $stavars = $smsvars = $cplvars = $skpvars = "";

// Australia Post letters  
if (is_array($this->letter_methods)) { 
    foreach ($this->letter_methods as $method) {
       
        switch($method) {         
            case "Aust Standard";
                if ($dest_country === "AU") {
                $allowed_methods[] = "Aust Standard";
                $allowed_methods[] = "SLET";
                $allowed_methods[] = "LL1";
                $allowed_methods[] = "LL2";
                $allowed_methods[] = "LL3";
                }
                break;
            
            case "Aust Standard Insured";
                if ($dest_country === "AU") {
                    $allowed_methods[] = "Aust Standard Insured";
               
                $allowed_methods[] = "SLETi";
                $allowed_methods[] = "LL1i";
                $allowed_methods[] = "LL2i";
                $allowed_methods[] = "LL3i";
                }
                break;

            case 'Aust Priority';
                 if ($dest_country === "AU") {
                 $allowed_methods[] = "Aust Priority";
                $allowed_methods[] = "SLETp";
                $allowed_methods[] = "LL1p";
                $allowed_methods[] = "LL2p";
                $allowed_methods[] = "LL3p";
                 }
                break;
            
             case 'Aust Priority Insured';
                if ($dest_country === "AU") {
                    $allowed_methods[] = "Aust Priority Insured";
                $allowed_methods[] = "SLETpi";
                $allowed_methods[] = "LL1pi";
                $allowed_methods[] = "LL2pi";
                $allowed_methods[] = "LL3pi";}
                break;
            
            case 'Aust Registered';
                 if ($dest_country === "AU") {
                $allowed_methods[] = "Aust Registered";
                 $allowed_methods[] = "REGL"; }
                break;

            case 'Aust Insured';
                 if ($dest_country === "AU") {
                 $allowed_methods[] = "Aust Insured"; 
                 $allowed_methods[] = "REGLi";} 
                break;

            case 'Aust Express';
                 if ($dest_country === "AU") {
                     $allowed_methods[] = "Aust Express";
                $allowed_methods[] = "EXLL";
                 $allowed_methods[] = "EXLS";}
                break;

            case 'Overseas Standard';
                if ($dest_country !== "AU") { $allowed_methods[] = "Overseas Standard";
                $allowed_methods[] = "SLET";
                $allowed_methods[] = "LL1";
                $allowed_methods[] = "LL2";
                $allowed_methods[] = "LL3";}
                break;

            case 'Overseas Registered';
                if ($dest_country !== "AU"){
                    $allowed_methods[] = "Overseas Registered";
                $allowed_methods[] = "REGLS";
        $allowed_methods[] = "REGLL";}
                break;
            
            case 'Overseas Express';
                if ($dest_country !== "AU"){
                    $allowed_methods[] = "Overseas Express";
                $allowed_methods[] = "EXLL";
                $allowed_methods[] = "EXLS";}
             break ;   
                case 'Overseas Express EPI'; 
                 if ($dest_country !== "AU"){
                     $allowed_methods[] = "EPIb4";
                 $allowed_methods[] = "EPIc5";}
                break;
        } // endswitch 
    }  // end letter_methods array 
 }  // No letter methods set //  

 if($dest_country === "AU") { 

    if (is_array($this->satchel_methods))       { foreach ($this->satchel_methods as $method)    { $allowed_methods[] = $method ; }}
    if (is_array($this->parcel_methods))        { foreach ($this->parcel_methods as $method)     { $allowed_methods[] = $method ; }}        
    if (is_array($this->clicknsend_methods))    { foreach ($this->clicknsend_methods as $method) { $allowed_methods[] = $method ; }}       
    if (is_array($this->ego_methods)) { 
        foreach ($this->ego_methods as $method)                  { $allowed_methods[] = $method ; }  
        $egovars = "&ego=1" ;
         } 

    // create the Fastway variables
    if ((is_array($this->fastway_methods)) && ($this->fastway_city != "DIS") && ($this->fastway_city != "")) { 
        foreach ($this->fastway_methods as $method) {  $allowed_methods[] = $method ;  }       
        $fwvars = "&FastWay=" . $this->fastway_city ;    
        if ($this->fastway_frequentUser === "yes") $fwvars .= "f"; // 'f' = frequent user flag/trigger/id
        if ((int)$this->fastway_special_baseweight > 0 ) $fwvars .= "s". $this->fastway_special_baseweight ; // 's' = Special rates
        } 

    // create the TNT variables
    if ((is_array($this->tnt_methods)) && ($this->tnt_account != "")) { 
        foreach ($this->tnt_methods as $method) {  $allowed_methods[] = $method ;  }  
        $tntvars = "&TNTaccount=" . $this->tnt_account. "&TNTusername=" . $this->tnt_login . "&TNTpassword=" .$this->tnt_password;
        }

    // create the Transdirect variables //
    if ((is_array($this->trd_methods))) { 
        foreach ($this->trd_methods as $method) {  $allowed_methods[] = $method ;  }           
        $transvars .= "&TransDirect=1"  ;        
            if(( $this->trd_username))  $tranvars .= "&TRDusername=".$this->trd_username ;
            if(( $this->trd_password )) $tranvars .= "&TRDpassword=".$this->trd_password ;
            if(( $this->trd_member ))   $tranvars .= "&TRDmember=".$this->trd_member ;
        } 

     // create the Couriers Please variables
    if (is_array($this->cpl_methods)) { 
        foreach ($this->cpl_methods as $method) {  $allowed_methods[] = $method ;  }  
            if ((in_array("CPL",  $allowed_methods )) || in_array("CPLi", $allowed_methods)) {
        $cplvars = "&CPLacct=".$this->cpl_account."&CPLcust=".$this->cpl_cust."&CPLref=".$this->cpl_ref ;
             }
            // create the Couriers Please v2 flag -  (no account needed)
            if (in_array("CPL1",  $allowed_methods))    { $cplvars .= "&CPLv2=1" ;} else
            if (in_array("CPL3",  $allowed_methods))    { $cplvars .= "&CPLv2=1" ;} else
            if (in_array("CPL4",  $allowed_methods))    { $cplvars .= "&CPLv2=1" ;} else
            if (in_array("CPLlab",  $allowed_methods))  { $cplvars .= "&CPLv2=1" ;}    
        }  

    // create the StarTrack variables
    if ((is_array($this->sta_methods)) && ($this->sta_username != "")) { 
        foreach ($this->sta_methods as $method) {  $allowed_methods[] = $method ;  }  
        $stavars .= "&STAaccount=".$this->sta_account."&STAusername=".$this->sta_username."&STApassword=".$this->sta_password."&STAkey=".$this->sta_key ;
            }    

    // create the SmartSend variables      
    if ((is_array($this->sms_methods)) && ($this->sms_email != "")) { 
        foreach ($this->sms_methods as $method) {  $allowed_methods[] = $method ;  }  
        $smsvars .= "&SMSemail=".$this->sms_email."&SMStype=".$this->sms_customer_type."&SMSpassword=".$this->sms_password ;
            } 
}  
    else {  //  Not Australia 
 if($dest_country) { // do we even have a country? 
    if (is_array($this->overseas_parcel_methods)) { 
        foreach ($this->overseas_parcel_methods as $method) {  $allowed_methods[] = $method ;  } 
    }      
    // create the Skippy Post variables //    
    if (is_array($this->skp_methods)) { //  && ($this->skp_customerId != "")) { 
        foreach ($this->skp_methods as $method) {  $allowed_methods[] = $method ;  }  
        $skpvars .= "&skp=1"  ;       
         if ($this->skp_customerId != "")   $skpvars .= "&SKPcust=".$this->skp_customerId ; 
        }
    }  
}

if (sizeof($allowed_methods) == 0 ) { wc_add_notice( __( 'Error: Ozpost shipping is active but no methods have been enabled', 'woocommerce-ozpost' ), 'error' ) ; return ; }

if($this->show_errors === "yes") $allowed_methods[] = "Error" ;

    if ($this->enable_debug === "yes" ) { echo "<pre>Allowed Methods";print_r($allowed_methods) ; echo "</pre>"; }
    if ($this->hide_parcel_if_satchel == "yes" )  $flags = $flags | 2  ; 
    if ($this->hide_courier_if_ap_can_handle == "yes" )  $flags = $flags | 4  ;
    if ($this->hide_parcel_if_domestic_letter == "yes")  $flags = $flags | 8  ;  //  hide all parcels if letter rates and domestic (supercedes flags=1)
    if ($this->hide_parcel_if_international_letter  == "yes")  $flags = $flags | 16  ; //  hide all parcels if letter rates and overseas (supercedes flags=1)
 
    $mail = 0 ;  //  Days we mail on. (bitmapped)
        if (is_array($this->mail_days)) {
        if(in_array( "MON", $this->mail_days)) $mail = $mail | 1  ;
        if(in_array( "TUE", $this->mail_days)) $mail = $mail | 2  ;
        if(in_array( "WED", $this->mail_days)) $mail = $mail | 4  ;
        if(in_array( "THU", $this->mail_days)) $mail = $mail | 8  ;
        if(in_array( "FRI", $this->mail_days)) $mail = $mail | 16 ;
        if(in_array( "SAT", $this->mail_days)) $mail = $mail | 32 ;
        if(in_array( "SUN", $this->mail_days)) $mail = $mail | 64 ;
    $maildays = "&maildays=".$mail  ;
      }
  
    $ef =  ($this->estimated_delivery_format == "Date") ? "&ef=1": "&ef=0";

    if ($this->deadline > 0)   $deadline = "&deadline=" . $this->deadline; // deadline for same day mailings
    if ($this->lead_time > 0)  $leadtime = "&leadtime=" .$this->lead_time;  // leadtime for delayed mailings

    $vars = $cplvars.$smsvars.$stavars.$fwvars.$tntvars.$egovars.$transvars.$skpvars;

    $AllSat = "&AllSat=1"; // if satchels are filtered here return all, else server only returns most suited.

// Get and use Suburb names if available - (mainly for couriers due to the way their zones are organised)
    if (($this->origin_suburb != "") && ($this->origin_suburb != "Enter the NAME of the suburb you ship from")) $Osub = "&Osub=" . urlencode($this->origin_suburb);
    if ((isset($package['destination']['address_2'])) && (($package['destination']['address_2']) !="" )) $Dsub = "&Dsub=" . urlencode($package['destination']['address_2']);
 
    if ($Dsub == "")  {
        if ((isset($package['destination']['city'])) && (($package['destination']['city']) != "")) {
        $Dsub = "&Dsub=".urlencode($package['destination']['city']) ;     
        }
    }
////////////////// *************************************************************** /////////////////////////////////////
global $packageitems, $parcelweight, $value ,$wpdb; 
// default dimensions //
$defaultDimensions = array(1,1,1) ; if ($this->default_dimensions) $defaultDimensions = explode(',',$this->default_dimensions) ;

$index = $dg =  0 ;
$items = array() ;
 //  get Aust Tax rate 
$taxQuery = $wpdb->get_results( "SELECT tax_rate FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_country = 'AU' " );
$taxrate = $taxQuery[0]->tax_rate  ;
if ($taxrate <= 0 ) $taxrate = 1 ;  // prevent possible division by zero errors /
 
$dimensionUnit = get_option( 'woocommerce_dimension_unit' ) ;
$weightUnit = get_option( 'woocommerce_weight_unit' ) ;

  // loop through cart extracting contents //
foreach ( $package['contents'] as $item => $values ) {
    if ( $values['quantity'] > 0 && $values['data']->needs_shipping() ) {  $item = $item ;           
        
        $product = wc_get_product($values['product_id']) ;  // Get th product  
        $variants = ( isset($values['data']->variation_id )) ?  get_post_meta($values['data']->parent->id):false; // and variants
  
             $product->weight = ($values['data']->weight) ? $values['data']->weight:$variants['_'.weight][0] ;
             $product->length = ($values['data']->length) ? $values['data']->length:$variants['_'.length][0] ;
             $product->width =  ($values['data']->width)  ? $values['data']->width :$variants['_'.width][0]  ;
             $product->height = ($values['data']->height) ? $values['data']->height:$variants['_'.height][0] ;
             $product->price =  ($values['data']->price)  ? $values['data']->price:$variants['_'.price][0] ;
             
        $weight = $product->weight ; if ($weight == 0) $weight = $this->default_weight ;

        switch ($weightUnit) { // convert to gms
            case  "kg"; case  "Kilogram"; $weight = $weight * 1000  ; break ;
            case  "oz"; case  "Ounce";    $weight = $weight * 29.6  ; break ;
            case  "lb"; case  "Pound";    $weight = $weight * 453.6 ; break ;
        }

    if ($weight > 0 )   {        
        $dg = ($product->get_attribute( 'DG' ) == "1") ? 1:$dg ;
        if(($this->enable_debug === "yes" ) && ($product->get_attribute( 'DG' ) == 1))  echo "<br>Dangerous Goods ID:" . $product->id ."<br>";      

        if ((float)$product->length == 0) $product->length = $defaultDimensions[0] ;
        if ((float)$product->width  == 0) $product->width  = $defaultDimensions[1] ;
        if ((float)$product->height == 0) $product->height = $defaultDimensions[2] ;

        switch ($dimensionUnit) { // convert to mm
            case "cm"; case "Centimeter"; (int)$product->height = $product->height * 10.0 ; (int)$product->width = $product->width * 10.0 ; $product->length = $product->length * 10.0 ; break ;
            case "in"; case "Inch";       (int)$product->height = $product->height * 25.4 ; (int)$product->width = $product->width * 25.4 ; (int)$product->length = $product->length * 25.4 ; break ;
    }
    
    $price =  (( wc_tax_enabled() === false) || (get_option( 'woocommerce_prices_include_tax' ) === 'yes' ))  ?  $product->price : (($product->price ) + (($product->price ) / $taxrate) ) ;     
    $items[] = array('Length' => $product->length, 'Width' => $product->width , 'Height' => $product->height,  'Weight' => $weight,  'Qty' => $values['quantity'],  'Insurance' =>  $price) ;               
  
 // Save these in case of error - We use them to calculate static rates // 
   $parcelweight += $weight * $values['quantity']; $packageitems += $values['quantity'] ;$value += $price;
   
   $index++ ;
   }  // No weight = No shipping // 
  }  //   Didn't need shipping //
}  // next item
 
  if($dg == 1) { $vars .= "&dg=1" ;    
  wc_add_notice( __( 'Note: This order contains dangerous goods. Airmail is unavailable.', 'woocommerce-ozpost' ), 'notice' ) ;}

 
 $control_data = "&tare_weight=$this->tare_weight&restrain_dimensions=$this->restrain_dimensions&tare_dimensions=$this->tare_dimensions&enable_debug=$this->enable_debug"  ;   
 $control_data .= "&fromcode=$fromcode$Osub&destcode=$dcode$Dsub&flags=$flags&host=$this->host&storecode=$storecode&version=$this->version$vars$ef$deadline$maildays$leadtime$AllSat" ;

 $query = "/postage.php?host=$this->host"."_"."$storecode";
 $result = $this->_get_from_ozpostnet($query, $items, $control_data ) ;
 
 if(((substr($result, 0, 7)) != "<error>") && ($result)) {         
    // Parse the .xml results into an array //
$xmlQuotes = new SimpleXMLElement($result) ;
   
            $sub =  urldecode((string)($xmlQuotes->information[0]->fromsuburb)) ;
            if ( $this->origin_suburb != $sub )   $this->_updateSuburb($sub) ; 
            
 //   Expiration Email management \\
            if (isset($this->settings['email_count'])) { 
            $t = $this->settings['email_count'] ; 
            }  else { $t = 0 ;  $this->_update_email_counter($t) ; }
        //    if($t == "") { } // if not initialised                
                $to = ($this->subscriptions_email) ?  $this->subscriptions_email:get_option('admin_email');
                $headers = "Content-Type: text/html\r\n";
  
         $days = intval($xmlQuotes->information[0]->expires);
         $message = "Please be advised that your subscription to ozpost.net will expire in " . $days . " Days.<br>Subscriptions can be renewed at <a href=\"http://shop.vcsweb.com/subscriptions\">shop.vcsweb.com/subscriptions</a>" ;

        if (($days <= 14) && ($days > 0) && ( $t == 0)) { wc_mail( $to, "Subscription Reminder", $message, $headers) ;  $this->_update_email_counter(1) ; }
        if (($days <= 10) && ($days > 0) && ( $t < 2))  { wc_mail( $to, "Subscription Second Reminder", $message, $headers) ;       $this->_update_email_counter(2) ; }
        if (($days <=  7) && ($days > 0) && ( $t < 3))  { wc_mail( $to, "Important Notice", $message, $headers) ;       $this->_update_email_counter(3) ; }
        if (($days <=  3) && ($days > 0) && ( $t < 4))  { wc_mail( $to, "Warning", $message, $headers) ;                $this->_update_email_counter(4) ; }
        if (($days <=  0) && ($t    < 5) && ($t != 0))  { 
            $message = "Your subscription to ozpost.net HAS EXPIRED..<br>Subscriptions can be renewed at <a href=\"http://shop.vcsweb.com/subscriptions\">shop.vcsweb.com/subscriptions</a>";
                                                          wc_mail( $to, "ALERT", $message, $headers) ;                  $this->_update_email_counter(5) ; }
        if (($days > 14) && ( $t != 0))                 {                                                               $this->_update_email_counter(0) ; }// Reset flag for next time
 //   !Expiration Email management \\

  if ($this->enable_debug === "yes" ) { echo "<strong>Server Returned:<br></strong><textarea rows=20 cols=140>" ; print_r($xmlQuotes) ; echo "</textarea></div>" ; }        
/////////////
// ToDo = update this to use 24 bits instead of 3x8 
$displayed = 0 ; // flags to prevent superflious Satchels/Boxes being presented
//bitmapped:  1 = reg sat,  2 = exp sat, 4 = plat sat, 8 = ECP prepaidm, 16 = EPI prepaid,
//              32 = FastWay satchels,  64 = prepaidSatch+reg , 128 CNS Prepaid
$displayed2 = 0 ; // (flags continued. 8 bits weren't enough)
//            1 Platinum Satchels insured , 2 Parcel Post+ insured,
//            4 StarTrack Red Satchels, 8 StarTrack White Satchels, 16 StarTrack Blue Satchels,
//            32 Couriers Please Satchels, 64 Express Post International Prepaid envelopes, 128 SmartSend AAE prepaid satch.

$displayed3 = 0 ; // (flags continued. 16 bits weren't enough)
 //              1 SmartSend AAE prepaid satch reciepted.
 //              2 SmartSend AAE prepaid satch insured.
 //              4 SmartSend AAE prepaid satch receipted + insured.
 //              8 Fastway Boxes
 //              16 Click n Send express satchels

//  loop through the quotes retrieved to get handling fees and filter according to the flags above  
 $valid = 0 ;

  foreach($xmlQuotes->quote as $quote) {       // Quotes returned
      
        if (in_array($quote->id, $allowed_methods)) {  // Continue if an allowed method 
$handlingFee = NULL  ; // nullify handling fee - We test to ensure its set for a valid quote (unset means the result was filtered) 

        switch ($quote->id) {    //  Set the handling fee and/or make custom cost adjustments. Also provides filtering // 
                            case "Error"; $quote->cost = 999 ; break;

                            case "SLET";case "LL1";case "LL2";case "LL3";
                                if (((in_array("Aust Standard", $allowed_methods)) && $dest_country == "AU") || ((in_array("Overseas Standard", $allowed_methods)) && $dest_country != "AU")) {
                                    $handlingFee = $this->letter_handling;
                               }
                                break;

                            case "SLETp"; case "LL1p";case "LL2p"; case "LL3p";
                                if ((in_array("Aust Priority", $allowed_methods)) && $dest_country == "AU") {
                                    $handlingFee = $this->letter_handling;
                                }
                                break;

                            case "REGL";case "REGLS"; case "REGLL";
                                if (((in_array("Aust Registered", $allowed_methods)) && $dest_country == "AU") || ((in_array("Overseas Registered", $allowed_methods)) && $dest_country != "AU")) {
                                    $handlingFee = $this->letter_handling + $this->ri_handling;
                                }
                                break;

                            case "SLETi";case "LL1i";case "LL2i";case "LL3i";
                                if (((in_array("Aust Insured", $allowed_methods)) && $dest_country == "AU") || ((in_array("Overseas Insured", $allowed_methods)) && $dest_country != "AU")) {
                                    $handlingFee = $this->letter_handling + $this->ri_handling;
                               }
                                break;

                            case "EXLS"; case "EXLL";
                                if (((in_array("Aust Express", $allowed_methods)) && $dest_country == "AU") || ((in_array("Overseas Express", $allowed_methods)) && $dest_country != "AU")) {
                                    $handlingFee = $this->letter_handling + $this->exp_handling;
                               }
                                break;

                            case "EPIb4";case "EPIc5";
                                if (!($displayed2 & 64)) {   //  only one per group
                                    $handlingFee = $this->letter_handling + $this->exp_handling;
                                    $displayed2 = $displayed2 | 64;
                                }
                                break;

////////  satchels ////
                            case "PPS5";
                                if (!($displayed & 1)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_1r) / 100;
                                    $handlingFee = $this->pps_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 1;
                                }
                                break;
                            case "PPS5r";case "PPS5i";
                                if (!($displayed & 1)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_1r) / 100;
                                    $handlingFee = $this->ppsi_handling ;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 1;
                                }
                                break;
                            case "PPS3";
                                if (!($displayed & 1)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_2r) / 100;
                                    $handlingFee = $this->pps_handling;

                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 1;
                                } break;
                            case "PPS3r";case "PPS3i";
                                if (!($displayed & 1)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_2r) / 100;
                                    $handlingFee = $this->ppsi_handling ;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 1;
                                } break;
                            case "PPS5K";
                                if (!($displayed & 1)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_3r) / 100;
                                    $handlingFee = $this->pps_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 1;
                                }
                                break;
                            case "PPS5Kr";case "PPS5Ki";
                                if (!($displayed & 1)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_3r) / 100;
                                    $handlingFee = $this->ppsi_handling ;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 1;
                                } break;

/////////////////// Express satchels /////////////////////////////////////
                            case "PPSE5";
                                if (!($displayed & 2)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_1e) / 100;
                                    $handlingFee = $this->ppse_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 2;
                                }
                                break;

                            case "PPSE3";
                                if (!($displayed & 2)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_2e) / 100;
                                    $handlingFee = $this->ppse_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 2;
                                }
                                break;

                            case "PPSE5K";
                                if (!($displayed & 2)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_2e) / 100;
                                    $handlingFee = $this->ppse_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 2;
                                }

////////////////////// platinum satchels (express + sig) /////////////////
                            case "PPSP5";
                                if (!($displayed & 4)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_1e) / 100;
                                    $handlingFee = $this->ppse_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 4;
                                }
                                break;

                            case "PPSP5i";
                                if (!($displayed & 4)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_1e) / 100;
                                    $handlingFee = $this->ppsi_handling ;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 4;
                                }
                                break;
                                
                            case "PPSP3";
                                if (!($displayed & 4)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_2e) / 100;
                                    $handlingFee = $this->ppse_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 4;
                                }
                                break;
                                
                            case "PPSP3i";
                                if (!($displayed & 4)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_2e) / 100;
                                    $handlingFee = $this->ppsi_handling ;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 4;
                                }
                                break;
                                
                            case "PPSP5K";
                                if (!($displayed & 4)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_3e) / 100;
                                    $handlingFee = $this->ppse_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 4;
                                }
                                break;
                                case "PPSP5Ki";
                                if (!($displayed & 4)) {   //  only one per group
                                    $d = (float) ($this->ap_discount_3e) / 100;
                                    $handlingFee = $this->ppsi_handling;
                                    (float) $quote->cost = (float) $quote->cost - ((float) $quote->cost * $d );
                                    $displayed = $displayed | 4;
                                }
                                break;
/////////////////////////////
                            case "REG"; $handlingFee = $this->rpp_handling + $this->ri_handling; break;
                            case "RPP"; $handlingFee = $this->rpp_handling; break;
                            case "RPPi";$handlingFee = $this->rpp_handling + $this->ri_handling; break;
                            case "EPI"; $handlingFee = $this->overseas_handling + $this->exp_handling; break;
                            case "EXP"; $handlingFee = $this->rpp_handling + $this->exp_handling; break;
                            case "EPIi"; $handlingFee = $this->overseas_handling + $this->exp_handling + $this->ri_handling;break;
                            case "PLT"; $handlingFee = $this->rpp_handling + $this->exp_handling + $this->ri_handling;break;
                            case "PLTi";$handlingFee = $this->rpp_handling + $this->exp_handling + $this->ri_handling; break;
                            case "COD"; $handlingFee = COD_HANDLING + $this->ri_handling;break;
                            case "AIR"; case "SEA";$handlingFee = $this->overseas_handling; break;
                            case "AIRi"; case "SEAi"; $handlingFee = $this->overseas_handling + $this->ri_handling;break;
                            case "AIRr"; $handlingFee = $this->overseas_handling + $this->ri_handling; break; //  RPI postpaid
                            
                            case "RPIPP5";case "RPIPP1";    // RPI prepaid
                                if (!($displayed2 & 2)) {   //  only one per group
                                    $handlingFee = $this->overseas_handling + $this->ri_handling;
                                    $displayed2 = $displayed2 | 2;
                                }
                                break;

                            case "PAT"; case "PATPPS"; $handlingFee = $this->overseas_handling + $this->ri_handling; break;

                            case "ECIm";case "ECIP":    $handlingFee = $this->eci_merchandise_handling; break;
                            case "ECId":                $handlingFee = $this->eci_documents_handling; break;
                            case "ECImi";case "ECIPi";  $handlingFee = $this->eci_merchandise_handling + $this->ri_handling; break;
                            case "ECIdi";               $handlingFee = $this->eci_documents_handling + $this->ri_handling;break;

                            case "ECIP500g";case "ECIP1";case "ECIP2"; case "ECIP3";case "ECIP5k";case "ECIP10";case "ECIP20";
                                if (!($displayed & 8)) {   //  only one per group
                                    $handlingFee = $this->eci_merchandise_handling;
                                    $displayed = $displayed | 8;
                                }
                                break;

//////////////////////////////////////
///  EPI prepaid - only one per group
                            case "EPIP2";case "EPIP3";case "EPIP5";case "EPIP10";case "EPIP20";
                                if (!($displayed & 16)) {   //  only one per group
                                    $handlingFee = $this->epi_handling;
                                    $displayed = $displayed | 16;
                                }
                                break;

                            case "TNT712"; // 9am Express
                            case "TNTEX10"; // 10:00 am
                            case "TNTEX12"; // 12:00 pm
                            case "TNT75";
                            case "TNT76"; // Road Express //
                            case "TNT717B"; //Technology Express - Sensitive Express"//
                            case "TNT73"; $handlingFee = $this->tnt_handling; break;

///  Smart Send 
                            case "SMSCPR";case "SMSTNT9"; case "SMSTNT12"; case "SMSTNT5";
                            case "SMSTNTR";case "SMSFW"; case "SMSFWL"; case "SMSFWS"; case "SMSAAEP";case "SMSAAES"; case "SMSAAER": case "SMSCPRr";
                            case "SMSTNT9r";case "SMSTNT12r": case "SMSTNT5r"; case "SMSTNTRr";case "SMSFWr";case "SMSFWLr"; case "SMSFWSr";case "SMSAAEPr";
                            case "SMSAAESr";case "SMSAAERr"; case "SMSCPRi"; case "SMSTNT9i"; case "SMSTNT12i"; case "SMSTNT5i"; case "SMSTNTRi"; case "SMSFWi";
                            case "SMSFWLi"; case "SMSFWSi"; case "SMSAAEPi"; case "SMSAAESi"; case "SMSAAERi"; case "SMSCPRri"; case "SMSTNT9ri"; case "SMSTNT12ri";
                            case "SMSTNT5ri"; case "SMSTNTRri"; case "SMSFWri"; case "SMSFWLri"; case "SMSFWSri"; case "SMSAAEPri"; case "SMSAAESri"; case "SMSAAERri";
                                $handlingFee =  $this->sms_handling; break;

            //   SmartSend Receipted Delivery ///
                            case "SMSAAE1Kr"; case "SMSAAE3Kr"; case "SMSAAE5Kr";
                                if (!($displayed3 & 1)) {
                                    $handlingFee = $this->sms_handling;
                                    $displayed3 = $displayed3 | 1;
                                }
                                break;

            //  Smart Send  AAE Satchels
                            case "SMSAAE1K"; case "SMSAAE3K"; case "SMSAAE5K";
                                if (!($displayed2 & 128)) {
                                    $handlingFee =  $this->sms_handling;
                                    $displayed2 = $displayed2 | 128;
                                }
                            break;
                            
            //  Smart Send AAE insured Satchels
                            case "SMSAAE1Ki"; case "SMSAAE3Ki"; case "SMSAAE5Ki";
                                if (!($displayed3 & 2)) {
                                    $handlingFee = $this->sms_handling;
                                    $displayed3 = $displayed3 | 2;
                                }
                                break;

            //  Smart Send AAE Receipted & inssured Satchels
                            case "SMSAAE1Kri";case "SMSAAE3Kri";case "SMSAAE5Kri";
                                if (!($displayed3 & 4)) {
                                    $handlingFee = $this->sms_handling;
                                    $displayed3 = $displayed3 | 4;
                                }
                                break;

/////////////////////////////////// Fastway 
                            case "FWL_RED"; case "FWL_ORANGE"; case "FWL_GREEN"; case "FWL_WHITE"; case "FWL_GREY";
                            case "FWL_BROWN"; case "FWL_BLACK"; case "FWL_BLUE"; case "FWL_YELLOW"; case "FWL_LIME"; case "FWL_PINK";
                                $handlingFee = $this->fastway_labels_handling;
                                break;

                            case "FWB1"; case "FWB2"; case "FWB3";
                                if (!($displayed3 & 8)) {   //  only one per group
                                   $handlingFee = $this->fastway_boxes_handling;
                                }
                                break;

                            case "FWS1": case "FWS3": case "FWS3l": case "FWS5":
                                if ((!($displayed & 32)) && ($quote->cost > 0)) {   //  only one per group
                                    $handlingFee = $this->fastway_satchels_handling;
                                    $displayed = $displayed | 32;
                                }
                                break;

//////// Transdirect /////////////////
                            case "TRDti": case "TRDmf":case "TRDnl":case "TRDae":case "TRDcp": case "TRDfw": case "TRDtii": case "TRDtp":case "TRDtpi":case "TRDts":case "TRDtsi":
                            case "TRDaei": case "TRDcpi":case "TRDfwi":case "TRDmfi": case "TRDnli":case "TRDtntr": case "TRDtntri":
                            case "TRDtnt5": case "TRDtnt5i": case "TRDtnt9": case "TRDtnt9i": case "TRDtnt10": case "TRDtnt10i": case "TRDtnt12":case "TRDtnt12i":
                                $handlingFee = $this->trd_handling;
                             break;

//////////////  EGO ///////////////////////////////////////
                            case "EGO":$handlingFee = $this->ego_handling; break;
                            case "EGOi":$handlingFee = $this->ego_handling + $this->ri_handling;
                            break;

///////////// Startrack ///////////////////////
                            case "STAexp": case "STAprm": $handlingFee = $this->sta_handling; break;
                            case "STAprm": case "STAprmi":case "STAexpi": $handlingFee = $this->sta_handling + $this->ri_handling;
                             break;
                // (Satchels) //
                            case "STA1k": case "STA3k": case "STA5k":
                                if (!($displayed2 & 8)) {   //  only one per group
                                    $handlingFee = STAS_HANDLING;
                                    $displayed2 = $displayed2 | 8;
                                }
                                break;

//////////  Couriers Please  V1 - account needed //
                            case "CPL":  $handlingFee = $this->cpl_handling; break;
                            case "CPLi": $handlingFee = $this->cpl_handling + $this->$this->ri_handling;
                            break;

//////////  Couriers Please  V2 - account not needed //
                            case "CPLlab":
                                if ((floatval($this->cpl_metro_labels)) + (floatval($this->cpl_ezy_labels > 0))) { // reset cost if overridden //
                                    $fn = preg_split("/\(/", $quote->description);

                                    $fn = preg_split("/,/", $fn[1]);
//                                    $m = (substr($fn[0], 0, 1));
//                                    $l = (substr($fn[1], 1, 2));
                                    $quote->cost = ( (substr($fn[0], 0, 1)) *   (floatval($this->cpl_metro_labels))  )  + ((substr($fn[1], 1, 2)) *   (floatval($this->cpl_ezy_labels))  );
                                }
                                $handlingFee = $this->cpl_handling;
                                break;

// Courier please satchels - account not needed //
                            case "CPL1": case "CPL3": case "CPL5":
                                if (!($displayed2 & 32)) {   //  only one per group
                                    $handlingFee = $this->cpl_satchel_handling;
                                    $displayed2 = $displayed2 | 32;
                                }
                                break;

// Click N Send
                            case "CNS500": case "CNS3K":case "CNS5K": case "CNSbx1": case "CNSbx2":
                                if (!($displayed & 128)) {   //  only one per group
                                    $handlingFee = $this->cnss_handling;
                                    if ($quote === "CNSBx1")
                                        $handlingFee = $this->cnsb_handling;
                                    if ($quote === "CNSBx2")
                                        $handlingFee = $this->cnsb_handling;
                                    $displayed = $displayed | 128;
                                }
                                break;
// Click N Send Express
                            case "CNS500e": case "CNS3Ke": case "CNS5Ke":
                                if (!($displayed3 & 16)) {   //  only one per group
                                    $handlingFee = $this->cnss_handling;
                                    $displayed3 = $displayed3 | 16;
                                }
                                break;

// Skippy Post
                            case "SKP"; case "SKPt"; case "SKPp";       $handlingFee = $this->skp_handling; break;
                            case "SKPti";case "SKPtp";case "SKPtip";    $handlingFee = $this->skp_handling + $this->$this->ri_handling;
                            break;
                        } //  end switch //

// Valididy test // 
  if ((( isset($handlingFee) && (float)($quote->cost) > 0)) || (($this->show_errors === "yes") && ((string)$quote->id ===  "Error"))) {  // valid quote or showing errors 

// Heavy Parcel surcharge      
  if((intval($xmlQuotes->information[0]->calculated_parcel_weight_kg)  >=  intval($this->hp_weight)) && ($this->show_errors !== "yes")) $handlingFee += (float)$this->hp_surcharge; //  Heavy parcel surcharge // 
       
$cost =  (floatval($quote->cost )) + $handlingFee ;  // set the total cost 

  if ($cost < 0) { $handlingFee = 0-(float)($quote->cost) ;  $cost = 0 ; } // Handling fees can be negative values, so we do this to ensure the final cost isn't negative 

 if (($dest_country == "AU") && ($this->tax_status  !== "yes"))  $cost = $cost - ( $cost / ($taxrate + 1) ) ;  //  Exclude GST if needed 

 $carrier = '<strong>'. (string)$quote->carrier . " </strong><br>" . (string)$quote->description ; 
 
 $estimateddays = NULL ;
   if ($this->estimated_delivery_format !== "None") {
        $estimateddays = (string)$quote->days ;
            if($estimateddays !=  "n/a" ){
             if ($this->estimated_delivery_format === "Days") { $estimateddays .=  $this->estimation_text_days ; } else { $estimateddays = $this->estimation_text_date . $estimateddays ; } 
        }
   }

$details = NULL;
    if  ($this->show_handling_fee === 'yes')    $details = ((float) $handlingFee > 0)           ? $details .= "<br>".   $this->handling_text_pre .      number_format((float)$handlingFee,2) .          $this->handling_text_post : $details;
    if  ($this->show_insurance_cost === 'yes')  $details = ((float)$quote->insuranceIncl > 0)   ? $details .= "<br>".   $this->insurancefee_text_pre .  number_format((float)$quote->insuranceIncl,2) . $this->insurancefee_text_post : $details;
    if  ($this->show_otherfee === 'yes')        $details = ((float)$quote->otherfeeIncl > 0)    ? $details .= "<br>".   $this->otherfee_text_pre .      number_format((float)$quote->otherfeeIncl ,2) ." ". $quote->otherfeeName . $this->otherfee_text_post : $details;

   /////////////////////////////////////////    
  // ***********   store it ************* //
  //////////////////////////////////////////    
 
   $rate = array('id' => "ozpost.".$quote->id ,'label' => $carrier. $details ,'cost' => $cost);                                                        
        $this->add_rate($rate);   
         $valid = 1 ;
        }   // end  if ((isset($handlingFee)) && ($quote->cost> 0))
     } //if (in_array($quote->id, $allowed_methods))  no match
   } // next method
  
   if  ($valid === 0 ) { $this->_no_data($dest_country) ; }
   }  else { 
         $this->_no_data($dest_country) ;
         //   if ($this->enable_debug == "yes" )  echo "<br>Server Error <br>$result" ;  
            } // Server error	
}   // ! FUNCTION calculate_shipping

// FUNCTION _no_data
private function _no_data($dest_country) {
 switch ($this->cost_on_error_method) {

                    case "TBA":
                        $cost[0]  = 999;   $title = $this->tba_text ; break;
           
                    case "TBL":
                        $cost = $this->_get_table_rate($dest_country);
                         if ($cost[0] === 0)  { $title = $this->tba_text  ;  $cost[0] = 999; }
                         else {  
                            if($this->table_type === "PRC") $type = "Price";
                            if($this->table_type === "WGT") $type = "Weight";
                            if($this->table_type  === "ITM") $type = "#Items in cart";
                            $title = "Table Rate based on  $type"; }
                        break;

                    case "CPI":case "CPK": case "CPP":
                        $cost = $this->_get_static_rate($dest_country);
                        if ($cost[0] === 0) { $title = $this->tba_text;  $cost[0] = 999; } else
                          { 
                             if($this->cost_on_error_method === "CPP") { $title = "Flat Rate " ;  } else {
                                $type =  ($this->cost_on_error_method === "CPK") ? " Per Kg " : " Per Item " ;
                                $title = " $" . $cost[1] . $type ;     
                            }           
                          }    
                        break;
                    default: $skip = 1 ;        
                }
             if(!$skip)  {     
// store it //
        $rate = array('id'  => 'ozpost.static ','label' => $title,'cost'  => $cost[0]);                            
        $this->add_rate($rate);  
     }
} // ! FUNCTION _no_data

// FUNCTION _get_static_rate
private function _get_static_rate($dest_country) {
global $parcelweight, $packageitems ;
 $x = explode(',', $this->static_rates) ;
        $rate = ($dest_country == "AU")  ?  $x[0]:$x[1] ;
        $cost = $rate ;
               if ( $this->cost_on_error_method == "CPK") { $cost = $rate * intval(($parcelweight/1000) + 1) ; }
                if ( $this->cost_on_error_method == "CPI") { $cost = $rate * $packageitems ; }

return array($cost,$rate);
} // ! FUNCTION _get_static_rate

// FUNCTION _get_table_rate
private function _get_table_rate($dest_country) {
        global $parcelweight, $packageitems, $value ;

        // Trim leading and trailing spaces //
        $table = trim($this->table_rates);
        // trim multiple spaces //
        $table = preg_replace('/\s+/', ' ', $table);
        // Replace comma-space with just a comma
        $table = preg_replace('/, /', ',', $table);

        // explode tables //
        $x = explode(' ', $table);

        switch ($this->table_type) {
            case ('PRC'): $calc = $value; break;
            case ('WGT'): $calc = $parcelweight / 1000;  break; //kgs
            case ('ITM'): $calc = $packageitems; break;
        }
        $cost = 0;
        $rates = ($dest_country == "AU") ? $x[0] : $x[1];

        $table_cost = preg_split("/[:,]/", $rates);
        $size = sizeof($table_cost);

        for ($i = 0, $n = $size; $i < $n; $i+=2) {
            if (round($calc, 9) <= $table_cost[$i]) {
                if (strstr($table_cost[$i + 1], '%')) {
                            $cost = ($table_cost[$i + 1] / 100) * $value;
                } else {    $cost = $table_cost[$i + 1]; }
            break;
            }
        }
return array($cost, $this->table_type);
 } // ! FUNCTION _get_table_rate

 // FUNCTION _get_from_ozpostnet
private function _get_from_ozpostnet($request, $items = "", $controls = "") {
    $domain = "ozpost.net" ;
    $error1 =  $error2 =  $error3 =  $data = "" ;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, "[WooCommerce v" . WC_VERSION ." : ".$this->id. " v".$this->version."] " . $_SERVER['SERVER_NAME'] );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT,45);  
    curl_setopt($ch, CURLOPT_POST, false);

    if (is_array($items)) {
        curl_setopt($ch, CURLOPT_POST, true);
        $vars = http_build_query(array('Items' => $items)) ;  
        $vars .=  $controls  ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, "$vars" );
    } 

 if($_SERVER['REMOTE_HOST'] === "sue") { // VCSWEB Local debugging (won't work for anyone else) 
       curl_setopt($ch, CURLOPT_URL,"sue/ozpost".$request); $data = curl_exec($ch); $error1 = curl_error($ch);
       if(($error1 != "") || ($data == ""))  { $data = '<error>'.$error1.$data.'</error>' ;   }
} else {     // Live servers 
       curl_setopt($ch, CURLOPT_URL,"svr1.".$domain.$request); $data = curl_exec($ch); $error1 = curl_error($ch);
    
 if(($error1  != "") || ($data == "")) { curl_setopt($ch, CURLOPT_URL,"svr2.".$domain.$request); $data = curl_exec($ch);   $error2 = curl_error($ch); }
    
    if (($error2 != "") || ($data == "")) { curl_setopt($ch, CURLOPT_URL,"svr0.".$domain.$request);  $data = curl_exec($ch);   $error3 = curl_error($ch);
        if (($error3 != "")|| ($data == "")) {
            wc_add_notice( __( 'Temporary Network Error. Please try again shortly<br>Server#1: '.$error1.'<br>Server#2 : '.$error2.' <br>Server#3 : '.$error3.'', 'woocommerce-ozpost' ), 'error' ) ; 
            $data = '<error></error>' ; }
    }
 }
// echo $data ; die ;
 curl_close($ch);
 return $data ;
 }   // ! FUNCTION _get_from_ozpostnet
  
// FUNCTION _generate_settings_html
 private function _generate_settings_html( $form_fields = array() ) {
?>  
 <table class="form-table">
<?php      
 if ( !$form_fields ) $form_fields = $this->get_form_fields();
    $html = ''; $t = 0 ; 
        foreach ( $form_fields as $k => $v ) { 
            $text2 = "" ;   //  Custom display handling // 
            if ((strpos($k, "_methods")) || ($k == "ri_handling")) {
                $text = ($k != "ri_handling") ? $v['title']:"Other Settings" ;
                $text = preg_replace ( '/Methods/', '' , $text );
            if($t === 0 ) { $text2 = "<hr><em>Select Shipping Options</em>" ; } 
    $html .= "</tr></td></table>$text2<p class=\"ozpostHeadings\" onclick=\"toggle_visibility('table$t')\">".$text."</p><table class=\"form-table\" style=\"display:none\" id=\"table".$t."\">" ;          
           $t++ ;
        } 
          // eof Custom handling // 
        if (!isset( $v['type'] ) || ( $v['type'] == '' ) ) $v['type'] = 'text';  // Default to "text" field type.
        $html .=  ( method_exists( $this, 'generate_' . $v['type'] . '_html' ) ) ? $this->{'generate_' . $v['type'] . '_html'}( $k, $v ):$this->{'generate_text_html'}( $k, $v );
        }
echo $html;
?>
  </table>
 <?php
 }

//  
 private function _updateSuburb($suburb) {
    $this->settings['origin_suburb'] = $suburb ; 
        update_option($this->plugin_id.$this->id."_settings", $this->settings) ;
return null ;
 }
 
 private function _update_email_counter($count) {
    $this->settings['email_count'] = $count ; 
      update_option($this->plugin_id.$this->id."_settings", $this->settings) ; 
return null ;
 }
 
private function _ozpost_network_test() {
       error_reporting(E_ALL);
$url[] = "svr0.ozpost.net";
$url[] = "svr1.ozpost.net";  
$url[] = "svr2.ozpost.net";
 
//$url[] = "svrX.ozpost.net"; //  used to test that error reports are correctly shown.  
//$url[] = "http://svrX.ozpost.net"; //  used to test that error reports are correctly shown.  

$data = "/postage.php?flags=get_latest_client_version_woo" ; //  test string. We check for a valid return, not just any server response.  
$text =  "<div><br>Ozpost server test results<br>" ; 
$i = 0 ;

while ($i < sizeof($url)) {
 $ip = gethostbyname($url[$i]);
 $ip = ($ip === $url[$i]) ? "" : " (".$ip ;
    
$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://".$url[$i].$data);
  curl_setopt($ch, CURLOPT_VERBOSE, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
  curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 2);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
  curl_setopt($ch, CURLOPT_USERAGENT, "[WooCommerce v" . WC_VERSION ." : ".$this->id. " v".$this->version."] " . $_SERVER['SERVER_NAME'] );
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$edata =  curl_exec($ch);
$errtext = curl_error($ch);
$errnum = curl_errno($ch);
$commInfo = curl_getinfo($ch);

if ($edata === "Access denied") { $errtext = "<strong>".$edata . ".</strong> Please report this error to <strong>support@ozpost.net  ";} 

  curl_close($ch);
           $text .= "<div style='color:black;display: inline-block;font-weight:bold;width:220px;'>" . $url[$i].$ip. ")</div>";
            
            if (($commInfo['http_code'] == 200) && ($errnum == 0)) {
                 
                 $commInfo['connect_time'] =  (($commInfo['connect_time'] * 1000) >= 1 ) ? intval($commInfo['connect_time'] * 1000):number_format(($commInfo['connect_time'] * 1000),3) ;
                 $commInfo['namelookup_time'] =  (($commInfo['namelookup_time'] * 1000) >= 1 ) ? intval($commInfo['namelookup_time'] * 1000):number_format(($commInfo['namelookup_time'] * 1000),3) ;
                 $commInfo['total_time'] =  (($commInfo['total_time'] * 1000) >= 1 ) ? intval($commInfo['total_time'] * 1000):number_format(($commInfo['total_time'] * 1000),3) ;
                              
                $text .= "<div style='color:blue;display: inline-block;white-space: nowrap;'>";
                $text .= " Connect Time : " . $commInfo['connect_time'] . "ms , ";
                   if ($commInfo['connect_time'] < 100) $text .=  "&nbsp;" ;
                
                $text .= " DNS lookup Time : " .  $commInfo['namelookup_time'] . "ms , "; 
                    if ($commInfo['namelookup_time'] > 1 ) $text .=  "&nbsp;&nbsp;&nbsp;" ;
                $text .= " Total Time : " .  $commInfo['total_time'] . "ms , ";
                 if ($commInfo['total_time'] < 100) $text .=  "&nbsp;" ;
                $text .= "<div style='color:black;display: inline-block;font-weight:bold;'> " ;
     
                 if (($commInfo['total_time']) > 1000) { $text .=  " Poor "  ; } else
                 if (($commInfo['total_time']) > 700)  { $text .=  " Sluggish " ; } else
                 if (($commInfo['total_time']) < 300)  { $text .=  " Excellent "   ; } else
                 if (($commInfo['total_time']) <= 700) { $text .=  " Good " ; }
                
                 $text .= "</div></div>" ;
                
            } else {
                $text .= "<div style='color:red;display:inline-block;white-space: nowrap;'>" . $errtext . " , FAIL </strong></div>";
            }
            $text .=  "</br>";
            $i++;
        }
   $text .= "</div>" ;
   error_reporting(0);     
   return $text ; 
    }  
   }  //  End Class  
  }  //  end ozpost_init 
} // No WooCommerce found 
