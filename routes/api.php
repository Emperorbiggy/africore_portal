<?php

use App\Http\Middleware\CorsMiddleware;
use App\Http\Controllers\FetchUserDetails;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\Vs2SignUpController;
use App\Http\Controllers\Vs1SignUpController;
use App\Http\Controllers\Vs2SignInController;
use App\Http\Controllers\OtpVerificationController;
use App\Http\Controllers\CreatePasscodeController;
use App\Http\Controllers\CreateTransactionPinController;
use App\Http\Controllers\WelcomeMailController;
use App\Http\Controllers\WalletBalanceController;
use App\Http\Controllers\FetchTransactionController;
use App\Http\Controllers\VerifyUserController;
use App\Http\Controllers\VerifyPin;
use App\Http\Controllers\TamopeiTransfer;
use App\Http\Controllers\ReceiptsController;
use App\Http\Controllers\FetchBank;
use App\Http\Controllers\ResolveAccount;
use App\Http\Controllers\KycTier1;
use App\Http\Controllers\KycTier2;
use App\Http\Controllers\BvnVerification;
use App\Http\Controllers\VerifyBvnOtp;
use App\Http\Controllers\Checkout;
use App\Http\Controllers\PaymentController;








Route::middleware([CorsMiddleware::class])->group(function () {
    Route::post('/vs2/fetch/users', [FetchUserDetails::class, 'fetchUserWithToken']);
    Route::post('/vs1/signin', [SignInController::class, 'postSignIn']);
    Route::post('/vs2/signup', [Vs2SignUpController::class, 'register']);
    Route::post('/vs1/signup', [Vs1SignUpController::class, 'signUp']);
    Route::post('/vs2/signin', [Vs2SignInController::class, 'signIn']);
    Route::post('/verify-otp', [OtpVerificationController::class, 'verifyOtp']);
    Route::post('/create/passcode', [CreatePasscodeController::class, 'createPasscode']);
    Route::post('/create/pin', [CreateTransactionPinController::class, 'createTransactionPin']);
    Route::post('/send-welcome-email', [WelcomeMailController::class, 'sendWelcomeEmail']);
    Route::post('/wallet/balance', [WalletBalanceController::class, 'getBalance']);
    Route::post('/fetch/transactions', [FetchTransactionController::class, 'fetchTransactions']);
    Route::post('/account/resolve/user', [VerifyUserController::class, 'verifyUser']);
    Route::post('/verify/pin', [VerifyPin::class, 'verify']);
    Route::post('/wallet/transfer', [TamopeiTransfer::class, 'transfer']);
    Route::post('/receipt', [ReceiptsController::class, 'getReceipt']); 
    Route::get('/fetch/banks', [FetchBank::class, 'fetchBanks']);
    Route::post('/resolve/account', [ResolveAccount::class, 'resolveAccount']);
    Route::post('/kycTier1', [KycTier1::class, 'kycTier1']);
    Route::post('/kycTier2', [KycTier2::class, 'upgradeToTier2']);
    Route::post('/verify-bvn', [BvnVerification::class, 'verify']);
    Route::post('/verify-bvn-otp', [VerifyBvnOtp::class, 'verify']);
    Route::post('/checkout', [Checkout::class, 'handleCheckout']);
    Route::post('/make-payment', [PaymentController::class, 'makePayment']);
});
