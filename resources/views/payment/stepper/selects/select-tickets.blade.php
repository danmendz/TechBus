<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Ticket Types</title>
</head>
<body>
    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-12 text-gray-800">Choose Your Ticket Type</h1>
        
        <div class="flex justify-center gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden w-36 relative">
                <div class="p-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800 mb-2 flex justify-between items-center">
                        Standard Ticket
                        <!-- Botón para abrir el modal -->
                        <label onclick="openModal('standard-modal')" class="text-blue-500 hover:text-blue-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </label>
                    </h2>
                    <div class="flex justify-center text-xl font-bold text-blue-600 mb-4">$20</div>
                    <div class="flex items-center justify-between space-x-2">
                        <button onclick="decreaseCounter('standard')" class="bg-blue-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-blue-600 transition-colors duration-200">-</button>
                        <span id="standard-counter" class="text-lg font-bold text-gray-700">0</span>
                        <button onclick="increaseCounter('standard')" class="bg-blue-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-blue-600 transition-colors duration-200">+</button>
                    </div>
                </div>
            </div>       

            <!-- Modal -->
            <div id="standard-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Standard Ticket</h2>
                    <p class="text-sm text-gray-600 mb-4">Affordable option for regular travelers. Perfect for budget-conscious passengers looking for quality and value.</p>
                    <button onclick="closeModal('standard-modal')" class="bg-blue-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-blue-600 transition-colors duration-200 w-full">
                        Close
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden w-36 relative">
                <div class="p-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800 mb-2 flex justify-between items-center">
                        Flexible Ticket
                        <!-- Botón para abrir el modal -->
                        <label onclick="openModal('flexible-modal')" class="text-green-500 hover:text-green-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </label>
                    </h2>
                    <div class="flex justify-center text-xl font-bold text-green-600 mb-4">$35</div>
                    <div class="flex items-center justify-between space-x-2">
                        <button onclick="decreaseCounter('flexible')" class="bg-green-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-green-600 transition-colors duration-200">-</button>
                        <span id="flexible-counter" class="text-lg font-bold text-gray-700">0</span>
                        <button onclick="increaseCounter('flexible')" class="bg-green-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-green-600 transition-colors duration-200">+</button>
                    </div>
                </div>
            </div>    

            <!-- Modal -->
            <div id="flexible-modal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center hidden peer-checked:flex z-50">
                <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Flexible Ticket</h2>
                    <p class="text-sm text-gray-600 mb-4">Change your travel date anytime without any extra fees. Ideal for travelers with uncertain plans.</p>
                    <button onclick="closeModal('flexible-modal')" class="bg-green-500 text-white py-2 px-4 rounded-lg font-semibold hover:bg-green-600 transition-colors duration-200 w-full text-center cursor-pointer">
                        Close
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden w-36 relative">
                <div class="p-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800 mb-2 flex justify-between items-center">
                        Premium Ticket
                        <!-- Botón para abrir el modal -->
                        <label for="premium-modal-checkbox" class="text-purple-500 hover:text-purple-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </label>
                    </h2>
                    <div class="flex justify-center text-xl font-bold text-purple-600 mb-4">$60</div>
                    <div class="flex items-center justify-between space-x-2">
                        <button onclick="decreaseCounter('premium')" class="bg-purple-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-purple-600 transition-colors duration-200">-</button>
                        <span id="premium-counter" class="text-lg font-bold text-gray-700">0</span>
                        <button onclick="increaseCounter('premium')" class="bg-purple-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-purple-600 transition-colors duration-200">+</button>
                    </div>
                </div>
            </div>      

            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden w-36 relative">
                <div class="p-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-800 mb-2 flex justify-between items-center">
                        Family Ticket
                        <!-- Botón para abrir el modal -->
                        <label for="family-modal-checkbox" class="text-red-500 hover:text-red-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </label>
                    </h2>
                    <div class="flex justify-center text-xl font-bold text-red-600 mb-4">$80</div>
                    <div class="flex items-center justify-between space-x-2">
                        <button onclick="decreaseCounter('family')" class="bg-red-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-red-600 transition-colors duration-200">-</button>
                        <span id="family-counter" class="text-lg font-bold text-gray-700">0</span>
                        <button onclick="increaseCounter('family')" class="bg-red-500 text-white py-2 px-3 rounded-lg text-sm font-semibold hover:bg-red-600 transition-colors duration-200">+</button>
                    </div>
                </div>
            </div>
            
        </div>
        {{-- <div class="flex justify-center">
            <button onclick="purchaseTickets()" class="bg-indigo-600 text-white py-3 px-8 rounded-lg font-semibold hover:bg-indigo-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Purchase Tickets</button>
        </div> --}}
    </div>

    <script>
        const counters = {
            standard: 0,
            flexible: 0,
            premium: 0,
            family: 0
        };

        function increaseCounter(type) {
            counters[type]++;
            document.getElementById(`${type}-counter`).textContent = counters[type];
        }

        function decreaseCounter(type) {
            if (counters[type] > 0) {
                counters[type]--;
                document.getElementById(`${type}-counter`).textContent = counters[type];
            }
        }

        function purchaseTickets() {
            const total = Object.values(counters).reduce((sum, count) => sum + count, 0);
            if (total > 0) {
                alert(`Successfully purchased ${total} tickets!`);
                Object.keys(counters).forEach(type => {
                    counters[type] = 0;
                    document.getElementById(`${type}-counter`).textContent = "0";
                });
            } else {
                alert("Please select at least one ticket!");
            }
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>