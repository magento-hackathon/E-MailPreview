# Research

Research notes for the implementation of this extension.

## E-mail templates

### Contact Form


### Credit Memo Update

* Used in model sales/order_creditmemo in method sendUpdateEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'        => $order
    * 'creditmemo'   => $creditmemo
    * 'comment'      => $comment
    * 'billing'      => $order->getBillingAddress()
* Special:
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()


### Credit Memo Update for Guest

* Same as Credit Memo Update, method selects template depending on $order->getCustomerIsGuest()

### Currency Update Warnings


### Forgot Admin Password


### Forgot Password


### Invoice Update

* Used in model sales/order_invoice in method sendUpdateEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'        => $order
    * 'invoice'      => $invoice
    * 'comment'      => $comment
    * 'billing'      => $order->getBillingAddress()
* Special:
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()

### Invoice Update for Guest

* Same as Invoice update, the method checks whether customer is guest by $order->getCustomerIsGuest()

### Log cleanup Warnings


### Moneybookers activate email


### New Credit Memo

* Used in model sales/order_creditmemo in method sendEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'        => $order
    * 'creditmemo'   => $creditmemo
    * 'comment'      => $comment
    * 'billing'      => $order->getBillingAddress()
    * 'payment_html' => $paymentBlockHtml
* Special:
    * The payment block is generated in the method using the store emulation
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()

### New Credit Memo for Guest

* Same as New Credit Memo, the method checks whether customer is guest by $order->getCustomerIsGuest()

### New Invoice

* Used in model sales/order_invoice in method sendEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'        => $order
    * 'invoice'      => $invoice
    * 'comment'      => $comment
    * 'billing'      => $order->getBillingAddress()
    * 'payment_html' => $paymentBlockHtml
* Special:
    * The payment block is generated in the method using the store emulation
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()

### New Invoice for Guest

* Same as New Invoice, the method checks whether customer is guest by $order->getCustomerIsGuest()

### New Order

* Used in model sales/order in method sendNewOrderEmail()
* Variables:
    * 'order'        => $order,
    * 'billing'      => $order->getBillingAddress(),
    * 'payment_html' => $paymentBlockHtml
* Special:
    * The payment block is generated in the method using the store emulation
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()


### New Order for Guest

* Same as New Order, the method checks whether customer is guest by $order->getCustomerIsGuest()

### New Shipment

* Used in model sales/order_shipment in method sendEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'        => $order
    * 'shipment'     => $shipment
    * 'comment'      => $comment
    * 'billing'      => $order->getBillingAddress()
    * 'payment_html' => $paymentBlockHtml
* Special:
    * The payment block is generated in the method using the store emulation
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()

### New Shipment for Guest

* Same as New Shipment, the method checks whether customer is guest by $order->getCustomerIsGuest()

### New account


### New account confirmation key


### New account confirmed


### Newsletter subscription confirmation


### Newsletter subscription success


### Newsletter unsubscription success


### Order Update

* Used in model sales/order in method sendOrderUpdateEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'        => $order
    * 'billing'      => $order->getBillingAddress()
    * 'payment_html' => $paymentBlockHtml
* Special:
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()

### Order Update for Guest

* Same as Order Update, the method checks whether customer is guest by $order->getCustomerIsGuest()


### Payment Failed


### Product alerts Cron error


### Product price alert


### Product stock alert


### Remind Password


### Send product to a friend


### Share Wishlist


### Shipment Update

* Used in model sales/order_shipment in method sendUpdateEmail($notifyCustomer = true, $comment = '')
* Variables:
    * 'order'    => $order
    * 'shipment' => $shipment
    * 'comment'  => $comment
    * 'billing'  => $order->getBillingAddress()
* Special:
    * In method, customer email address is retrieved from order: $order->getCustomerEmail()

### Shipment Update for Guest

* Same as Shipment Update, the method checks whether customer is guest by $order->getCustomerIsGuest()

### Sitemap generate Warnings


### Token Status Change

