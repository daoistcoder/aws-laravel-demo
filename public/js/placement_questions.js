document.addEventListener("DOMContentLoaded", function() {
    const clickableChoices = document.querySelectorAll('.clickable-choice');
    let selectedChoice = null;
    let quizContainer = document.querySelector('.question-container');
    let hasIframeQuestion = false;
    let isAnswerSubmitted = false; // Track if the answer is submitted
    const feedbackContainer = document.querySelector('.feedback-container');

    clickableChoices.forEach(choice => {
        if (choice.getAttribute('data-has-iframe') !== 'true') {
            choice.style.height = '12vh';
        } else {
            hasIframeQuestion = true;
        }

        choice.addEventListener('click', () => {
            if (isAnswerSubmitted) {
                // If the answer is already submitted, don't allow further selection
                return;
            }

            if (selectedChoice) {
                selectedChoice.classList.remove('selected-choice');
                if (selectedChoice.getAttribute('data-has-iframe') !== 'true') {
                    selectedChoice.style.height = '10vh';
                }
            }

            choice.classList.add('selected-choice');
            selectedChoice = choice;

            // Get the correct answer data attribute
            const isCorrect = choice.getAttribute('data-correct-answer');
            handleAnswerSelection(isCorrect);
            
            const radioInput = choice.querySelector('input[type="radio"]');
            if (radioInput) {
                radioInput.click();
            }
        });
    });

    if (hasIframeQuestion) {
        quizContainer.style.marginTop = '30px';
        feedbackContainer.style.marginTop = '-150px';
    }

    const dialog = document.getElementById(`dialog`);
    const guideImg = document.querySelector('.guide_image');
    const submitBtn = document.getElementById("submit");

    submitBtn.addEventListener('click', (event) => {
        if (selectedChoice && !isAnswerSubmitted) {

            // If a choice is selected and the answer is not already submitted
            isAnswerSubmitted = true;
            event.preventDefault();

            // Simulate submitting the answer to the database and getting the correct answer
            const userAnswer = selectedChoice.getAttribute('data-choice-letter');
            const correctAnswer = selectedChoice.getAttribute('data-correct-answer');

            // compare locally
            const isCorrect = userAnswer === correctAnswer;

            // Change the dialog and button text
            document.getElementById('title').innerText = isCorrect ? 'Good Job!' : 'Nice Try!';
            document.querySelector('.dialog').style.backgroundImage = isCorrect ? 'url("/images/thumbsupcat.gif")' : 'url("/images/rabbit.gif")';
            document.querySelector('.dialog').style.backgroundPosition = 'right';
            document.querySelector('.dialog').style.backgroundRepeat = 'no-repeat';
            document.querySelector('.dialog').style.backgroundSize = isCorrect? '150px' : '200px';
            document.querySelector('.dialog').style.width = '600px';

            submitBtn.innerText = 'Continue';

            // Change background color depending on the choice
            document.querySelector('.feedback-container').style.backgroundColor = isCorrect ? '#FFD15B' : '#E3E3E3';
            // body.style.backgroundImage = isCorrect ? 'url("/images/rabbit.gif")' : '#E3E3E3';
        }
    });

    function handleAnswerSelection() {
        const isAnswerSelected = selectedChoice !== null;
    
        if (isAnswerSelected && !isAnswerSubmitted) {
            // Animate both the container and feedback-container at the same time
            const container = document.querySelector('.page-container');
            const feedbackContainer = document.querySelector('.feedback-container');
            const transitionDuration = '2s';
    
            container.style.transition = `height ${transitionDuration}`;
            feedbackContainer.style.transition = `bottom ${transitionDuration}, opacity ${transitionDuration}`;
    
            // container.style.height = '75vh';
            feedbackContainer.style.bottom = '0';
            feedbackContainer.style.opacity = 1;
            feedbackContainer.style.position = 'fixed';
            feedbackContainer.style.height = '15%';
            container.style.overflow = 'visible';
            // document.body.style.overflow = 'hidden';
            // document.body.style.backgroundColor = '#FDCA3E';
    
            submitBtn.style.transition = `height ${transitionDuration}, opacity ${transitionDuration}`;
            submitBtn.style.display = 'inline-block';
            submitBtn.style.opacity = 1;
    
            guideImg.style.transition = `height ${transitionDuration}, opacity ${transitionDuration}`;
            guideImg.style.display = 'inline-block';
            guideImg.style.opacity = 1;
    
            dialog.style.transition = `height ${transitionDuration}, opacity ${transitionDuration}`;
            dialog.style.display = 'inline-block';
            dialog.style.opacity = 1;
        }
    }
    
});
