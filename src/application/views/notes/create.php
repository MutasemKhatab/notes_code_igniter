<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Notes App</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700 p-4 md:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6 text-white flex items-center gap-2 text-lg">
            <a href="<?php echo site_url('notes'); ?>" class="hover:text-blue-200 transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Notes
            </a>
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span>Create New Note</span>
        </div>
        
        <!-- Header -->
        <div class="text-center mb-8 md:mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 drop-shadow-lg flex items-center justify-center gap-3">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                <?php echo $title; ?>
            </h1>
            <p class="text-lg md:text-xl text-white/90">Capture your thoughts and ideas</p>
        </div>
        
        <!-- Form Container -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-6 md:p-8 shadow-2xl border border-white/20">
            <!-- Tip -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    <div>
                        <strong class="text-blue-900">Tip:</strong> Give your note a descriptive title and write freely in the content area. Your note will be saved with today's date.
                    </div>
                </div>
            </div>
            
            <?php echo form_open('notes/create', array('id' => 'noteForm')); ?>
                <!-- Title Field -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Note Title <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        placeholder="Enter a descriptive title for your note..."
                        maxlength="200"
                        required
                        class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 placeholder-gray-400"
                    >
                    <div class="text-right text-sm text-gray-500 mt-1">
                        <span id="titleCounter">0</span>/200 characters
                    </div>
                </div>
                
                <!-- Content Field -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Note Content <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="content" 
                        name="content" 
                        placeholder="Write your note content here... You can include ideas, reminders, thoughts, or anything you'd like to remember."
                        maxlength="5000"
                        required
                        class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 placeholder-gray-400 resize-vertical min-h-48"
                    ></textarea>
                    <div class="text-right text-sm text-gray-500 mt-1">
                        <span id="contentCounter">0</span>/5000 characters
                    </div>
                </div>
                
                <!-- Preview Section -->
                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-4 mb-6">
                    <div class="flex items-center gap-2 mb-3">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-semibold text-gray-700">Preview</span>
                    </div>
                    <div class="text-gray-600 italic min-h-16" id="previewContent">
                        Start typing to see a preview of your note...
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end pt-6 border-t border-gray-200">
                    <a href="<?php echo site_url('notes'); ?>" 
                       class="inline-flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" 
                            id="submitBtn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Save Note
                    </button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    
    <!-- Validation Modal -->
    <div id="validationModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Validation Error</h3>
                <p class="text-gray-600 mb-6" id="validationMessage">Please fill in both title and content fields.</p>
                <button onclick="closeValidationModal()" 
                        class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                    OK
                </button>
            </div>
        </div>
    </div>
    
    <!-- Draft Modal -->
    <div id="draftModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Draft Found</h3>
                <p class="text-gray-600 mb-6">We found a draft from your previous session. Would you like to restore it?</p>
                <div class="flex gap-3">
                    <button onclick="closeDraftModal()" 
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                        No, start fresh
                    </button>
                    <button onclick="restoreDraft()" 
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                        Yes, restore
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const contentTextarea = document.getElementById('content');
            const titleCounter = document.getElementById('titleCounter');
            const contentCounter = document.getElementById('contentCounter');
            const previewContent = document.getElementById('previewContent');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('noteForm');
            
            // Character counters
            titleInput.addEventListener('input', function() {
                titleCounter.textContent = this.value.length;
                updatePreview();
                validateForm();
            });
            
            contentTextarea.addEventListener('input', function() {
                contentCounter.textContent = this.value.length;
                updatePreview();
                validateForm();
            });
            
            // Preview functionality
            function updatePreview() {
                const title = titleInput.value.trim();
                const content = contentTextarea.value.trim();
                
                if (title || content) {
                    let preview = '';
                    if (title) {
                        preview += `<strong>${title}</strong><br><br>`;
                    }
                    if (content) {
                        preview += content.substring(0, 300);
                        if (content.length > 300) {
                            preview += '...';
                        }
                    }
                    previewContent.innerHTML = preview;
                } else {
                    previewContent.innerHTML = 'Start typing to see a preview of your note...';
                }
            }
            
            // Form validation
            function validateForm() {
                const isValid = titleInput.value.trim().length > 0 && 
                               contentTextarea.value.trim().length > 0;
                submitBtn.disabled = !isValid;
            }
            
            // Modal functions
            function openValidationModal(message) {
                document.getElementById('validationMessage').textContent = message;
                document.getElementById('validationModal').classList.remove('hidden');
                document.getElementById('validationModal').classList.add('flex');
            }
            
            function closeValidationModal() {
                document.getElementById('validationModal').classList.add('hidden');
                document.getElementById('validationModal').classList.remove('flex');
            }
            
            function openDraftModal() {
                document.getElementById('draftModal').classList.remove('hidden');
                document.getElementById('draftModal').classList.add('flex');
            }
            
            function closeDraftModal() {
                document.getElementById('draftModal').classList.add('hidden');
                document.getElementById('draftModal').classList.remove('flex');
            }
            
            function restoreDraft() {
                const draft = JSON.parse(localStorage.getItem('note_draft'));
                titleInput.value = draft.title;
                contentTextarea.value = draft.content;
                updatePreview();
                validateForm();
                closeDraftModal();
            }
            
            // Close modals when clicking outside
            document.getElementById('validationModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeValidationModal();
                }
            });
            
            document.getElementById('draftModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDraftModal();
                }
            });
            
            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                if (!titleInput.value.trim() || !contentTextarea.value.trim()) {
                    e.preventDefault();
                    openValidationModal('Please fill in both title and content fields.');
                    return;
                }
                
                submitBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> Saving...';
                submitBtn.disabled = true;
            });
            
            // Auto-save to localStorage (draft functionality)
            function saveDraft() {
                const draft = {
                    title: titleInput.value,
                    content: contentTextarea.value,
                    timestamp: Date.now()
                };
                localStorage.setItem('note_draft', JSON.stringify(draft));
            }
            
            function loadDraft() {
                const draft = localStorage.getItem('note_draft');
                if (draft) {
                    const parsedDraft = JSON.parse(draft);
                    // Only load if draft is less than 24 hours old
                    if (Date.now() - parsedDraft.timestamp < 24 * 60 * 60 * 1000) {
                        openDraftModal();
                    }
                    localStorage.removeItem('note_draft');
                }
            }
            
            // Save draft every 30 seconds
            setInterval(saveDraft, 30000);
            
            // Load draft on page load
            loadDraft();
            
            // Clear draft on successful submission
            form.addEventListener('submit', function() {
                localStorage.removeItem('note_draft');
            });
            
            // Initial validation
            validateForm();
        });
    </script>
</body>
</html>