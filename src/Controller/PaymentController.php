<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;
//use Cake\Datasource\ConnectionManager;


use Cake\Controller\Controller;
use Cake\Event\Event;
use App\Utility\SSLCommerz\SslCommerzNotification;
use Cake\Routing\Router;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class PaymentController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function example1()
    {
        //
    }

    public function example2()
    {
        //
    }

    public function payViaAjax()
    {
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        # Upate query start
        # Before  going to initiate the payment order status need to update as Pending and currency=$post_data['currency']. In where clause order_id=$post_data['tran_id']
        # Update query end

        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $sslcz = new SslCommerzNotification();
        $response = $sslcz->makePayment($post_data, 'checkout', 'json'); // In your controller's action when saving failed

        // For returning JSON format data, you need to decode the response first
        $payment_options = (array)json_decode($response);

        $this->set('_jsonOptions', JSON_FORCE_OBJECT);

        $this->set([
            'data' => $payment_options,
            '_serialize' => 'data',
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    public function index()
    {


        #Here you have to receive all the order data to initate the payment.
        #Lets your oder trnsaction informations are saving in a table called "orders"
        #In orders table order uniq identity is "order_id","order_status" field contain status of the transaction, "grand_total" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        $server_name = Router::fullBaseUrl(); // Change this part according to your project directory

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        # Upate query start
        # Before  going to initiate the payment order status need to update as Pending and currency=$post_data['currency']. In where clause order_id=$post_data['tran_id']
        # Update query end

        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $sslcz = new SslCommerzNotification();
        $payment_options = $sslcz->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function success()
    {
        echo "Transaction is Successful";

        $requestData = $this->request->getData();

        #Start to received these value from session. which was saved in index function.
        $tran_id = $requestData['tran_id'];

        #End to received these value from session. which was saved in index function.

        #Check Query Start
        #Check order status in order tabel against the transaction id or order id. Then put the value to $grand_total,$currency and $order_status
        #Check Query End

        # For demo purpose I am setting static value. In live you have to assign it from above query
        $grand_total = $requestData['amount'];
        $currency = $requestData['currency'];
        $order_status = 'Pending';

        if ($order_status == 'Pending') {
            $sslcz = new SslCommerzNotification();
            $validation = $sslcz->orderValidate($tran_id, $grand_total, $currency, $requestData);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                #Update Query Start
                #Update order status as Processing or Complete in order tabel against the transaction id or order id.
                #Update Query End
                echo "<br >Transaction is successfully Completed.";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                #Update Query Start
                #Update order status as Falied in order tabel against the transaction id or order id.
                #Update Query End
                echo "validation Fail";
            }
        } else if ($order_status == 'Processing' || $order_status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Complete";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


        die();
    }

    public function fail()
    {
        $requestData = $this->request->getData();
        $tran_id = $requestData['tran_id'];

        #Check Query Start
        #Check order status in order tabel against the transaction id or order id. Then put the value to  $order_status
        #Check Query End

        $order_status = 'Pending';
        if ($order_status == 'Pending') {
            #Update Query Start
            #Update order status as Falied in order tabel against the transaction id or order id.
            #Update Query End
            echo "Transaction is Falied";
        } else if ($order_status == 'Processing' || $order_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
        die();

    }

    public function cancel()
    {
        $requestData = $this->request->getData();
        $tran_id = $requestData['tran_id'];

        #Check Query Start
        #Check order status in order tabel against the transaction id or order id. Then put the value to $order_status
        #Check Query End

        $order_status = 'Pending';
        if ($order_status == 'Pending') {
            #Update Query Start
            #Update order status as Cancelled in order tabel against the transaction id or order id.
            #Update Query End
            echo "Transaction is Cancel";
        } else if ($order_status == 'Processing' || $order_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

        die();
    }

    public function ipn()
    {
        #Received all the payement information from the gateway
        $requestData = $this->request->getData();
        $tran_id = isset($requestData['tran_id']) ? $requestData['tran_id'] : null;

        if ($tran_id) {

            #Check Query Start
            #Check order status in order tabel against the transaction id or order id. Then put the value to  $grand_total,4currency and $order_status
            #Check Query End

            # For demo purpose I am setting static value. In live you have to assign it from above query

            $order_status = 'Pending';
            $grand_total = $requestData['amount'];
            $currency = $requestData['currency'];

            if ($order_status == 'Pending') {
                echo "Pending status";

                $sslcz = new SslCommerzNotification();
                $validation = $sslcz->orderValidate($tran_id, $grand_total, $currency, $requestData);

                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successfull transaction to customer
                    */
                    #Update Query Start
                    #Update order status as Processing or Complete in order tabel against the transaction id or order id.
                    #Update Query End
                    echo "Transaction is successfully Complete";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    #Update Query Start
                    #Update order status as Falied in order tabel against the transaction id or order id.
                    #Update Query End
                    echo "validation Fail";
                }

            } else if ($order_status == 'Processing' || $order_status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Complete";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Inavalid Data";
        }
        die();
    }

}
