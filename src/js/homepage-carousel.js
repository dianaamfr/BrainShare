'use strict'
/*
const sizeCarousel = document.querySelectorAll('.carousel-custom .page').length
let carouselItems = document.querySelectorAll('.carousel-custom .page')
// Change Between Questions and Answers
const rightButton = document.querySelector('.carousel-control-next')
const leftButton = document.querySelector('.carousel-control-prev')

let boxToRemove = null
let currentNumber = 0
let currentBox = carouselItems[currentNumber]
function goRight() {
		if(boxToRemove != null) {
    	boxToRemove.style.display = ""
    }
    
    currentNumber++
    let index = currentNumber % sizeCarousel
    currentNumber = index
    
    let nextBox = carouselItems[index]
    
    currentBox.style.animation = "right-to-left-right 0.5s linear forwards"
    nextBox.style.animation = "left-to-right-right 0.5s linear forwards"
    nextBox.style.display = "block"
		
    boxToRemove = currentBox
    currentBox = carouselItems[currentNumber]
    
    for(let i = 0; i < 4; i++) {
    	console.log(carouselItems[i].style.display)
    }
    console.log("---")
} 


function goLeft() {
		if(boxToRemove != null) {
    	boxToRemove.style.display = ""
    }
    
    currentNumber--
    let index = currentNumber % sizeCarousel
    if(index == -1) {
        index = sizeCarousel - 1
    }
    currentNumber = index
    
    let nextBox = carouselItems[index]
    
    currentBox.style.animation = "right-to-left-left 0.5s linear forwards"
    nextBox.style.animation = "left-to-right-left 0.5s linear forwards"
    nextBox.style.display = "block"
		
    boxToRemove = currentBox
    currentBox = carouselItems[currentNumber]
    
    for(let i = 0; i < 4; i++) {
    	console.log(carouselItems[i].style.display)
    }
    console.log(currentNumber)
} 

rightButton.addEventListener("click", goRight)
leftButton.addEventListener("click", goLeft)*/