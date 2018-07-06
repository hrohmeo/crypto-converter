(function($) {
	$( document ).ready(function() {
		setfiat();
		$("#crypto").keyup(function(){
			setfiat();
			});
		 $("#fiat").keyup(function(){
			setcrypto();
		});
		
		function setfiat()
		{
			var cryptos = $("#crypto").val().replace(",", ".");
			var fiat = cryptos*crypto_rate;
			$("#fiat").val(fiat.toFixed(2));
		}
		function setcrypto(fromunit) 
		{
			var fiat = $("#fiat").val().replace(",", ".");
			var cryptos = (fiat/crypto_rate);
			$("#crypto").val(cryptos.toFixed(6));
		}
		
	}); 
})(jQuery);