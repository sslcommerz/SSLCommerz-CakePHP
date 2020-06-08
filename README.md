# SSLCOMMERZ - CakePHP 3.6
 
### Prerequisites

1. PHP 5.6-7.2 and Mysql.
2. cURL php extension.
3. [Sandbox Account](https://developer.sslcommerz.com/registration/ "SSLCommerz Sandbox Registration")


##  Description 
In this example you will find below scripts.
  1. `config/routes.php` : Required route for the functions
  2. `src/Controller/PaymentController.php` : All the functions to do the transaction. Read the comments carefully.
  3. `src/Utility/sslcommerz/` directory: Helper Library class collection.
  4. `src/Utility/sslcommerz/config/config.php` file : Update Store id, Store password, Connecte to Sandbox (Test Environment) or Live Environment
  5. `src/Template/Payment` directory: Example view files for Easycheckout (Popup) and Hosted checkout payment integration.

> Note: Here, `src/Utility/sslcommerz/` directory contains the core library that is needed for integrating the SSLCommerz Payment gateway with your system. Other files are provided for understanding the integration process.

For EasyCheckout (Popup) integration, make sure that, the below script is added before the end of body tag in your view file.

##### Sandbox
```
(function (window, document) {
    var loader = function () {
        var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
        script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
        tag.parentNode.insertBefore(script, tag);
    };

    window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
})(window, document);
```

##### Live
```
(function (window, document) {
	var loader = function () {
		var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
		script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
		tag.parentNode.insertBefore(script, tag);
	};

	window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
})(window, document);
```

And, for _Pay Now_ button, use the below code:

```
<button class="your-button-class" id="sslczPayBtn"
        token="if you have any token validation"
        postdata="your javascript arrays or objects which requires in backend"
        order="If you already have the transaction generated for current order"
        endpoint="payViaAjax"> Pay Now
</button>

```
## Run the project

1. First create your Sanbox(Test Environment) store account from below url. After registration you will get two mail. One for Store_id and Store_password. Another one for Report panel access.	
   [Sandbox Account](https://developer.sslcommerz.com/registration/ "SSLCommerz Sandbox Registration")
   Note: For live store id or account you have to communicate with us. Our mail address: operation@sslcommerz.com

2. Then give the store_id and store_password in SSLCommerz.php page.

3. Here you have to run the PaymentController.php controller by calling pay (Like: http://yourdomain.com/pay)
   Here you have to receive all the order data to initate the payment.
   Let's say, your oder trnsaction informations are saving in a table called "orders"
    - In orders table, order unique identity is "order_id",
    - "status" field contain status of the transaction,
    - "amount" is the order amount to be paid
    - and "currency" is for storing Site Currency which will be checked with paid currency.

4. You have to set your IPN page from the provided report panel. After login, go to My Stores then IPN Settings. IPN url will be http://yourdomain.com/ipn.

5. For EasyCheckout integration example, please check the `http://yourdomain.com/example1` and for hosted checkout example, please check the `http://yourdomain.com/example2` URL.


## Help URL

  1. [Developer Page](https://developer.sslcommerz.com/doc/v4/ "Developer Page")
  2. IPN Setup

![IPN1](screenshot-1.png)

![IPN2](screenshot-2.png)
	
## Check List After Making the site Live or Connect with Live SSLCOMMERZ

Customer need to do a live transaction to check the full process. After the transaction below things need to ensure 
1. Transaction is showing successful in SSLCOMMERZ Panel (https://report.sslcommerz.com)  
2. Transaction details are same in SSLCOMMERZ Panel (https://report.sslcommerz.com) and Customer site admin Panel.
3. Transaction amount is same in Issuer bank end.
4. In Transaction Details API Validated by Merchant is YES.

Note: In the gateway you may not found Banks. After getting live store id, it takes 10 to 15 working days to enable these. You may follow up your KAM(Key Account Manager).

## Contributors

> Cm. Saydur Rahman 

> Prabal Mallick

> Md. Rakibul Islam

> integration@sslcommerz.com

