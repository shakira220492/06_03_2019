<?php

namespace PaypalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

//use PayPal\Rest\ApiContext;
//use PayPal\Auth\OAuthTokenCredential;
//use PayPal\Api\Amount;
//use PayPal\Api\Details;
//use PayPal\Api\Item;
//use PayPal\Api\ItemList;
//use PayPal\Api\Payer;
//use PayPal\Api\Payment;
//use PayPal\Api\RedirectUrls;
//use PayPal\Api\ExecutePayment;
//use PayPal\Api\PaymentExecution;
//use PayPal\Api\Transaction;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Paypal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

use PayPal\Api\PaymentExecution;

class DefaultController extends Controller
{
    public function checkoutAction(Request $request)
    {
//        require 'start.php';
//        startAction();
        
//            require('vendor/autoload.php');
        
//        $paypal = new ApiContext(
//            new OAuthTokenCredential(
//                'ATg4hDECz7fnRBM6NDiao3TnTSRcYeS3yG8ApvKSiGZazIKyu6jW-AYxBXGTHb7TM4KFy53o8fkMeVQK', 
//                'EC9xlLF-x7BqWkWSYW9Ivtx35nBGcF-NZS1lgZJgXzVb9Q-1qP3-3a85bUmSvMU43x9wjANU4V7_9SF9'
//            )
//        );
//        
//        if (!isset($_POST['product'], $_POST['price'])) {
//            die();
//        }

        
        $product = $_POST['product'];
        $price = $_POST['price'];
        
        $shipping = 2.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
             ->setCurrency('GBP')
             ->setQuantity(1)
             ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
                ->setSubtotal($price);        
        
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();



//
//            $amount = new Amount();
//            $amount->setCurrency('GBP')
//                   ->setTotal($total)
//                   ->setDetails($details);
//
//            $transaction = new Transaction();
//            $transaction->setAmount($amount)
//                        ->setItemList($itemList)
//                        ->setDescription('PayForSomething Payment')
//                        ->setInvoiceNumber(uniqid());
            
            
            
            
            
            
            
            

//            $redirectUrls = new RedirectUrls();
//            $redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
//                         ->setCancelUrl(SITE_URL . '/pay.php?success=false');
//
//            $payment = new Payment();
//            $payment->setIntent('sale')
//                    ->setPayer($payer)
//                    ->setRedirectUrls($redirectUrls)
//                    ->setTransactions([$transaction]);

//            try {
//                $payment->create($paypal);
//            } catch (Exception $e) {
//                die($e);
//            }
//    
//            $approvalUrl = $payment->getApprovalLink();
//    
//            header("Location: {$approvalUrl}");



            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
        
    }
    
