Hackathon EmailPreview
======================
This extension enables the merchants and developers to preview mail templates from the backend with real data.

Facts
-----
- version: 1.0.0
- extension key: Hackathon_EmailPreview
- [extension on GitHub](https://github.com/magento-hackathon/E-MailPreview)

Description
-----------
This extension enables the merchants and developers to preview mail templates from the backend with real data.

Extending
---------

### Extending existing mail templates
If you introduce new variables into existing mail templates, you have to provide Magento with actual models (ie. orders, customers, ...). 

You can do so by observing the `hackathon_emailpreview_render_email_before` event. You will be provided with:

* `templateType`. Use the template type to decide if you have to modify the parameters for this type of template.
* `templateParams`. This `Varien_Object` contains the parameters (ie. variables like orders, customers, ...) that will be passed to the mail template renderer.

Adding a customer with real data as a template parameter looks like this:

    $templateParams = $observer->getEvent()->getData('templateParams');
    $requestParams = $templateParams->getRequestParams();
    $customerId = $requestParams['customerId'];
    $customer = Mage::getModel('customer/customer')->load($customerId);
    $templateParams->setCustomer($customer);

Requirements
------------
- PHP >= 5.2.0
- Mage_Adminhtml

Compatibility
-------------
- Magento CE >= 1.7.0.2 (only tested on this version)

Installation Instructions
-------------------------
1. Install the extension by copying the files into your Magento root or by using a modman compatible tool ([modman](https://github.com/colinmollenhour/modman), [Composer](http://getcomposer.org/)).
2. Clear the cache, logout from the admin panel and then login again.

Uninstallation
--------------
1. Remove the extension by removing the files.

Roadmap
-------
* Give hints which parameters are needed / data is needed for the selected preview type
  (hide non-needed elements and/or parse template code to find used variables?)
* Check if a valid customer id, increment id etc. is provided

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/magento-hackathon/E-MailPreview/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).

Developer
---------
Matthias Zeis 
[http://www.matthias-zeis.com](http://www.matthias-zeis.com)  
[@mzeis](https://twitter.com/mzeis)

Marc Päpper
[http://www.lemundo.de](http://www.lemundo.de)
[@mpaepper](https://twitter.com/mpaepper)

Tobias Hille

License
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)
