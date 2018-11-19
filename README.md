# SSLCOMMERZ Payment Gateway Integration using CakePHP 3.6
Requires : PHP 5.6-7.2 and Mysql,
License: GPLv2 or later, 
Contributors: C.M.Sayedur Rahman,
	          cmsayed@gmail.com


##  Description 
In this example you will find below script.
  1. config\routes.php : Required route for the functions
  2. src\Controller\PaymentController.php: All the functions to do the transaction. Read the comments carefully.
  3. src\Controller\Component\SSLCommerzComponent.php: Helping class, here you will input store information: Store id, Store password, Connecte to Sandbox(Test Environment) or Live Environment
  

## Run the project
	1. First create your Sanbox(Test Environment) store account from below url. After registration you will get two mail. One for Store_id and Store_password. Another one for Report panel access.	
	   https://developer.sslcommerz.com/registration/
	   Note: For live store id or account you have to communicate with us. Our mail address: operation@sslcommerz.com
	2. Then give the store_id and store_password in SSLCommerz.php page. 
	3. Here you have to run the PaymentController.php controller by calling pay(Like: http://yourdomain.com/pay)
	   Here you have to receive all the order data to initate the payment.
       	Lets your oder trnsaction informations are saving in a table called "orders"
       	In orders table order uniq identity is "order_id","order_status" field contain status of the transaction, "grand_total" 
	    is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
	4. You have to set your IPN page from the provided report panel. After login, go to My Stores then IPN Settings. IPN url will be http://yourdomain.com/ipn.

== Help URL==
	1. https://developer.sslcommerz.com/docs.html :URL to start integrate SSLCOMMERZ as a Developer
	2. https://developer.sslcommerz.com/registration/: URL to Create Account in Sandbox
	
## Check List After Making the site Live or Connect with Live SSLCOMMERZ
Customer need to do a live transaction to check the full process. After the transaction below things need to ensure 
1. Transaction is showing successful in SSLCOMMERZ Panel (https://report.sslcommerz.com)  
2. Transaction details are same in SSLCOMMERZ Panel (https://report.sslcommerz.com) and Customer site admin Panel.
3. Transaction amount is same in Issuer bank end.
4. In Transaction Details API Validated by Merchant is YES.

Note: In the gateway you may not found Banks. After getting live store id, it takes 10 to 15 working days to enable these. You may follow up your KAM(Key Account Manager).

	

