<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;

class PaymentController extends Controller
{
    private $razorpayId = "rzp_test_rgEdqAf0V9Viyi";
    private $razorpayKey = "2eV3iUeIao2ACrYJo3QsSUgT";

    public function Initiate(Request $request)
    {
        $ref_no = $request->all()['admission_ref_no'];
        $secureCode = $request->all()['secureCode'];
        
        $studentData = DB::table('student_master')->select('*')->where('admission_ref_no',$ref_no)->first();
        $mst_class = DB::table('mst_class')->select('*')->where('class_name',$studentData->present_class)->where('type','newadmission')->first();

        $encrypted = trim($request->amount).'/'.trim($request->admission_ref_no);
        $PostsecureCode = base64_encode(base64_encode($encrypted));
        // Let's see the documentation for creating the order
        
        
        if($secureCode != $PostsecureCode){
            die('Oops somethings went wrong');
        }
        if($studentData && $mst_class){

            // Generate random receipt id
            $receiptId = Str::random(20);

            $api = new Api($this->razorpayId, $this->razorpayKey);

            // In razorpay you have to convert rupees into paise we multiply by 100
            // Currency will be INR
            // Creating order
            $order = $api->order->create(array(
                'receipt' => $receiptId,
                'amount' => $mst_class->fee_amount * 100,
                'currency' => 'INR'
                )
            );

            // Let's return the response 

            // Let's create the razorpay payment page
            $response = [
                'orderId' => $order['id'],
                'razorpayId' => $this->razorpayId,
                'amount' => $mst_class->fee_amount * 100,
                'name' => $request->all()['name'],
                'currency' => 'INR',
                'email' => $request->all()['email'],
                'contactNumber' => $request->all()['contactNumber'],
                'address' => $request->all()['address'],
                'description' => 'Testing description',
            ];
            $amount = $mst_class->fee_amount;
            // Let's checkout payment page is it working
            return view('payment/payment-page',compact('response','ref_no','amount'));
        }else{
            die('Invalid request!');
        }
    }


    public function Complete(Request $request)
    {
        // Let's print the payment response data
        if ($request->isMethod('post')){
            // Now verify the signature is correct . We create the private function for verify the signature
            $signatureStatus = $this->SignatureVerify(
                $request->all()['rzp_signature'],
                $request->all()['rzp_paymentid'],
                $request->all()['rzp_orderid']
            );

            // If Signature status is true We will save the payment response in our database
            // In this tutorial we send the response to Success page if payment successfully made
            if($signatureStatus == true)
            {
                $ref_no = $request->ref_no;
                $checkPayment = DB::table('payments')->select('*')->where('rzp_paymentid',$request->rzp_paymentid)->first();
                $data = array(
                    
                    'admission_ref_no' => $request->ref_no,
                    'rzp_paymentid' => $request->rzp_paymentid,
                    'rzp_orderid' => $request->rzp_orderid,
                    'rzp_signature' => $request->rzp_signature,
                    'amount' => isset($request->amount)?$request->amount:0,
                    'IsPayment' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                DB::table('student_master')->where('admission_ref_no', $ref_no)->update(array('IsPayment'=>1));
                if(!$checkPayment){
                    $insert = DB::table('payments')->insert($data);
                }
                $PaymentReceipt = DB::table('payments')->select('*')->where('rzp_paymentid',$request->rzp_paymentid)->first();
                //pr($checkPayment);
                //exit();
                return view('payment/payment-success-page',compact('data','PaymentReceipt'));
            }
            else{
                return view('payment/payment-failed-page');
            }
        }else{
            die('Invalid request');
        }
    }

    // In this function we return boolean if signature is correct
    private function SignatureVerify($_signature,$_paymentId,$_orderId)
    {
        try
        {
            $api = new Api($this->razorpayId, $this->razorpayKey);
            $attributes  = array('razorpay_signature'  => $_signature,  'razorpay_payment_id'  => $_paymentId ,  'razorpay_order_id' => $_orderId);
            $order  = $api->utility->verifyPaymentSignature($attributes);
            return true;
        }
        catch(\Exception $e)
        {
            // If Signature is not correct its give a excetption so we use try catch
            return false;
        }
    }
}
