'use strict'

// Change Between Questions and Answers
const userQuestions = document.querySelector('#profile-questions')
const userAnswers = document.querySelector('#profile-answers')

const userQuestionsSelect = document.querySelector('#main-pagination .page-question')
const userAnswersSelect = document.querySelector('#main-pagination .page-answer')
userAnswers.style.display = "none"

function toggleQuestions() {
    userQuestionsSelect.className = "page-item page-question active"
    userQuestions.style.display = "block"

    userAnswersSelect.className = "page-item page-answer"
    userAnswers.style.display = "none"
} 

function toggleAnswers() {
    userQuestionsSelect.className = "page-item page-question"
    userQuestions.style.display = "none"

    userAnswersSelect.className = "page-item page-answer active"
    userAnswers.style.display = "block"
} 

userQuestionsSelect.addEventListener("click", toggleQuestions)
userAnswersSelect.addEventListener("click", toggleAnswers)

