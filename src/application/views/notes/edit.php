<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Edit Note'; ?> - Notes App</title>
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
            <span>Edit Note</span>
        </div>
        
        <!-- Header -->
        <div class="text-center mb-8 md:mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 drop-shadow-lg flex items-center justify-center gap-3">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                Edit Note
            </h1>
            <p class="text-lg md:text-xl text-white/90">Update your thoughts and ideas</p>
        </div>
        
        <!-- Form Container -->
        <div class="bg-white/95 backdrop-blur-md rounded-2xl p-6 md:p-8 shadow-2xl border border-white/20">
            <!-- Info Tip -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <strong class="text-blue-900">Editing Mode:</strong> Make your changes below. Don't worry about losing your work - we'll auto-save your progress.
                    </div>
                </div>
            </div>
            
            <!-- Changes Indicator -->
            <div class="hidden bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 p-4 mb-6 rounded-r-lg" id="changesIndicator">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <strong class="text-amber-900">Changes detected!</strong> Your modifications will be saved when you click "Update Note".
                    </div>
                </div>
            </div>
            
            <!-- Last Modified Info -->
            <?php if(isset($note) && isset($note['created_at'])): ?>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2 text-gray-600">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="font-medium">Created:</span> <?php echo date('F j, Y \a\t g:i A', strtotime($note['created_at'])); ?>
                        <?php if(isset($note['updated_at'])): ?>
                            <span class="mx-2">|</span>
                            <span class="font-medium">Last modified:</span> <?php echo date('F j, Y \a\t g:i A', strtotime($note['updated_at'])); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php echo form_open('notes/edit/' . (isset($note) ? $note['id'] : ''), array('id' => 'noteForm')); ?>
                <!-- Title Field -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Note Title <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="<?php echo isset($note) ? htmlspecialchars($note['title']) : ''; ?>" 
                        placeholder="Enter a descriptive title for your note..."
                        maxlength="200"
                        required
                        class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all duration-200 text-gray-800 placeholder-gray-400"
                    >
                    <div class="text-right text-sm text-gray-500 mt-1">
                        <span id="titleCounter"><?php echo isset($note) ? strlen($note['title']) : '0'; ?></span>/200 characters
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
                    ><?php echo isset($note) ? htmlspecialchars($note['content']) : ''; ?></textarea>
                    <div class="text-right text-sm text-gray-500 mt-1">
                        <span id="contentCounter"><?php echo isset($note) ? strlen($note['content']) : '0'; ?></span>/5000 characters
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-between pt-6 border-t border-gray-200">
                    <button type="button" 
                            onclick="openDeleteModal()" 
                            class="inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Delete Note
                    </button>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo site_url('notes'); ?>" 
                           class="inline-flex items-center justify-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                            </svg>
                            Back to Notes
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" 
                                id="submitBtn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Update Note
                        </button>
                    </div>
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
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Delete Note</h3>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this note? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button onclick="closeDeleteModal()" 
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                        Cancel
                    </button>
                    <a href="<?php echo site_url('notes/delete/' . (isset($note) ? $note['id'] : '')); ?>" 
                       class="flex-1 bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 text-center">
                        Delete
                    </a>
                </div>
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
                <p class="text-gray-600 mb-6">We found unsaved changes from your previous session. Would you like to restore them?</p>
                <div class="flex gap-3">
                    <button onclick="closeDraftModal()" 
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                        No, keep current
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
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('noteForm');
            const changesIndicator = document.getElementById('changesIndicator');
            
            // Store original values to detect changes
            const originalTitle = titleInput.value;
            const originalContent = contentTextarea.value;
            
            // Character counters and change detection
            titleInput.addEventListener('input', function() {
                titleCounter.textContent = this.value.length;
                validateForm();
                detectChanges();
            });
            
            contentTextarea.addEventListener('input', function() {
                contentCounter.textContent = this.value.length;
                validateForm();
                detectChanges();
            });
            
            // Change detection
            function detectChanges() {
                const hasChanges = titleInput.value !== originalTitle || 
                                 contentTextarea.value !== originalContent;
                
                if (hasChanges) {
                    changesIndicator.classList.remove('hidden');
                    submitBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> Save Changes';
                } else {
                    changesIndicator.classList.add('hidden');
                    submitBtn.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg> Update Note';
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
            
            function openDeleteModal() {
                document.getElementById('deleteModal').classList.remove('hidden');
                document.getElementById('deleteModal').classList.add('flex');
            }
            
            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
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
                const draft = JSON.parse(localStorage.getItem('note_edit_draft'));
                titleInput.value = draft.title;
                contentTextarea.value = draft.content;
                validateForm();
                detectChanges();
                closeDraftModal();
            }
            
            // Close modals when clicking outside
            document.getElementById('validationModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeValidationModal();
                }
            });
            
            document.getElementById('deleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteModal();
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
                
                submitBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/></svg> Updating...';
                submitBtn.disabled = true;
            });
            
            // Auto-save to localStorage (draft functionality)
            function saveDraft() {
                if (titleInput.value !== originalTitle || contentTextarea.value !== originalContent) {
                    const draft = {
                        title: titleInput.value,
                        content: contentTextarea.value,
                        timestamp: Date.now(),
                        noteId: <?php echo isset($note) ? $note['id'] : 'null'; ?>
                    };
                    localStorage.setItem('note_edit_draft', JSON.stringify(draft));
                }
            }
            
            function loadDraft() {
                const draft = localStorage.getItem('note_edit_draft');
                if (draft) {
                    const parsedDraft = JSON.parse(draft);
                    const currentNoteId = <?php echo isset($note) ? $note['id'] : 'null'; ?>;
                    
                    // Only load if draft is for current note and less than 1 hour old
                    if (parsedDraft.noteId === currentNoteId && 
                        Date.now() - parsedDraft.timestamp < 60 * 60 * 1000) {
                        openDraftModal();
                    }
                    localStorage.removeItem('note_edit_draft');
                }
            }
            
            // Save draft every 30 seconds
            setInterval(saveDraft, 30000);
            
            // Load draft on page load
            loadDraft();
            
            // Clear draft on successful submission
            form.addEventListener('submit', function() {
                localStorage.removeItem('note_edit_draft');
            });
            
            // Warn user about unsaved changes
            window.addEventListener('beforeunload', function(e) {
                if (titleInput.value !== originalTitle || contentTextarea.value !== originalContent) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl+S or Cmd+S to save
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    if (!submitBtn.disabled) {
                        form.submit();
                    }
                }
            });
            
            // Initial setup
            validateForm();
            detectChanges();
        });
    </script>
</body>
</html>