# Research

Research notes for the implementation of this extension.

## E-mail templates

### Contact Form


### Credit Memo Update


### Credit Memo Update for Guest


### Currency Update Warnings


### Forgot Admin Password


### Forgot Password
* Template file: account_password_reset_confirmation.html
* Template type: html

### Invoice Update


### Invoice Update for Guest


### Log cleanup Warnings


### Moneybookers activate email


### New Credit Memo


### New Credit Memo for Guest


### New Invoice


### New Invoice for Guest


### New Order


### New Order for Guest


### New Shipment


### New Shipment for Guest


### New account
* Template file: account_new.html
* Template type: html
* Method: Mage_Customer_Model_Customer::sendNewAccountEmail()
* Template params:
  - customer (Mage_Customer_Model_Customer)
  - backUrl (String, default '')
Shouldn't be a problem, just provide the customer object.  

### New account confirmation key
* Template file: account_new_confirmation.html
* Template type: html
* Method: Mage_Customer_Model_Customer::sendNewAccountEmail()
* Template params:
  - customer (Mage_Customer_Model_Customer)
  - backUrl (String, default '')
Shouldn't be a problem, just provide the customer object.  

### New account confirmed
* Template file: account_new_confirmed.html
* Template type: html
* Method: Mage_Customer_Model_Customer::sendNewAccountEmail()
* Template params:
  - customer (Mage_Customer_Model_Customer)
  - backUrl (String, default '')
Shouldn't be a problem, just provide the customer object.  

### Newsletter subscription confirmation


### Newsletter subscription success


### Newsletter unsubscription success


### Order Update


### Order Update for Guest


### Payment Failed


### Product alerts Cron error


### Product price alert


### Product stock alert


### Remind Password
* Template file: password_new.html
* Template type: html

### Send product to a friend


### Share Wishlist


### Shipment Update


### Shipment Update for Guest


### Sitemap generate Warnings


### Token Status Change

