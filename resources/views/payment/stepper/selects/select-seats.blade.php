<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Theater Seat Selection</title>
</head>
<body>
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <h1 class="text-4xl font-bold text-white text-center mb-8">Select Your Seats</h1>
        
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <div class="flex justify-center gap-8 mb-6">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded bg-green-500"></div>
                    <span class="text-white">Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded bg-blue-500"></div>
                    <span class="text-white">Selected</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded bg-gray-500"></div>
                    <span class="text-white">Unavailable</span>
                </div>
            </div>

            <!-- Added Seat Counter -->
            <div class="text-center mb-6">
                <p class="text-white text-xl">Selected Seats: <span id="seatCounter" class="font-bold text-blue-500">0</span></p>
            </div>

            <div class="grid grid-cols-8 gap-4 max-w-2xl mx-auto" id="seatGrid">
                <button aria-label="Seat A1" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="A1"></button>
                <button aria-label="Seat A2" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="A2"></button>
                <button aria-label="Seat A3" class="seat w-10 h-10 rounded bg-gray-500 cursor-not-allowed" data-seat="A3"></button>
                <button aria-label="Seat A4" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="A4"></button>
                <button aria-label="Seat A5" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="A5"></button>
                <button aria-label="Seat A6" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="A6"></button>
                <button aria-label="Seat A7" class="seat w-10 h-10 rounded bg-gray-500 cursor-not-allowed" data-seat="A7"></button>
                <button aria-label="Seat A8" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="A8"></button>

                <button aria-label="Seat B1" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B1"></button>
                <button aria-label="Seat B2" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B2"></button>
                <button aria-label="Seat B3" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B3"></button>
                <button aria-label="Seat B4" class="seat w-10 h-10 rounded bg-gray-500 cursor-not-allowed" data-seat="B4"></button>
                <button aria-label="Seat B5" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B5"></button>
                <button aria-label="Seat B6" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B6"></button>
                <button aria-label="Seat B7" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B7"></button>
                <button aria-label="Seat B8" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="B8"></button>

                <button aria-label="Seat C1" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="C1"></button>
                <button aria-label="Seat C2" class="seat w-10 h-10 rounded bg-gray-500 cursor-not-allowed" data-seat="C2"></button>
                <button aria-label="Seat C3" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="C3"></button>
                <button aria-label="Seat C4" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="C4"></button>
                <button aria-label="Seat C5" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="C5"></button>
                <button aria-label="Seat C6" class="seat w-10 h-10 rounded bg-gray-500 cursor-not-allowed" data-seat="C6"></button>
                <button aria-label="Seat C7" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="C7"></button>
                <button aria-label="Seat C8" class="seat w-10 h-10 rounded bg-green-500 hover:bg-green-600 transition-colors cursor-pointer" data-seat="C8"></button>
            </div>
        </div>

        {{-- <div class="text-center">
            <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold" id="confirmBtn">Confirm Selection</button>
        </div> --}}
    </div>

    <script>
        let selectedSeatsCount = 0;
        const seatCounter = document.getElementById("seatCounter");

        document.querySelectorAll(".seat").forEach(seat => {
            if (!seat.classList.contains("cursor-not-allowed")) {
                seat.addEventListener("click", () => {
                    seat.classList.toggle("bg-green-500");
                    seat.classList.toggle("bg-blue-500");
                    seat.classList.toggle("hover:bg-green-600");
                    seat.classList.toggle("hover:bg-blue-600");

                    // Update counter
                    if (seat.classList.contains("bg-blue-500")) {
                        selectedSeatsCount++;
                    } else {
                        selectedSeatsCount--;
                    }
                    seatCounter.textContent = selectedSeatsCount;
                });
            }
        });

        document.getElementById("confirmBtn").addEventListener("click", () => {
            const selectedSeats = Array.from(document.querySelectorAll(".bg-blue-500")).map(seat => seat.dataset.seat);
            alert(`Selected seats: ${selectedSeats.join(", ")}`);
        });
    </script>
</body>
</html>