    public function payAction()
    {
//        require 'start.php';
        startAction();
        
        if (isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
            die();
        }

        if ((bool)$_GET['success'] === false) {
            die();
        }

        $paymentId = $_GET['PaymentId'];
        $payerId = $_GET['PayerID'];

        $payment = Payment::get($paymentId, $paypal);

        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, $paypal);
        } catch (Exception $e) {
            $data = json_decode($e->getData());
        //    var_dump($data)
            echo $data->message;
            die();
        }

        echo 'Payment made. Thanks!';
    }
    
    public function paypalAction()
    {
        
    }
    
    public function startAction()
    {
//        require 'vendor/autoload.php';

//        define('SITE_URL', 'http://127.0.0.1:8000/checkout_form');

//        $paypal = new \PayPal\Rest\ApiContext(
//            new \PayPal\Auth\OAuthTokenCredential(
//                'ATg4hDECz7fnRBM6NDiao3TnTSRcYeS3yG8ApvKSiGZazIKyu6jW-AYxBXGTHb7TM4KFy53o8fkMeVQK', 
//                'EC9xlLF-x7BqWkWSYW9Ivtx35nBGcF-NZS1lgZJgXzVb9Q-1qP3-3a85bUmSvMU43x9wjANU4V7_9SF9')
//        );
    }
    
    
    
    
    
    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////
    
    private $_api_context;
    
    public function __construct()
    {
        // setup Paypal api context 
//        $paypal_conf = \Config::get('paypal');
//        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
//        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    public function indexAction()
    {
        return $this->render('@Paypal/Default/index.html.twig');
    }
    
    public function postPaymentAction(Request $request)
    {
        if (!isset($_POST['product'], $_POST['price'])) {
            die();
        }
        
        $product = $_POST['product'];
        $price = $_POST['price'];
        $shipping = 2;
        
        $total = $price + $shipping;
        
        
        
        
        //////////////////////////////////////////////////////////////////////////
        
//        $payer = new Payer();
//        $payer->setPaymentMethod('paypal');
//        
//        $items = array();
//        $subtotal = 0;
//        $cart = \Session::get('cart');
//        $currency = 'MXN';
//        
//        foreach ($cart as $producto){
//            $item = new Item();
//            $item->setName($product->name)
//                    ->setCurrency($currency)
//                    ->setDescription($product->extract)
//                    ->setQuantity($product->quantity)
//                    ->setPrice($product->price);
//            
//            $items[] = $item;
//            $subtotal += $product->quantity * $product->price;
//        }
//        
//        $item_list = new ItemList();
//        $item_list->setItems($items);
//        
//        $details = new Details();
//        $details->setSubtotal($subtotal)
//                ->setShipping(100);
//        
//        $total = $subtotal + 100;
//        
//        $amount = new Amount();
//        $amount->setCurrency($currency)
//               ->setTotal($total)
//               ->setDetails($details);
//        
//        $transaction = new Transaction();
//        $transaction->setAmount($amount)
//                    ->setItemList($item_list)
//                    ->setDescription('Pedido de prueba en my Sympony App Store');
//        
//        $redirect_urls = new RedirectUrls();
//        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
//                ->setCancelUrl(\URL::route('payment.status'));
//        
//        $payment = new Payment();
//        $payment->setIntent('Sale')
//                ->setPayer($payer)
//                ->setRedirectUrls($redirect_urls)
//                ->setTransactions(array($transaction));
//        
//        try {
//            $payment->create($this -> api_context);
//        } catch (\Paypal\Exeption\PPConnectionException $ex) {
//            if (\Config::get('app.debug')) {
//                echo "Exception: ".$ex->getMessage() . PHP_EOL;
//                $err_data = json_decode($ex->getData(), true);
//                exit;
//            } else {
//                die('Ups! Algo salió mal');
//            }
//        }
//        
//        foreach($payment->getLinks() as $link) {
//            if ($link->getRel() == 'approval_url'){
//                $redirect_url = $link->getHref();
//                break;
//            }
//        }
//        
//        // add payment ID to session
//        \Session::put('paypal_payment_id', $payment->getId());
//        
//        if(isset($redirect_url)) {
//            // redirect to paypal
//            return \Redirect::away($redirect_url);
//        }
//        
//        return \Redirect::route('cart-show')
//                ->with('error', 'Ups! Error desconocido.');
        
//        enviamos nuestro pedido a paypal
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    public function getPaymentStatusAction(Request $request)
    {
        
//        //get the payment ID before sesion clear
//        $payment_id = \Session::get('paypal_payment_id');
//        
//        //clear the session payment ID
//        \Session::forget('paypal_payment_id');
//        
//        $payerId = \Input::get('PayerID');
//        $token = \Input::get('token');
//        
//        if(empty($payerId) || empty($token)) {
//            return \Redirect::route('home')
//                    ->with('message', 'Hubo un problema al intentar pagar con paypal');
//        }
//        
//        $payment = Payment::get($payment_id, $this->api_context);
//        $execution = new PaymentExecution();
//        $execution->setPayerId(\Input::get('PayerID'));
//        
//        $result = $payment->execute($execution, $this->api_context);
//        
//        if ($result->getState() == 'approved')
//        {
//            return \Redirect::route('home')
//                    ->with('message', 'Compra realizada de forma correcta');
//        }
//        
//        return \Redirect::route('home')
//                ->width('message', 'La compra fue cancelada');
        
//        paypal redirecciona a esta ruta
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
}