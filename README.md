# GenerateUniqueVoucher
Laravel generate unique voucher number
Append letter or any character to number , 
Check if number exists in table
If exists recall function ..


public function generateVoucher(){
//insert 100000 number to db
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

//check if exists in table,
public function barcodeNumberExists($number) {
    return DB::table('voucher_tbl')->where('voucher_number',$number)->exists();
}
