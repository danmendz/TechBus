<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg p-8">
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 relative">
            <div class="w-full flex items-center">
                <div class="flex items-center relative">
                    <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 bg-teal-600 border-teal-600 text-white text-center font-bold step-circle"
                        data-step="1">1</div>
                    <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-sm font-medium text-teal-600">Personal
                    </div>
                </div>
                <div class="flex-auto border-t-2 border-teal-600"></div>
                <div class="flex items-center relative">
                    <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 text-center font-bold step-circle"
                        data-step="2">2</div>
                    <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-sm font-medium">Contact</div>
                </div>
                <div class="flex-auto border-t-2 border-gray-300"></div>
                <div class="flex items-center relative">
                    <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 text-center font-bold step-circle"
                        data-step="3">3</div>
                    <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-sm font-medium">Business</div>
                </div>
                <div class="flex-auto border-t-2 border-gray-300"></div>
                <div class="flex items-center relative">
                    <div class="rounded-full transition duration-500 ease-in-out h-12 w-12 py-3 border-2 border-gray-300 text-center font-bold step-circle"
                        data-step="4">4</div>
                    <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-sm font-medium">Confirm</div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <form id="step1" class="block">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                        <input type="date" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
            </form>

            <form id="step2" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500" rows="3"></textarea>
                    </div>
                </div>
            </form>

            <form id="step3" class="hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                        <input type="text" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Business Description</label>
                        <textarea required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-teal-500" rows="3"></textarea>
                    </div>
                </div>
            </form>

            <form id="step4" class="hidden">
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-900">Review Your Information</h3>
                        <p class="mt-2 text-sm text-gray-600">Please review all the information you've entered before
                            submitting.</p>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" required class="h-4 w-4 text-teal-600 border-gray-300 rounded">
                        <label class="ml-2 text-sm text-gray-700">I confirm that all the information provided is
                            correct</label>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-8 flex justify-between">
            <button id="prevBtn"
                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors"
                disabled>Previous</button>
            <button id="nextBtn"
                class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">Next</button>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        function updateButtons() {
            prevBtn.disabled = currentStep === 1;
            nextBtn.textContent = currentStep === totalSteps ? 'Submit' : 'Next';
        }

        function updateSteps() {
            for (let i = 1; i <= totalSteps; i++) {
                const form = document.getElementById(`step${i}`);
                form.classList.add('hidden');
                const circle = document.querySelector(`[data-step="${i}"]`);
                circle.classList.remove('bg-teal-600', 'text-white', 'border-teal-600');
                circle.classList.add('border-gray-300');
            }

            const currentForm = document.getElementById(`step${currentStep}`);
            currentForm.classList.remove('hidden');

            for (let i = 1; i <= currentStep; i++) {
                const circle = document.querySelector(`[data-step="${i}"]`);
                circle.classList.add('bg-teal-600', 'text-white', 'border-teal-600');
                circle.classList.remove('border-gray-300');
            }
        }

        function validateCurrentStep() {
            const currentForm = document.getElementById(`step${currentStep}`);
            const inputs = currentForm.querySelectorAll('input, select, textarea');
            let isValid = true;

            inputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value) {
                    isValid = false;
                    input.classList.add('border-red-500');
                } else {
                    input.classList.remove('border-red-500');
                }
            });

            return isValid;
        }

        prevBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateSteps();
                updateButtons();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    updateSteps();
                    updateButtons();
                } else {
                    alert('Form submitted successfully!');
                }
            }
        });

        updateButtons();
        updateSteps();
    </script>
</body>

</html>