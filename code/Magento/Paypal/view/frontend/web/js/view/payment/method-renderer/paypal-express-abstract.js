
    /** Gå direkt till Paypal function */
    continueToPayPal: function () {
        if (additionalValidators.validate()) {
            //update payment method information if additional data was changed
            this.selectPaymentMethod();
            setPaymentMethodAction(this.messageContainer);
            return false;
        }
    }
setPaymentMethodAction(this.messageContainer);