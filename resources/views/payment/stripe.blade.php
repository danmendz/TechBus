<!DOCTYPE html>
<html>
	<head>
		<title>Stripe payment</title>
	</head>
	<body>
		<h2>Datos recuperados: </h2>
		<br>
		{{-- <h3>Precio: $150</h3> --}}

		<form id="stripePaymentForm" action="{{ route('stripe')}}" method="POST">
			@csrf

			<input type="hidden" name="product_name" value="Boleto de autobús niño">
			<input type="hidden" name="quantity" value="1">
			<input type="hidden" name="price" value="230">
			{{-- <button type="submit">Pagar con Stripe</button> --}}
		</form>
	</body>
</html>
