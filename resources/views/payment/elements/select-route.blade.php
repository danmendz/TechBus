<!-- Buttons -->
<div class="p-4 border border-gray-300 rounded-lg bg-white shadow-lg bg-cover bg-center backdrop-blur-lg text-black z-0">
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		<!-- Origen -->
		<div>
			<label for="origen" class="block text-sm font-medium mb-2">Origen</label>
			<select id="origen"
				class="w-full h-10 px-3 border border-gray-400 rounded-md bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
				<option value="">Seleccionar</option>
				<option value="1">Puebla</option>
				<option value="2">CAPU</option>
			</select>
		</div>
		<!-- Destino -->
		<div>
			<label for="destino" class="block text-sm font-medium mb-2">Destino</label>
			<select id="destino"
				class="w-full h-10 px-3 border border-gray-400 rounded-md bg-white text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
				<option value="">Seleccionar</option>
				<option value="A">San Martín</option>
				<option value="B">CDMX</option>
			</select>
		</div>
		<!-- Botón -->
		<div class="flex items-end">
			<button type="button"
				class="w-full h-10 flex justify-center items-center px-4 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
				Buscar viaje
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
					stroke-width="1.5" stroke="currentColor" class="ml-2 w-5 h-5">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
				</svg>
			</button>
		</div>
	</div>

	<div class="mt-6">
		<!-- Primer div hijo -->
		<div class="p-2 border border-gray-300 rounded-md bg-gray-50 shadow-md flex items-center justify-center"
			style="height: calc(2.5rem + 2px); margin: 0.5rem;">
			<div class="inline-flex justify-evenly items-center space-x-4 rounded-lg bg-gray-50">
				<h1 class="text-lg font-bold text-gray-800">Puebla - Ciudad de México</h1>
				<h2 class="text-md font-medium text-gray-600">Primera clase</h2>
				<h2 class="text-md font-medium text-gray-600">10:45 h</h2>
			</div>			
		</div>

		<!-- Segundo div hijo -->
		<div class="p-2 border border-gray-300 rounded-md bg-gray-50 shadow-md flex items-center justify-center"
			style="height: calc(2.5rem + 2px); margin: 0.5rem;">
			<div class="inline-flex justify-evenly items-center space-x-4 rounded-lg bg-gray-50">
				<h1 class="text-lg font-bold text-gray-800">CAPU - Ciudad de México</h1>
				<h2 class="text-md font-medium text-gray-600">Económico</h2>
				<h2 class="text-md font-medium text-gray-600">5:45 h</h2>
			</div>	
		</div>
	</div>
</div>
<!-- End Buttons -->