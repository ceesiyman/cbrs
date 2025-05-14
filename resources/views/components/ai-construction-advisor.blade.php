<!-- AI Construction Advisor Component -->
<style>
    .ai-advisor-section {
        background-color: #f9fafb;
        padding: 4rem 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .ai-container {
        max-width: 1024px;
        margin: 0 auto;
    }

    .ai-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .ai-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .ai-subtitle {
        font-size: 1.1rem;
        color: #4b5563;
    }

    .ai-chat-container {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .ai-chat-body {
        min-height: 250px;
        max-height: 400px;
        overflow-y: auto;
        padding: 1.5rem;
    }

    .ai-response {
        background-color: #f3f4f6;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        color: #1f2937;
    }

    .ai-chat-input {
        display: flex;
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background-color: #f9fafb;
    }

    .ai-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.95rem;
    }

    .ai-submit {
        padding: 0.75rem 1.25rem;
        margin-left: 0.75rem;
        background-color: #2563eb;
        color: white;
        border: none;
        border-radius: 0.375rem;
        font-weight: 500;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .ai-submit:hover {
        background-color: #1d4ed8;
    }

    .ai-loading {
        display: none;
        text-align: center;
        padding: 1rem;
    }

    .ai-loading-spinner {
        display: inline-block;
        width: 1.5rem;
        height: 1.5rem;
        border: 3px solid rgba(37, 99, 235, 0.3);
        border-radius: 50%;
        border-top-color: #2563eb;
        animation: ai-spin 1s ease-in-out infinite;
    }

    @keyframes ai-spin {
        to { transform: rotate(360deg); }
    }

    .ai-error {
        color: #dc2626;
        padding: 0.5rem;
        display: none;
    }
</style>

<div class="ai-advisor-section">
    <div class="ai-container">
        <div class="ai-header">
            <h2 class="ai-title">AI Construction Advisor</h2>
            <p class="ai-subtitle">Ask any question about construction materials, techniques, or pricing</p>
        </div>

        <div class="ai-chat-container">
            <div class="ai-chat-body" id="aiResponseContainer">
                <div class="ai-response">
                    Hello! I'm your AI construction advisor. Ask me anything about construction materials, pricing, or best practices.
                </div>
            </div>
            
            <div class="ai-loading" id="aiLoading">
                <div class="ai-loading-spinner"></div>
                <p>Getting your answer...</p>
            </div>
            
            <div class="ai-error" id="aiError">
                Sorry, there was an error processing your request. Please try again.
            </div>
            
            <form id="aiQuestionForm" class="ai-chat-input">
                <input 
                    type="text" 
                    id="constructionQuestion" 
                    name="question" 
                    class="ai-input" 
                    placeholder="e.g., What is the current price range for cement in Dar es Salaam?"
                    required
                >
                <button type="submit" class="ai-submit">
                    Ask
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('aiQuestionForm');
    const responseContainer = document.getElementById('aiResponseContainer');
    const loadingIndicator = document.getElementById('aiLoading');
    const errorMessage = document.getElementById('aiError');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const question = document.getElementById('constructionQuestion').value;
        if (!question.trim()) return;
        
        // Show loading indicator
        loadingIndicator.style.display = 'block';
        errorMessage.style.display = 'none';
        
        // Add user question to the chat
        const userQuestion = document.createElement('div');
        userQuestion.className = 'ai-response';
        userQuestion.style.backgroundColor = '#e0f2fe';
        userQuestion.style.textAlign = 'right';
        userQuestion.textContent = question;
        responseContainer.appendChild(userQuestion);
        
        // Scroll to bottom
        responseContainer.scrollTop = responseContainer.scrollHeight;
        
        // Make API request
        fetch('https://career.contactmanagers.xyz/api/v1/construction/inquiry', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ question: question })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('API request failed');
            }
            return response.json();
        })
        .then(data => {
            // Hide loading indicator
            loadingIndicator.style.display = 'none';
            
            // Add AI response to the chat
            const aiResponse = document.createElement('div');
            aiResponse.className = 'ai-response';
            aiResponse.textContent = data.answer || data.message || 'Thank you for your question. I have the information you requested.';
            responseContainer.appendChild(aiResponse);
            
            // Clear input
            document.getElementById('constructionQuestion').value = '';
            
            // Scroll to bottom
            responseContainer.scrollTop = responseContainer.scrollHeight;
        })
        .catch(error => {
            console.error('Error:', error);
            loadingIndicator.style.display = 'none';
            errorMessage.style.display = 'block';
        });
    });
});
</script> 