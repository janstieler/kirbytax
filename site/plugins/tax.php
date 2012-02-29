<?php

// check for a compatible kirby version
if(c::get('version.number') < 1.06) die('Please make sure to update Kirby to 1.06 or newer to run the Tax app');

c::set('tax.currency.symbol', '$');
c::set('tax.currency.html', '&#36;');
c::set('tax.format.date', 'd.m.y');
c::set('tax.format.money', '%.2n');
c::set('tax.warning', false);

function tax() {
  
  global $site;

  $site->invoices = new invoices();
  $site->expenses = new expenses();
    
}

class tax {

  static function floaty($string) {
    $price = (string)$string;
    $price = str_replace(',', '.', $price);
    return floatval($price);
  }
  
  static function price($string) {
    if(!is_float($string)) $string = tax::floaty($string);
    return money_format(c::get('tax.format.money'), $string);
  }

  static function monthNameLong($month) {
    $time = strtotime(date('Y') . '-' . $month . '-01');
    return strftime('%B', $time);    
  }

  static function monthNameShort($month) {
    $time = strtotime(date('Y') . '-' . $month . '-01');
    return strftime('%b', $time);    
  }

}

class invoices {
            
  function __construct() {
    global $site;
    $this->folder = $site->pages->find('invoices');
  }

  function year($num=false) {
    if(!$num) $num = param('year');
    if(!$num) return false;
    
    $years = $this->years();
    return ($years) ? $years->find($num) : false;
  }

  function years() {
    if(isset($this->years)) return $this->years;
    return $this->years = $this->folder->children();
  }

  function month() {
    return param('month');
  }

  function months() {
    return array('01','02','03','04','05','06','07','08','09','10','11','12');
  }

  function invoicesPerMonth($year=false, $month=false) {

    $month  = (!$month) ? $this->month() : false;
    $all    = $this->invoicesPerYear($year);
    $result = array();

    foreach($all as $invoice) {
      $m = date('m',$invoice->date());
      if($m == $month) $result[] = $invoice;
    }

    return $result;

  }

  function invoicesPerYear($year=false) {
  
    if(!$year) $year = $this->year();

    if(!$year) return array();
    return $year->children();            
  }

  function statsPerMonth($year=false, $month=false) {

    $obj = new stdClass;    
    $obj->total    = 0.00; 
    $obj->vat      = 0.00; 
    $obj->subtotal = 0.00; 
    
    foreach($this->invoicesPerMonth($year, $month) as $i) {
      $obj->subtotal = $obj->subtotal + tax::floaty($i->subtotal());
      $obj->vat      = $obj->vat      + tax::floaty($i->vat());
      $obj->total    = $obj->total    + tax::floaty($i->total());
    }
    
    return $obj;    
        
  }

  function statsPerYear($year=false) {

    $obj = new stdClass;    
    $obj->total    = 0.00; 
    $obj->vat      = 0.00; 
    $obj->subtotal = 0.00; 
        
    foreach($this->invoicesPerYear($year) as $i) {
      $obj->subtotal = $obj->subtotal + tax::floaty($i->subtotal());
      $obj->vat      = $obj->vat      + tax::floaty($i->vat());
      $obj->total    = $obj->total    + tax::floaty($i->total());
    }
    
    return $obj;    
        
  }
  
  static function download($invoice) {
    $docs = $invoice->documents()->findByExtension('pdf');
    if(!$docs) return false;
    
    $doc = $docs->first();
    if(!$doc) return false;
                    
    return $doc->url();
  }
  
}

class expenses {
  
  function __construct() {
  
  }

}

?>