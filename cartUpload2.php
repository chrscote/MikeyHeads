<form target="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">
<input type="hidden" name="business" value="mikeben07@yahoo.com">
        <!-- Begin First Item -->
<input type="hidden" name="quantity_1" value="1">
<input type="hidden" name="item_name_1" value="Item A">
<input type="hidden" name="item_number_1" value="Test SKU A">
<input type="hidden" name="amount_1" value="0.01">
<!--<input type="hidden" name="shipping_1" value="0.01">
<input type="hidden" name="tax_1" value="0.02">-->
        <!-- End First Item -->
        <!-- Begin Second Item -->
<input type="hidden" name="quantity_2" value="1">
<input type="hidden" name="item_name_2" value="Test Item B">
<input type="hidden" name="item_number_2" value="Test SKU B">
<input type="hidden" name="amount_2" value="0.02">
<!--<input type="hidden" name="shipping_2" value="0.02">
<input type="hidden" name="tax_2" value="0.02">-->
        <!-- End Second Item -->
        <!-- Begin Third Item -->
<input type="hidden" name="quantity_3" value="1">
<input type="hidden" name="item_name_3" value="Test Item C">
<input type="hidden" name="item_number_3" value="Test SKU C">
<input type="hidden" name="amount_3" value="0.03">
<!--<input type="hidden" name="shipping_3" value="0.03">
<input type="hidden" name="tax_3" value="0.03"> -->
        <!-- End Third Item -->
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="tax_cart" value="6.35">
<input type="hidden" name="handling_cart" value="1.95">
Upload <br>
<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_cart_SM.gif" border="0" name="upload" alt="Make payments with PayPal - it's fast, free and secure!" width="87" height="23">
</form>