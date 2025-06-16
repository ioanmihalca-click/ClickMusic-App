<x-app-layout>
    <div class="min-h-screen py-12 bg-black">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Gradient Background Effect -->
            <div class="relative">
                <div class="absolute inset-0 blur-3xl opacity-30">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800"></div>
                </div>

                <!-- Crop Avatar Content -->
                <div class="relative space-y-6">
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 rounded-xl blur opacity-30 group-hover:opacity-100 transition duration-1000 group-hover:duration-200 animate-gradient-xy">
                        </div>

                        <div class="relative p-6 bg-gray-900/90 backdrop-blur-sm rounded-xl">
                            <h2 class="mb-6 text-2xl font-bold text-white">Poziționează imaginea de profil</h2>

                            <div class="space-y-6">
                                <!-- Image Cropper Container -->
                                <div class="flex flex-col items-center space-y-6">
                                    <div id="image-cropper-container"
                                        class="w-full max-w-md overflow-hidden bg-gray-800 rounded-lg">
                                        <img id="image-to-crop" src="{{ $imageUrl }}" class="block max-w-full">
                                    </div>

                                    <!-- Crop Controls -->
                                    <div class="flex flex-wrap gap-3 mt-4">
                                        <button type="button" id="rotate-left"
                                            class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button type="button" id="rotate-right"
                                            class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M12.293 3.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 9H9a5 5 0 00-5 5v2a1 1 0 11-2 0v-2a7 7 0 017-7h5.586l-2.293-2.293a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button type="button" id="zoom-in"
                                            class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button type="button" id="zoom-out"
                                            class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                        <button type="button" id="reset"
                                            class="px-3 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                            Resetare
                                        </button>
                                    </div>

                                    <div class="w-full max-w-md mt-4">
                                        <p class="mb-2 text-sm text-gray-300">Previzualizare</p>
                                        <div
                                            class="w-24 h-24 mx-auto overflow-hidden border-2 border-blue-400 rounded-full">
                                            <img id="preview" src="{{ $imageUrl }}" class="w-full h-full">
                                        </div>
                                    </div>

                                    <form id="cropForm" action="{{ route('profile.avatar.crop.save') }}" method="POST"
                                        class="w-full max-w-md">
                                        @csrf
                                        <input type="hidden" name="croppedImage" id="croppedImage">
                                        <input type="hidden" name="tempImage" value="{{ $tempImage }}">

                                        <div class="flex justify-between mt-6 space-x-4">
                                            <a href="{{ route('profile.edit') }}"
                                                class="w-full px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 text-center">
                                                Anulează
                                            </a>
                                            <button type="submit" id="saveButton"
                                                class="w-full px-4 py-2 text-sm font-medium text-white transition-colors duration-150 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                Salvează
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Cropper.js from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize variables
            const image = document.getElementById('image-to-crop');
            const preview = document.getElementById('preview');
            const croppedImageInput = document.getElementById('croppedImage');
            const cropForm = document.getElementById('cropForm');
            let cropper;

            // Initialize cropper
            cropper = new Cropper(image, {
                aspectRatio: 1, // Square aspect ratio for avatar
                viewMode: 1, // Restrict the crop box to not exceed the size of the canvas
                dragMode: 'move', // Allow moving the image
                autoCropArea: 1, // Use the entire canvas
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
                ready: function() {
                    // Update preview on ready
                    updatePreview();
                },
                crop: function() {
                    // Update preview on crop
                    updatePreview();
                }
            });

            // Function to update preview
            function updatePreview() {
                const canvas = cropper.getCroppedCanvas({
                    width: 128,
                    height: 128,
                    fillColor: '#000',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                preview.src = canvas.toDataURL('image/png');
            }

            // Rotate left
            document.getElementById('rotate-left').addEventListener('click', function() {
                cropper.rotate(-90);
            });

            // Rotate right
            document.getElementById('rotate-right').addEventListener('click', function() {
                cropper.rotate(90);
            });

            // Zoom in
            document.getElementById('zoom-in').addEventListener('click', function() {
                cropper.zoom(0.1);
            });

            // Zoom out
            document.getElementById('zoom-out').addEventListener('click', function() {
                cropper.zoom(-0.1);
            });

            // Reset
            document.getElementById('reset').addEventListener('click', function() {
                cropper.reset();
            });

            // Form submit
            cropForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Get cropped canvas
                const canvas = cropper.getCroppedCanvas({
                    width: 512, // Output size
                    height: 512,
                    fillColor: '#fff',
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                if (canvas) {
                    // Convert canvas to base64 string
                    croppedImageInput.value = canvas.toDataURL('image/png');
                    this.submit();
                }
            });
        });
    </script>
</x-app-layout>
