<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Sign In'; ?> - Notes App</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700 flex items-center justify-center p-4">
    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Success!</h3>
                <p class="text-gray-600 mb-6" id="successMessage">You are now logged in</p>
                <button onclick="closeSuccessModal()" class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                    Continue
                </button>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div id="errorModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Login Failed</h3>
                <p class="text-gray-600 mb-6" id="errorMessage">Invalid username or password</p>
                <button onclick="closeErrorModal()" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                    Try Again
                </button>
            </div>
        </div>
    </div>

    <!-- Login Card -->
    <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 overflow-hidden w-full max-w-md">
        <!-- Header -->
        <div class="relative bg-gradient-to-r from-blue-500 via-purple-600 to-indigo-700 text-white p-8 md:p-12 text-center">
            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="1" fill="currentColor"/>
                    <circle cx="20" cy="30" r="1" fill="currentColor"/>
                    <circle cx="80" cy="70" r="1" fill="currentColor"/>
                    <circle cx="30" cy="80" r="1" fill="currentColor"/>
                    <circle cx="70" cy="20" r="1" fill="currentColor"/>
                </svg>
            </div>

            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 drop-shadow-lg">Welcome Back</h1>
                <p class="text-white/90 text-lg">Sign in to your account</p>
            </div>
        </div>

        <!-- Form -->
        <div class="p-8 md:p-12">
            <!-- Validation Errors -->
            <?php if(validation_errors()): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div><?php echo validation_errors(); ?></div>
                </div>
            <?php endif; ?>

            <form action="<?php echo site_url('users/login'); ?>" method="post" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <input type="text" id="username" name="username" required
                               class="w-full px-4 py-3 pl-12 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Enter your username"
                               value="<?php echo set_value('username'); ?>">
                        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 pl-12 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                               placeholder="Enter your password">
                        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Sign In
                </button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-8">
                <p class="text-gray-600">Don't have an account?
                    <a href="<?php echo site_url('users/register'); ?>" class="text-blue-600 hover:text-blue-700 font-semibold transition-colors duration-200">Sign up here</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function closeSuccessModal() {
            document.getElementById('successModal').classList.add('hidden');
            window.location.href = '<?php echo site_url('notes'); ?>';
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.add('hidden');
        }

        // Show modals based on flash data
        <?php if($this->session->flashdata('user_loggedin')): ?>
            document.getElementById('successMessage').textContent = '<?php echo $this->session->flashdata('user_loggedin'); ?>';
            document.getElementById('successModal').classList.remove('hidden');
        <?php endif; ?>

        <?php if($this->session->flashdata('login_failed')): ?>
            document.getElementById('errorMessage').textContent = '<?php echo $this->session->flashdata('login_failed'); ?>';
            document.getElementById('errorModal').classList.remove('hidden');
        <?php endif; ?>

        // Close modals on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSuccessModal();
                closeErrorModal();
            }
        });

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'successModal') {
                closeSuccessModal();
            }
            if (e.target.id === 'errorModal') {
                closeErrorModal();
            }
        });

        // Auto-focus username field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
    </script>
</body>
</html>
