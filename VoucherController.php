<?php
namespace App\Http\Controllers\App;
use DB;

class VoucherController extends Controller
{
    
public function generateVoucher(){
  for ($i=0;$i<10000;$i++)
    {
      DB::table('voucher_tbl')->insertGetId([
        'voucher_number'=>$this->generateTNumber(),
      ]);
     }
    return response()->json(['success'=>1,'data'=>DB::table('voucher_tbl')->get(),'message'=>'Data has been returned successfully!']);

     }
     
 public function generateTNumber() {
 //append letter "T" for example
    $number = "T".substr(mt_rand(1000000000, 9999999999),0,6); // better than rand()

//check if exists in table,
    if ($this->barcodeNumberExists($number)) {
        return $this->generateTNumber();
    }
     return $number;
}


public function barcodeNumberExists($number) {
    return DB::table('voucher_tbl')->where('voucher_number',$number)->exists();
}
