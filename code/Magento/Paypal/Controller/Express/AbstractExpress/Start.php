<?php
/**
 * Start Express Checkout by requesting initial token and dispatching customer to PayPal
 *
 * @return void
 * @SuppressWarnings(PHPMD.CyclomaticComplexity)
 */
public function execute(


    $url = $this->_checkout->getRedirectUrl();
    if ($token && $url) {
        $this->_initToken($token);
        $this->getResponse()->setRedirect($url);
        return;
    }
);