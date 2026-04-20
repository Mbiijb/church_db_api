<?php
// Receive the JSON data from Safaricom
$callbackJSONData = file_get_contents('php://input');
$logFile = "stkPushPaymentResponse.json";
$log = fopen($logFile, "a");
fwrite($log, $callbackJSONData);
fclose($log);

$data = json_decode($callbackJSONData);

$resultCode = $data->Body->stkCallback->ResultCode;
$checkoutRequestID = $data->Body->stkCallback->CheckoutRequestID;

if ($resultCode == 0) {
    // Payment was successful
    $details = $data->Body->stkCallback->CallbackMetadata->Item;
    $amount = $details[0]->Value;
    $mpesaReceiptNumber = $details[1]->Value;
    $transactionDate = $details[3]->Value;
    $phoneNumber = $details[4]->Value;

    require_once 'connect.php';

    // Idempotency Check: Verify if receipt already exists
    $check = mysqli_query($con, "SELECT * FROM giving_records WHERE mpesa_receipt = '$mpesaReceiptNumber'");
    
    if (mysqli_num_rows($check) == 0) {
        // Insert the successful payment record
        $sql = "INSERT INTO giving_records (amount, mpesa_receipt, phone_number, status) 
                VALUES ('$amount', '$mpesaReceiptNumber', '$phoneNumber', 'Completed')";
        mysqli_query($con, $sql);
    }
}
?>