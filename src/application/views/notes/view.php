<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($note) ? htmlspecialchars($note['title']) : 'View Note'; ?> - Notes App</title>
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
            <span>View Note</span>
        </div>

        <?php if(isset($note)): ?>
            <!-- Note Container -->
            <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
                <!-- Note Header -->
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
                        <h1 class="text-3xl md:text-4xl font-bold mb-4 drop-shadow-lg"><?php echo htmlspecialchars($note['title']); ?></h1>

                        <!-- Meta Information -->
                        <div class="flex flex-wrap justify-center gap-6 text-white/90">
                            <?php if(isset($note['created_at'])): ?>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Created <?php echo date('M j, Y \a\t g:i A', strtotime($note['created_at'])); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($note['updated_at'])): ?>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Updated <?php echo date('M j, Y \a\t g:i A', strtotime($note['updated_at'])); ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span><?php echo str_word_count($note['content']); ?> words</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="absolute top-4 right-4 flex gap-2">
                        <button onclick="shareNote()"
                                class="p-3 bg-white/20 hover:bg-white/30 rounded-full transition-colors duration-200"
                                title="Share Note">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                            </svg>
                        </button>
                        <button onclick="copyToClipboard()"
                                class="p-3 bg-white/20 hover:bg-white/30 rounded-full transition-colors duration-200"
                                title="Copy to Clipboard">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"/>
                                <path d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2 3 3 0 01-3 3H9a3 3 0 01-3-3z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Note Content -->
                <div class="p-8 md:p-12">
                    <div class="bg-gray-50 border-l-4 border-blue-500 p-6 md:p-8 rounded-r-lg shadow-inner">
                        <div class="text-gray-800 leading-relaxed whitespace-pre-wrap text-lg">
                            <?php echo nl2br(htmlspecialchars($note['content'])); ?>
                        </div>
                    </div>

                    <!-- Reading Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl text-center border border-blue-100">
                            <div class="text-3xl font-bold text-blue-600 mb-2"><?php echo strlen($note['content']); ?></div>
                            <div class="text-sm text-blue-600 uppercase tracking-wide font-semibold">Characters</div>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-xl text-center border border-green-100">
                            <div class="text-3xl font-bold text-green-600 mb-2"><?php echo str_word_count($note['content']); ?></div>
                            <div class="text-sm text-green-600 uppercase tracking-wide font-semibold">Words</div>
                        </div>
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-xl text-center border border-purple-100">
                            <div class="text-3xl font-bold text-purple-600 mb-2"><?php echo substr_count($note['content'], "\n") + 1; ?></div>
                            <div class="text-sm text-purple-600 uppercase tracking-wide font-semibold">Paragraphs</div>
                        </div>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 p-6 md:p-8 bg-gray-50 border-t border-gray-200">
                    <a href="<?php echo site_url('notes'); ?>"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                        </svg>
                        Back to Notes
                    </a>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="<?php echo site_url('notes/edit/' . $note['id']); ?>"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            Edit Note
                        </a>
                        <button onclick="openDeleteModal()"
                                class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Delete Note
                        </button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Note not found -->
            <div class="bg-white/95 backdrop-blur-md rounded-2xl p-8 md:p-12 text-center shadow-2xl border border-white/20">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Note Not Found</h2>
                <p class="text-gray-600 mb-6">The note you're looking for doesn't exist or has been deleted.</p>
                <a href="<?php echo site_url('notes'); ?>"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Back to Notes
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Clipboard Success Modal -->
    <div id="clipboardModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Copied!</h3>
                <p class="text-gray-600 mb-6">Note details have been copied to your clipboard.</p>
                <button onclick="closeClipboardModal()"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
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

    <script>
        // Modal functions
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function closeClipboardModal() {
            document.getElementById('clipboardModal').classList.add('hidden');
        }

        // Copy to clipboard functionality
        async function copyToClipboard() {
            try {
                const noteTitle = <?php echo json_encode(isset($note) ? $note['title'] : ''); ?>;
                const noteContent = <?php echo json_encode(isset($note) ? $note['content'] : ''); ?>;
                const shareText = `${noteTitle}\n\n${noteContent}\n\nView at: ${window.location.href}`;

                await navigator.clipboard.writeText(shareText);
                document.getElementById('clipboardModal').classList.remove('hidden');
            } catch (err) {
                console.error('Failed to copy: ', err);
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = shareText;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                document.getElementById('clipboardModal').classList.remove('hidden');
            }
        }

        // Share functionality
        function shareNote() {
            const noteTitle = <?php echo json_encode(isset($note) ? $note['title'] : ''); ?>;
            const noteContent = <?php echo json_encode(isset($note) ? substr($note['content'], 0, 100) . '...' : ''); ?>;
            const noteUrl = window.location.href;

            if (navigator.share) {
                navigator.share({
                    title: noteTitle,
                    text: noteContent,
                    url: noteUrl
                }).catch(console.error);
            } else {
                copyToClipboard();
            }
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // E key to edit
            if (e.key === 'e' && !e.ctrlKey && !e.metaKey && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
                <?php if(isset($note)): ?>
                    window.location.href = '<?php echo site_url('notes/edit/' . $note['id']); ?>';
                <?php endif; ?>
            }

            // Backspace to go back
            if (e.key === 'Backspace' && !e.ctrlKey && !e.metaKey && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
                window.location.href = '<?php echo site_url('notes'); ?>';
            }

            // Escape to close modals
            if (e.key === 'Escape') {
                closeDeleteModal();
                closeClipboardModal();
            }
        });

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'deleteModal') {
                closeDeleteModal();
            }
            if (e.target.id === 'clipboardModal') {
                closeClipboardModal();
            }
        });
    </script>
</body>
</html>